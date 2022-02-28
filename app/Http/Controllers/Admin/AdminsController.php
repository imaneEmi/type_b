<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AcceptanceMail;
use App\Mail\CustomMail;
use App\Mail\NotificationMail;
use App\Mail\RejectionMail;
use App\Models\DemandeStatus;
use App\Models\Dto\Chercheur;
use App\Models\FileManifestation;
use App\Models\SoutienAccorde;
use App\Models\User;
use App\Services\ChercheurService;
use App\Services\ManifestationService;
use App\Services\DemandeService;
use App\Services\EtablissementService;
use App\Services\UserService;
use App\Services\util\Common;
use App\Services\BudgetAnnuelService;

use App\Services\util\Config;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use PDF;

use function Psy\debug;

class AdminsController extends Controller
{

    private ManifestationService $manifestationService;
    private DemandeService $demandeService;
    private ChercheurService $chercheurService;
    private EtablissementService $etablissementService;
    private BudgetAnnuelService $budgetAnnuelService;

    public function __construct(
        ChercheurService $chercheurService,
        EtablissementService $etablissementService,
        ManifestationService $manifestationService,
        DemandeService $demandeService,
        BudgetAnnuelService $budgetAnnuelService
    ) {
        $this->chercheurService = $chercheurService;
        $this->etablissementService = $etablissementService;
        $this->manifestationService = $manifestationService;
        $this->demandeService = $demandeService;
        $this->budgetAnnuelService = $budgetAnnuelService;
    }

    public function getManifestation($id)
    {
        try {
            $manifestationDetails = $this->manifestationService->getManifestation($id, $this->demandeService, $this->chercheurService);
            $coordonnateur = $manifestationDetails['coordonnateur'];
            $etablissement = $this->etablissementService->findById($coordonnateur->laboratoire->etab_id);
            $labos = $etablissement->laboratoires;
            // Calcule Budget octroyé à l'établissement
            $budgetEtablissement = 0;
            foreach ($labos as $labo) {
                $chercheurs = $labo->chercheurs;
                foreach ($chercheurs as $coordonnateur) {
                    $demandes = $this->demandeService->findAllByCoordonnateurIdAndCurrentYear($coordonnateur->id);
                    //dd($demandes);
                    foreach ($demandes as $demande) {
                        //dd($demande->manifestation->soutienAccorde()->sum('montant'));
                        $budgetEtablissement += $demande->manifestation->soutienAccorde()->sum('montant');
                    }
                }
            }
            // Budget de la structure
            $budgetStructure = 0;
            $labo = $coordonnateur->laboratoire;
            $chercheurs = $labo->chercheurs;
            foreach ($chercheurs as $coordonnateur) {
                $demandes = $this->demandeService->findAllByCoordonnateurIdAndCurrentYear($coordonnateur->id);
                foreach ($demandes as $demande) {
                    $budgetStructure += $demande->manifestation->soutienAccorde()->sum('montant');
                }
            }
            $manifestationDetails["budgetEtablissement"] = $budgetEtablissement;
            $manifestationDetails["budgetStructure"] = $budgetStructure;
            return view('admin/edit_demande', $manifestationDetails);
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return redirect()->back()->with('error', "Une erreur est survenue!!");
        }
    }

