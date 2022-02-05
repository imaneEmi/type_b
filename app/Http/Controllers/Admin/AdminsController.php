<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\Dto\Chercheur;
use App\Models\FileManifestation;
use App\Models\Manifestation;
use App\Models\SoutienAccorde;
use App\Services\ChercheurService;
use App\Services\ManifestationService;
use App\Services\DemandeService;
use App\Services\EtablissementService;
use App\Services\UserService;
use App\Services\util\Common;
use App\Services\BudgetAnnuelService;

use App\Services\util\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PDF;

use function Psy\debug;

class AdminsController extends Controller
{

    private ManifestationService $manifestationService;
    private DemandeService $demandeService;
    private ChercheurService $chercheurService;
    private EtablissementService $etablissementService;

    public function __construct(ChercheurService $chercheurService, EtablissementService $etablissementService, ManifestationService $manifestationService)
    {
        $this->chercheurService = $chercheurService;
        $this->etablissementService = $etablissementService;
        $this->manifestationService = $manifestationService;
    }

    public function getManifestation($id, ManifestationService $manifestationService, DemandeService $demandeService)
    {
        return view('admin/edit_demande', $manifestationService->getManifestation($id, $demandeService, $this->chercheurService));
    }

    public function delete(Request $request, DemandeService $demandeService)
    {
        try {

            $id = $request->demande;
            $demandeService->delete($id);
            $msg = "Demande deleted";
            return redirect('/admin_edit_form');
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return redirect('/admin_edit_form');
        }
    }
    public function accept(Request $request, DemandeService $demandeService)
    {
        try {
            $soutienAccorde = new SoutienAccorde();
            for ($i = 0; $i < sizeof($request->forfait_id); $i++) {
                $soutienAccorde->nbr = $request->nbrOk[$i];
                $soutienAccorde->montant = $request->montantOk[$i];
                $soutienAccorde->frais_couvert_id = $request->forfait_id[$i];
                $soutienAccorde->manifestation_id = $request->manifestation;
                SoutienAccorde::create($soutienAccorde->getAttributes());
            }
            $demandeService->changeEtat($request->demande, 'Acceptée');
            $msg = "Demande acceptée";
            return redirect('/demandes-acceptees');
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return redirect()->back();
        }
    }

    public function getManifestationDetails($id, ManifestationService $manifestationService, DemandeService $demandeService)
    {
        return view('admin/manif_details', $manifestationService->getManifestationDetails($id, $demandeService, $this->chercheurService, $this->etablissementService));
    }

    public function getDemandesCourantes(DemandeService $demandeService, ChercheurService $chercheurService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat(Config::$COURANTE, $chercheurService));
    }

    public function getDemandesAcceptees(DemandeService $demandeService, ChercheurService $chercheurService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat(Config::$ACCEPTEE, $chercheurService));
    }
    public function getDemandesResfusees(DemandeService $demandeService, ChercheurService $chercheurService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat(Config::$REFUSEE, $chercheurService));
    }
    public function profile(UserService $userService)
    {
        return view('admin/edit_profile');
    }
    public function pieceDemandee()
    {
        return view('admin/edit_pieceDemandee');
    }
    public function fraisCouverts()
    {
        return view('admin/edit_fraisCouvert');
    }

 public function archive(DemandeService $demandeService,BudgetAnnuelService $budgetService)
    {
         if(count($budgetService->findAll())==0) return view('admin.edit_budgetFixe');
        else return view('admin/archive', $demandeService->getAll($this->chercheurService));
    }

    public function generatePdf(Request $request)
    {
        $data = Date::now();
        $pdf = PDF::loadView('admin.traitement_dossier_pdf', compact('data'))->stream();
        return  $pdf;
    }

    public function saveAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'same:password',
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'le rapport est requis! '
                ]);
        }
        dd(1);
        return 1;
    }

    public function uploadLettre(Request $request, $id)
    {
        if ($request->hasFile('lettre')) {
            $manifestation = $this->manifestationService->findByDemandeId($id);

            $file = $request->file('lettre');
            //$lettrePath =  $file->storeAs('manifestation_files/lettres','Lettre'.$id.'.pdf');
            $lettrePath =  $file->storeAs('manifestation_files/lettres', $file->getClientOriginalName());
            $lettreManif = new FileManifestation();
            $lettreManif->titre = Str::of($file->getClientOriginalName())->trim('.pdf');
            $lettreManif->url = $lettrePath;
            $lettreManif->manifestation_id = $manifestation->getAttributes()["id"];
            $lettreManif = FileManifestation::create($lettreManif->getAttributes());

            $manifestation->lettre_acceptation_id = $lettreManif->getAttributes()["id"];
            $manifestation->update($manifestation->getAttributes());
            $success = 'Lettre téléchargé!';

            return redirect()->back()->with('success', $success);
        }
        $error = "La lettre n'a pas été télécharger!!";
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

    public function notificationEmail(Request $request)
    {
        try {
            Mail::to('me@uca.ma')
                ->cc(['me2@uca.ma', 'me3@uca.ma'])
                ->send(new NotificationMail('EL AIMANI Imane'));
            return redirect()->back();
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }
    }

    public function customEmail(Request $request)
    {
        if ($request->has('cc')) {
        }
        try {
            Mail::to('me@uca.ma')
                ->cc(['me2@uca.ma', 'me3@uca.ma'])
                ->send(new NotificationMail('EL AIMANI Imane'));
            return redirect()->back();
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }
    }

    public function editMontant(Request $request)
    {
        Log::error("***********************************editMontant");
        return response()
            ->json([
                'code' => 200,
                'message' => "editMontant"
            ]);
    }
}
