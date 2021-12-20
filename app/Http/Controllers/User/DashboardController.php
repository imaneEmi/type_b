<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\ComiteOrganisation;
use App\Models\Contributeur;
use App\Models\ContributionParticipant;
use App\Models\Demande;
use App\Models\Dto\Departement;
use App\Models\EntiteOrganisatrice;
use App\Models\FileManifestation;
use App\Models\GestionFinanciere;
use App\Models\Manifestation;
use App\Models\ManifestationComite;
use App\Models\ManifestationContributeur;
use App\Models\ManifestationContributionParticipant;
use App\Models\ManifestationEtablissement;
use App\Models\ManifestationTypeContributeur;
use App\Models\SoutienSollicite;
use App\Services\ChercheurService;
use App\Services\DemandeService;
use App\Services\EtablissementService;
use App\Services\FraisCouvertService;
use App\Services\ManifestationComiteService;
use App\Services\ManifestationContributeurService;
use App\Services\ManifestationService;
use App\Services\NatureContributionService;
use App\Services\TypeContributeurService;
use App\Services\util\Common;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class DashboardController extends Controller
{

    private DemandeService $demandeService;
    private TypeContributeurService $typeContributeurService;
    private EtablissementService $etablissementService;
    private NatureContributionService $natureContributionService;
    private FraisCouvertService $fraisCouvertService;
    private   ManifestationComiteService $manifestationComiteService;
    private ManifestationContributeurService $manifestationContributeurService;
    private ChercheurService $chercheurService;
    private  ManifestationService $manifestationService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ManifestationService $manifestationService,
        DemandeService $demandeService,
        EtablissementService $etablissementService,
        TypeContributeurService $typeContributeurService,
        NatureContributionService $natureContributionService,
        FraisCouvertService $fraisCouvertService,
        ManifestationComiteService $manifestationComiteService,
        ManifestationContributeurService $manifestationContributeurService,
        ChercheurService $chercheurService
    ) {

        $this->demandeService  = $demandeService;
        $this->etablissementService  = $etablissementService;
        $this->natureContributionService  = $natureContributionService;
        $this->typeContributeurService  = $typeContributeurService;
        $this->fraisCouvertService  = $fraisCouvertService;
        $this->manifestationComiteService  = $manifestationComiteService;
        $this->manifestationContributeurService  = $manifestationContributeurService;
        $this->chercheurService = $chercheurService;
        $this->manifestationService = $manifestationService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $demandes = $this->demandeService->findAll();
       // dd($demandes[0]->manifestation->lettreAcceptation);
        return view('user/list-request', ['demandes' => $demandes]);
    }

    public function generatePDF(Request $request)
    {

        $demande = $this->demandeService->findById($request->route('id'));
        Gate::authorize('showDemande', $demande);
        $manifestationComite = $this->manifestationComiteService->findByManifistation($demande->manifestation);
        $manifestationContributeur = $this->manifestationContributeurService->findByManifistation($demande->manifestation);
        $pdf = PDF::loadView('user/pdf', compact('demande', 'manifestationComite', 'manifestationContributeur'));
        return $pdf->stream("invoice.pdf", array("Attachment" => false));
    }

    public function createRequest(Request $request)
    {

        $etablissements = $this->etablissementService->findAll();
        $user = $request->user();
        $typeContributeurs = $this->typeContributeurService->findAll();
        $fraisCouvert = $this->fraisCouvertService->findAll();
        $natureContributions  = $this->natureContributionService->findAll();
        if ($request->isMethod('post')) {
            $data = $request->all();


            //dd($data);

            // $user->etablissement_id =  $data['etablissment_coordonnateur_manifestation'];
            // $user->tel =  $data['tel_coordonnateur_manifestation'];
            // $user->fax =  $data['fax_coordonnateur_manifestation'];
            // $updated = $user->update($user->getAttributes());
            // if (!$updated) {
            //     dd("field to update user");
            // }


            // $entiteOrganisatrice = new EntiteOrganisatrice();
            // $entiteOrganisatrice->nom = $data['nom_entite_organisatrice'];
            // $entiteOrganisatrice->responsable = $data['responsable_entite_organisatrice'];
            // $entiteOrganisatrice->etablissement_id = $data['etablissement_entite_organisatrice'];
            // $entiteOrganisatrice = EntiteOrganisatrice::create($entiteOrganisatrice->getAttributes());

            $chercheur = $this->chercheurService->findByEmail($request->user()->email);

            $demande = new Demande();
            $demande->code = $chercheur->id_cher  . "/" . $this->demandeService->countCoordonnateurDemandeByCurrentYear($chercheur) + 1 . "/" . date('Y');
            $demande->date_envoie = date('Y-m-d H:i:s');
            $demande->etat = 'PENDING';
            $demande->coordonnateur_id = $chercheur->id_cher;
            $demande = Demande::create($demande->getAttributes());

            $manifestation = new Manifestation();
            $manifestation->intitule = $data['intitule'];
            $manifestation->type = $data['type'];
            $manifestation->etendue = $data['etendue'];
            $manifestation->lieu = $data['lieu'];
            $manifestation->site_web = $data['site_web'];
            $manifestation->agence_organisatrice = $data['agence_organisatrice'];
            $manifestation->partenaires = $data['partenaires'];
            $manifestation->nbr_participants_prevus = $data['nbr_etudiants_locaux'] + $data['nbr_etudiants_non_locaux'] + $data['nbr_enseignants_locaux'] + $data['nbr_enseignants_non_locaux'];
            $manifestation->nbr_etudiants_locaux = $data['nbr_etudiants_locaux'];
            $manifestation->nbr_etudiants_non_locaux = $data['nbr_etudiants_non_locaux'];
            $manifestation->nbr_enseignants_locaux = $data['nbr_enseignants_locaux'];
            $manifestation->nbr_enseignants_non_locaux = $data['nbr_enseignants_non_locaux'];
            $manifestation->date_debut = $data['date_debut'];
            $manifestation->date_fin = $data['date_fin'];

            $manifestation->entite_organisatrice_id = $chercheur->laboratoire->getAttributes()["id_labo"];
            $manifestation->demande_id = $demande->getAttributes()["id"];

            $manifestation = Manifestation::create($manifestation->getAttributes());


            $fileEtudiantsLocauxPath =   Storage::disk('local')->put("manifestation_files", $data['file_nbr_etudiants_locaux']);
            $fileManifestation1 = new FileManifestation();
            $fileManifestation1->url = $fileEtudiantsLocauxPath;
            $fileManifestation1->manifestation_id = $manifestation->getAttributes()["id"];
            $fileManifestation1 = FileManifestation::create($fileManifestation1->getAttributes());

            $fileEnseignantsLocauxPath =   Storage::disk('local')->put("manifestation_files", $data['file_nbr_enseignants_locaux']);
            $fileManifestation2 = new FileManifestation();
            $fileManifestation2->url = $fileEnseignantsLocauxPath;
            $fileManifestation2->manifestation_id = $manifestation->getAttributes()["id"];
            $fileManifestation2 = FileManifestation::create($fileManifestation2->getAttributes());

            $manifestation->file_manifestation_etudiants_locaux_id = $fileManifestation1->getAttributes()["id"];;
            $manifestation->file_manifestation_enseignants_locaux_id = $fileManifestation2->getAttributes()["id"];;
            $manifestation->update($manifestation->getAttributes());

            $gestionFinanciere = json_decode($data['gestionFinanciere'], true);
            for ($i = 0; $i < count($gestionFinanciere); $i++) {
                $gestionFinanciere[$i]["manifestation_id"] = $manifestation->getAttributes()["id"];
                GestionFinanciere::create($gestionFinanciere[$i]);
            }

            $etablissementsOrganisateur = $data['etablissements_organisateur'];
            for ($i = 0; $i < count($etablissementsOrganisateur); $i++) {
                $manifestationEtablissement = new ManifestationEtablissement();
                $manifestationEtablissement->manifestation_id = $manifestation->getAttributes()["id"];
                $manifestationEtablissement->etablissement_id = $etablissementsOrganisateur[$i];
                ManifestationEtablissement::create($manifestationEtablissement->getAttributes());
            }

            $typeContributeurs = $data['typeContributeurs'];
            for ($i = 0; $i < count($typeContributeurs); $i++) {
                $ManifestationTypeContributeur = new ManifestationTypeContributeur();
                $ManifestationTypeContributeur->manifestation_id = $manifestation->getAttributes()["id"];
                $ManifestationTypeContributeur->type_contributeur_id = $typeContributeurs[$i];
                ManifestationTypeContributeur::create($ManifestationTypeContributeur->getAttributes());
            }

            // $comiteOrganisation = json_decode($data['comiteOrganisation'], true);
            // for ($i = 0; $i < count($comiteOrganisation); $i++) {
            //     $organisature = ComiteOrganisation::create($comiteOrganisation[$i]);
            //     $manifestationComite = new ManifestationComite();
            //     $manifestationComite->comite_organisation_id = $organisature->getAttributes()['id'];
            //     $manifestationComite->manifestation_id = $manifestation->getAttributes()["id"];
            //     $manifestationComite = ManifestationComite::create($manifestationComite->getAttributes());
            // }

            $contributeurs = json_decode($data['contributeurs'], true);
            for ($i = 0; $i < count($contributeurs); $i++) {
                $contributeur = Contributeur::create($contributeurs[$i]);
                $manifestationContributeur = new ManifestationContributeur();
                $manifestationContributeur->contributeur_id = $contributeur->getAttributes()['id'];
                $manifestationContributeur->manifestation_id  = $manifestation->getAttributes()["id"];
                $manifestationContributeur = ManifestationContributeur::create($manifestationContributeur->getAttributes());
            }

            $contributionParticipants = json_decode($data['contributionParticipants'], true);
            for ($i = 0; $i < count($contributionParticipants); $i++) {
                $contributeurParticipant = ContributionParticipant::create($contributionParticipants[$i]);
                $manifestationContributionParticipant = new ManifestationContributionParticipant();
                $manifestationContributionParticipant->cont_par_id = $contributeurParticipant->getAttributes()['id'];
                $manifestationContributionParticipant->manifestation_id  = $manifestation->getAttributes()["id"];
                $manifestationContributionParticipant = ManifestationContributionParticipant::create($manifestationContributionParticipant->getAttributes());
            }

            for ($i = 0; $i < count($fraisCouvert); $i++) {
                if ($request->has("frais-ouvert-" . $fraisCouvert[$i]->id)) {
                    $soutienSollicite = new SoutienSollicite();
                    $soutienSollicite->nbr = $data["nombre_frais_ouvert_" . $fraisCouvert[$i]->id];
                    $soutienSollicite->montant = $data["montant_frais_ouvert_" . $fraisCouvert[$i]->id];
                    $soutienSollicite->remarques = $data["remarques_frais_ouvert_" . $fraisCouvert[$i]->id];
                    $soutienSollicite->manifestation_id = $manifestation->getAttributes()["id"];
                    $soutienSollicite->frais_couvert_id = $fraisCouvert[$i]->id;
                    SoutienSollicite::create($soutienSollicite->getAttributes());
                }
            }

            $pieces = $data['pieces'];
            for ($i = 0; $i < count($pieces); $i++) {
                $path =   Storage::disk('local')->put("manifestation_files", $pieces[$i]);
                $fileManifestation = new FileManifestation();
                $fileManifestation->url = $path;
                $fileManifestation->manifestation_id = $manifestation->getAttributes()["id"];
                FileManifestation::create($fileManifestation->getAttributes());
            }

            return redirect()->route('dashboard.user');
        }

        return view('user/create-request', ["natureContributions" => $natureContributions, "typeContributeurs" => $typeContributeurs, "etablissements" => $etablissements, 'user' => $user, 'fraisCouvert' => $fraisCouvert]);
    }

    public  function uploadRapport(Request $request)
    {



        if (!$request->hasFile('rapport')) {
            return  response()
                ->json([
                    'code' => 500,
                    'message' => 'le rapport est requis! '
                ]);
        }

        $demande = $request->all()['demande'];
        $file = $request->file('rapport');


        $manifestation = $this->manifestationService->findByDemandeId($demande);

        $fileEtudiantsLocauxPath =   Storage::disk('local')->put("manifestation_files", $file);
        $fileManifestation = new FileManifestation();
        $fileManifestation->url = $fileEtudiantsLocauxPath;
        $fileManifestation->manifestation_id = $manifestation->getAttributes()["id"];
        $fileManifestation = FileManifestation::create($fileManifestation->getAttributes());

        $manifestation->file_manifestation_rapport_id = $fileManifestation->getAttributes()["id"];
        $manifestation->update($manifestation->getAttributes());

        return response()
            ->json([
                'code' => 200,
                'message' => "rapport téléchargé!"
            ]);
    }

    public function readRapport(Request $request)
    {

        $url = $request->route('url');
        $url =str_replace('-','/',$url);
        $response = Common::readFileFromLocalStorage($url);
        if ($response == null)  return redirect()->route('dashboard.user');
        return $response;
    }
}