    public function delete($id)
    {
        try {
            $demande = $this->demandeService->findById($id);
            $manifestation = $demande->manifestation;
            $files = $manifestation->files;
            //loop delete files from storage
            foreach ($files as $file) {
                Storage::delete($file->url);
            }
            $this->demandeService->delete($id);
            $success = "Demande supprimée";
            return response()
                ->json([
                    'code' => 200,
                    'message' => $success
                ]);
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            $error = "Echec!! La demande n'a pas pu être supprimer";
            return response()
                ->json([
                    'code' => 500,
                    'message' => $error
                ]);
        }
    }
    public function accept($id)
    {
        try {
            $demande = $this->demandeService->findById($id);
            $manifestation = $demande->manifestation;
            $soutienAccorde = $manifestation->soutienAccorde;
            $error = "";
            $success = "";
            if (sizeof($soutienAccorde) == 0 || $manifestation->soutienAccorde()->sum('montant') == 0) {
                $error = "Echec de l'opération! Aucun montant octroyé pour cette demande!";
                return redirect()->back()->with('error', $error);
            }
            // Edit Budget
            $annee = $demande->created_at->format('Y');
            $budget = $this->budgetAnnuelService->findBudgetParAnnee($annee);
            $totalAccorde = $manifestation->soutienAccorde()->sum('montant');
            if ($budget->budget_restant > 0 && ($budget->budget_restant - $totalAccorde) >= 0) {
                $budget->budget_restant = $budget->budget_restant - $totalAccorde;
            } else {
                $error = "Echec!Dépassement du budget fixé!!";
                return redirect()->back()->with('error', $error);
            }
            $this->budgetAnnuelService->update($budget);
            $this->demandeService->changeEtat($demande->id, DemandeStatus::ACCEPTEE);
            $coordonnateur = $this->chercheurService->findById($demande->coordonnateur_id);
            $responsableStructure = $coordonnateur->laboratoire->responsable->email;
            try {
                Mail::to($coordonnateur->email)
                    ->cc($responsableStructure)
                    ->send(new NotificationMail($coordonnateur->nom . " " . $coordonnateur->prenom));
            } catch (\Exception $ex) {
                $error = "Oups!L'email n'as pas pu être envoyé!";
                error_log($ex->getMessage());
            }
            $success = "Demande acceptée";
            return redirect('/demandes-acceptees')->with('success', $success);
        } catch (\Exception $ex) {
            $error = "Echec de l'opération! Une erreure est survenue!";
            error_log($ex->getMessage());
            return redirect()->back()->with('error', $error);
        }
    }

    public function reject($id)
    {
        try {
            $demande = $this->demandeService->findById($id);
            $error = "";
            $success = "";

            $this->demandeService->changeEtat($demande->id, DemandeStatus::REFUSEE);
            $coordonnateur = $this->chercheurService->findById($demande->coordonnateur_id);
            $responsableStructure = $coordonnateur->laboratoire->responsable->email;
            try {
                Mail::to($coordonnateur->email)
                    ->cc($responsableStructure)
                    ->send(new RejectionMail($coordonnateur->nom . " " . $coordonnateur->prenom));
                $success = "Demande refusée";
                return redirect('/demandes-refusees')->with('success', $success);
            } catch (\Exception $ex) {
                $error = "Oups!L'email n'as pas pu être envoyé!";
                error_log($ex->getMessage());
            }
        } catch (\Exception $ex) {
            $error = "Echec de l'opération! Une erreure est survenue!";
            error_log($ex->getMessage());
            return redirect()->back()->with('error', $error);
        }
    }

    public function getManifestationDetails($id, DemandeService $demandeService)
    {
        return view('admin/manif_details', $this->manifestationService->getManifestationDetails($id, $demandeService, $this->chercheurService, $this->etablissementService));
    }

    public function getDemandesCourantes(DemandeService $demandeService, ChercheurService $chercheurService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat(DemandeStatus::COURANTE, $chercheurService));
    }
    public function getDemandesEnCours(DemandeService $demandeService, ChercheurService $chercheurService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat(DemandeStatus::ENCOURS, $chercheurService));
    }

    public function getDemandesAcceptees(DemandeService $demandeService, ChercheurService $chercheurService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat(DemandeStatus::ACCEPTEE, $chercheurService));
    }
    public function getDemandesResfusees(ChercheurService $chercheurService)
    {
        return view('admin/liste_demandes', $this->demandeService->findByEtat(DemandeStatus::REFUSEE, $chercheurService));
    }

    public function archive(DemandeService $demandeService, BudgetAnnuelService $budgetService)
    {
        if (count($budgetService->findAll()) == 0) return view('admin.edit_budgetFixe');
        else {
            $annees = [];
            $budgets = $budgetService->findAllOrderByAnneeDesc();
            foreach ($budgets as $budget) {
                $annees[] = $budget->annee;
            }
            $demandes = $demandeService->getAll($this->chercheurService);
            $demandes['annees'] = $annees;
            return view('admin/archive', $demandes);
        }
    }

    public function generatePdf($id)
    {
        try {
            $manifestationDetails = $this->manifestationService->getManifestation($id, $this->demandeService, $this->chercheurService);
            $coordonnateur = $manifestationDetails['coordonnateur'];
            $etablissement = $this->etablissementService->findById($coordonnateur->laboratoire->etab_id);
            $labos = $etablissement->laboratoires;
            // Calcule Budget octroyé à l'établissement
            $budgetEtablissement = 0;
            foreach ($labos as $labo) {
                $chercheurs = $labo->chercheurs;
                foreach ($chercheurs as $coordonnateur) {
                    $demandes = $this->demandeService->findAllByCoordonnateurIdAndCurrentYear($coordonnateur->id);
                    //dd($demandes);
                    foreach ($demandes as $demande) {
                        //dd($demande->manifestation->soutienAccorde()->sum('montant'));
                        $budgetEtablissement += $demande->manifestation->soutienAccorde()->sum('montant');
                    }
                }
            }
            // Budget de la structure
            $budgetStructure = 0;
            $labo = $coordonnateur->laboratoire;
            $chercheurs = $labo->chercheurs;
            foreach ($chercheurs as $coordonnateur) {
                $demandes = $this->demandeService->findAllByCoordonnateurIdAndCurrentYear($coordonnateur->id);
                foreach ($demandes as $demande) {
                    $budgetStructure += $demande->manifestation->soutienAccorde()->sum('montant');
                }
            }
            $data = $this->manifestationService->getManifestationDetails($id, $this->demandeService, $this->chercheurService, $this->etablissementService);
            $data["budgetEtablissement"] = $budgetEtablissement;
            $data["budgetStructure"] = $budgetStructure;
            $pdf = PDF::loadView('admin.traitement_dossier_pdf', compact('data'))->stream();
            return  $pdf;
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return redirect()->back()->with('error',"Une erreur est survenue!");
        }
    }

    public function uploadLettre(Request $request, $id)
    {
        if ($request->hasFile('lettre')) {
            $manifestation = $this->manifestationService->findByDemandeId($id);

            $file = $request->file('lettre');
            $lettrePath =  $file->storeAs('manifestation_files', $file->getClientOriginalName());
            $lettreManif = new FileManifestation();
            $lettreManif->titre = Str::of($file->getClientOriginalName())->trim('.pdf');
            $lettreManif->url = $lettrePath;
            $lettreManif->manifestation_id = $manifestation->getAttributes()["id"];
            $lettreManif = FileManifestation::create($lettreManif->getAttributes());

            $manifestation->lettre_acceptation_id = $lettreManif->getAttributes()["id"];
            $manifestation->update($manifestation->getAttributes());

            try {
                $coordonnateur = $this->chercheurService->findById($manifestation->demande->coordonnateur_id);
                Mail::to($coordonnateur->email)
                    ->send(new AcceptanceMail($coordonnateur->nom . " " . $coordonnateur->prenom));
            } catch (\Exception $ex) {
                $error = "Oups!L'email n'a pas pu être envoyé!";
                error_log($ex->getMessage());
            }

            $success = 'Lettre téléchargée!';

            return redirect()->back()->with('success', $success);
        }
        $error = "La lettre n'a pas pu être téléchargée!!";
        return redirect()->back()->with('error', $error);
    }

    public function getLettre(Request $request)
    {
        $url = $request->route('url');
        $url = str_replace('-', '/', $url);
        $response = Common::readFileFromLocalStorage($url);
        if ($response == null)  return redirect()->route('dashboard.admin');
        return $response;
    }

    public function customEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'objet' => 'required',
            'corpsEmail' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error_code', 1);
        }

        $nom = $request->get('nom');
        $email = $request->get('email');
        $objet = $request->get('objet');
        $corpsEmail = $request->get('corpsEmail');
        $cc = $request->get('cc');
        $editable = $request->get('editable');
        $demandeId = $request->get('demandeId');
        $success = "";
        $error = "";
        if ($cc != null) {
            try {
                Mail::to($email)
                    ->cc($cc)
                    ->send(new CustomMail($nom, $objet, $corpsEmail));
                if ($editable != null) {
                    $demande = $this->demandeService->findById($demandeId);
                    $demande->editable = true;
                    $this->demandeService->update($demande);
                }
                $success = "Email envoyé!";
                return redirect()->back()->with('success', $success);
            } catch (\Exception $ex) {
                $error = "Echec!Une erreur est survenue";
                error_log($ex->getMessage());
                return redirect()->back()->with('error', $error);
            }
        } else {
            try {
                Mail::to($email)
                    ->send(new CustomMail($nom, $objet, $corpsEmail));
                if ($editable != null) {
                    $demande = $this->demandeService->findById($editable[0]);
                    $demande->editable = true;
                    $this->demandeService->update($demande);
                }
                $success = "Email envoyé!";
                return redirect()->back()->with('success', $success);
            } catch (\Exception $ex) {
                $error = "Echec!Une erreur est survenue";
                error_log($ex->getMessage());
                return redirect()->back()->with('error', $error);
            }
        }
    }

    public function editMontant(Request $request)
    {
        $manifestation = $this->manifestationService->findById($request->get('manifestation'));
        $soutienSollicites = $manifestation->soutienSollicite;
        $soutienAccordes = $manifestation->soutienAccorde;
        $montantOk = $request->get('montantOk');
        $nbrOk = $request->get('nbrOk');
        $demande = $manifestation->demande;
        $demande->remarques = $request->get('observations');
        if ($demande->etat === DemandeStatus::COURANTE) {
            $demande->etat = DemandeStatus::ENCOURS;
        }
        $error = "";
        $success = "";
        if (sizeof($soutienAccordes) == 0) {
            if (sizeof($soutienSollicites) == sizeof($montantOk)) {
                for ($i = 0; $i < sizeof($montantOk); $i++) {
                    $soutienAccorde = new SoutienAccorde();
                    $soutienAccorde->manifestation_id = $manifestation->id;
                    $soutienAccorde->frais_couvert_id = $soutienSollicites[$i]->id;
                    if ($montantOk[$i] != null) {
                        $soutienAccorde->nbr = $nbrOk[$i];
                        $soutienAccorde->montant = $montantOk[$i];
                    }
                    try {
                        $soutienAccorde->save();
                        $this->demandeService->update($demande);
                    } catch (\Exception $ex) {
                        $error = "Une erreur est survenue!! Les montants n'ont pas été enregistrer!!";
                        Log::error($ex->getMessage());
                    }
                }
            }
        } else {
            foreach ($soutienAccordes as $key => $soutienAccorde) {
                if ($soutienAccorde->pivot->frais_couvert_id == $soutienSollicites[$key]->id) {
                    if ($montantOk[$key] != null) {
                        $soutienAccorde->pivot->nbr = $nbrOk[$key];
                        $soutienAccorde->pivot->montant = $montantOk[$key];
                    }
                    try {
                        $soutienAccorde->pivot->update();
                        $this->demandeService->update($demande);
                    } catch (\Exception $ex) {
                        $error = "Une erreur est survenue!! Les montants n'ont pas été modifier!!";
                        Log::error($ex->getMessage());
                    }
                }
            }
        }
        $success = "Montants Enregistrés.";
        return redirect()->back()->with(['success' => $success, 'error' => $error]);
    }

    public function disableUpload($id)
    {
        try {
            $demande = $this->demandeService->findById($id);
            $demande->editable = false;
            $this->demandeService->update($demande);
            $success = "Désactivation réussie!";
            return redirect()->back()->with('success', $success);
        } catch (\Exception $ex) {
            $error = "Désactivation échouée !!";
            error_log($ex->getMessage());
            return redirect()->back()->with('error', $error);
        }
    }
    public function estimationDotation(Request $request, $id)
    {
        try {
            $demande = $this->demandeService->findById($id);
            $demande->estimationDotationMax = $request->get('estimation');
            $this->demandeService->update($demande);
            return response()
                ->json([
                    'code' => 200,
                    'message' => "Estmation de dotaion Modifiée!"
                ]);
        } catch (\Exception $ex) {
            $error = "Echec!!";
            error_log($ex->getMessage());
            return response()
                ->json([
                    'code' => 500,
                    'message' => $error
                ]);
        }
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($request->filled('updateProfile')) {

                $user = $request->user();
                $user->name =  $data['name'];
                $user->prenom =  $data['prenom'];
                $user->tel =  $data['tel'];
                $user->fax =  $data['fax'];
                $user->update();
            }

            if ($request->filled('addAdmin')) {

                $request->validate([
                    'nameAdmin' => 'required',
                    'prenomAdmin' => 'required',
                    'email' => 'required| email | unique:users',
                    'password' => 'required|confirmed|min:8',
                    'password_confirmation' => 'same:password',
                ]);

                $user = User::create([
                    'name' => $data['nameAdmin'],
                    'prenom' => $data['prenomAdmin'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                try {
                    $userRole = Role::findByName('admin');
                    $user->assignRole($userRole);
                } catch (Exception $e) {

                    $userRole = Role::create(['name' => 'admin']);
                    $user->assignRole($userRole);
                }
            }
        }
        return view('admin/edite_profile', ["user" =>  $request->user()]);
    }
}
