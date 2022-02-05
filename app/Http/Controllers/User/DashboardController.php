<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\ComiteOrganisation;
use App\Models\ComiteOrganisationLocal;
use App\Models\ComiteOrganisationNonLocal;
use App\Models\ComiteScientifiqueLocal;
use App\Models\ComiteScientifiqueNonLocal;
use App\Models\Contributeur;
use App\Models\ContributionParticipant;
use App\Models\Demande;
use App\Models\DemandeStatus;
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
use App\Models\NatureContributionManifestation;
use App\Models\PieceDemande;
use App\Models\SoutienSollicite;
use App\Services\ChercheurService;
use App\Services\ComiteOrganisationLocalService;
use App\Services\ComiteOrganisationNonLocalService;
use App\Services\ComiteScientifiqueLocalService;
use App\Services\ComiteScientifiqueNonLocalService;
use App\Services\DemandeService;
use App\Services\EtablissementService;
use App\Services\FraisCouvertService;
use App\Services\GestionFinanciereService;
use App\Services\ManifestationComiteService;
use App\Services\ManifestationContributeurService;
use App\Services\ManifestationContributionParticipantService;
use App\Services\ManifestationEtablissementService;
use App\Services\ManifestationService;
use App\Services\ManifestationTypeContributeurService;
use App\Services\NatureContributionManifestationService;
use App\Services\NatureContributionService;
use App\Services\SoutienSolliciteService;
use App\Services\TypeContributeurService;
use App\Services\util\Common;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DashboardController extends Controller
{

    private $demandeService;
    private $typeContributeurService;
    private $etablissementService;
    private $natureContributionService;
    private $fraisCouvertService;
    private $manifestationComiteService;
    private $manifestationContributeurService;
    private $chercheurService;
    private $manifestationService;
    private $manifestationEtablissementService;
    private $gestionFinanciereService;
    private $comiteOrganisationLocalService;
    private $comiteOrganisationNonLocalService;
    private $comiteScientifiqueNonLocalService;
    private $comiteScientifiqueLocalService;
    private $manifestationContributionParticipantService;
    private $manifestationTypeContributeurService;
    private $soutienSolliciteService;
    private $natureContributionManifestationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        SoutienSolliciteService $soutienSolliciteService,
        ManifestationTypeContributeurService $manifestationTypeContributeurService,
        ManifestationContributionParticipantService $manifestationContributionParticipantService,
        ComiteScientifiqueNonLocalService $comiteScientifiqueNonLocalService,
        ComiteScientifiqueLocalService $comiteScientifiqueLocalService,
        ComiteOrganisationNonLocalService $comiteOrganisationNonLocalService,
        ManifestationService $manifestationService,
        DemandeService $demandeService,
        EtablissementService $etablissementService,
        TypeContributeurService $typeContributeurService,
        NatureContributionService $natureContributionService,
        FraisCouvertService $fraisCouvertService,
        ManifestationComiteService $manifestationComiteService,
        ManifestationContributeurService $manifestationContributeurService,
        ChercheurService $chercheurService,
        ManifestationEtablissementService $manifestationEtablissementService,
        GestionFinanciereService $gestionFinanciereService,
        ComiteOrganisationLocalService $comiteOrganisationLocalService,
        NatureContributionManifestationService $natureContributionManifestationService
    ) {
        $this->soutienSolliciteService = $soutienSolliciteService;
        $this->manifestationTypeContributeurService = $manifestationTypeContributeurService;
        $this->manifestationContributionParticipantService = $manifestationContributionParticipantService;
        $this->comiteScientifiqueNonLocalService = $comiteScientifiqueNonLocalService;
        $this->comiteScientifiqueLocalService = $comiteScientifiqueLocalService;
        $this->demandeService = $demandeService;
        $this->etablissementService = $etablissementService;
        $this->natureContributionService = $natureContributionService;
        $this->typeContributeurService = $typeContributeurService;
        $this->fraisCouvertService = $fraisCouvertService;
        $this->manifestationComiteService = $manifestationComiteService;
        $this->manifestationContributeurService = $manifestationContributeurService;
        $this->chercheurService = $chercheurService;
        $this->manifestationService = $manifestationService;
        $this->manifestationEtablissementService = $manifestationEtablissementService;
        $this->gestionFinanciereService = $gestionFinanciereService;
        $this->comiteOrganisationLocalService = $comiteOrganisationLocalService;
        $this->comiteOrganisationNonLocalService = $comiteOrganisationNonLocalService;
        $this->natureContributionManifestationService = $natureContributionManifestationService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $demandes = $this->demandeService->findAll();

        return view('user/list-request', ['demandes' => $demandes, "demandeStatus" => DemandeStatus::class]);
    }

    public function generatePDF(Request $request)
    {
        $demande = $this->demandeService->findById($request->route('id'));
        Gate::authorize('showDemande', $demande);

        $manifestationComite = $this->manifestationComiteService->findByManifistation($demande->manifestation);
        $manifestationcontributeurs = $this->manifestationContributeurService->findByManifistation($demande->manifestation);
        $etablissementsOrganisateur = $this->manifestationEtablissementService->findEtablissementsByManifistation($demande->manifestation);
        $gestionFinanciere = $this->gestionFinanciereService->findByManifistation($demande->manifestation);
        $coordonnateur = $this->chercheurService->findByEmail($request->user()->email);
        $entiteOrganisatrice = $coordonnateur->laboratoire;
        $responsableEntiteOrganisatrice = $this->chercheurService->findById($entiteOrganisatrice->resp_id);
        $comiteOrganisationLocal = $this->comiteOrganisationLocalService->findChercheursByManifistation($demande->manifestation);
        $comiteOrganisationNonLocal = $this->comiteOrganisationNonLocalService->findByManifistation($demande->manifestation);
        $comiteScientifiqueNonLocal = $this->comiteScientifiqueNonLocalService->findByManifistation($demande->manifestation);
        $comiteScientifiqueLocal = $this->comiteScientifiqueLocalService->findByManifistation($demande->manifestation);
        $manifestationContributionParticipant = $this->manifestationContributionParticipantService->findByManifistation($demande->manifestation);
        $manifestationTypeContributeur = $this->manifestationTypeContributeurService->findByManifistation($demande->manifestation);
        $natureContributionManifestation =  $this->natureContributionManifestationService->findByManifistation($demande->manifestation);
        $soutienSollicite = $this->soutienSolliciteService->findByManifistation($demande->manifestation);
        $totalSoutienSollicite = $this->soutienSolliciteService->calculateTotal($soutienSollicite);
        $pdf = PDF::loadView('user/pdf', compact(
            'totalSoutienSollicite',
            'soutienSollicite',
            'manifestationTypeContributeur',
            'manifestationContributionParticipant',
            'comiteScientifiqueLocal',
            'comiteScientifiqueNonLocal',
            'comiteOrganisationNonLocal',
            'comiteOrganisationLocal',
            'coordonnateur',
            'entiteOrganisatrice',
            'responsableEntiteOrganisatrice',
            'demande',
            'manifestationComite',
            'manifestationcontributeurs',
            'etablissementsOrganisateur',
            'gestionFinanciere',
            'natureContributionManifestation'
        ));
        return $pdf->stream("Soutien_a_la_recherche_Type_B.pdf", array("Attachment" => false));
    }

    public function createRequest(Request $request)
    {



        $chercheur = $this->chercheurService->findByEmail($request->user()->email);
        $exists = $this->demandeService->isAllRapportLaboratoireExists($chercheur);

        if (!$exists) {
            return view('user/create-request', ["message" => "dsdd", 'fraisCouvert' => []]);
        }

        $etablissements = $this->etablissementService->findAll();
        $user = $request->user();
        $typeContributeurs = $this->typeContributeurService->findAll();
        $fraisCouvert = $this->fraisCouvertService->findAll();
        $natureContributions = $this->natureContributionService->findAll();
        $piecesDemande = PieceDemande::all();

        $chercheurs = $this->chercheurService->findAll();

        if ($request->isMethod('post')) {
            $data = $request->all();

            $request->validate([
                'intitule' => 'required',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after_or_equal:date_debut',
                'type' => 'required',
                'etendue' => 'required',
                'partenaires' => 'required',
                'file_nbr_etudiants_locaux' => 'required',
                'file_nbr_enseignants_locaux' => 'required',
                'nbr_etudiants_locaux' => 'required',
                'nbr_etudiants_non_locaux' => 'required',
                'nbr_enseignants_locaux' => 'required',
                'nbr_enseignants_non_locaux' => 'required',
            ]);



            $demande = new Demande();
            $demande->code = $chercheur->id_cher . "/" . $this->demandeService->countCoordonnateurDemandeByCurrentYear($chercheur) + 1 . "/" . date('Y');
            $demande->date_envoie = date('Y-m-d H:i:s');
            $demande->etat = DemandeStatus::COURANTE;
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



            $fileEtudiantsLocauxPath = Storage::disk('local')->put("manifestation_files", $data['file_nbr_etudiants_locaux']);
            $fileEtudiantsLocauxPath = $data['file_nbr_etudiants_locaux']->storeAs("manifestation_files", $request->file('file_nbr_etudiants_locaux')->getClientOriginalName());
            $fileManifestation1 = new FileManifestation();
            $fileManifestation1->titre = Str::of($request->file('file_nbr_etudiants_locaux')->getClientOriginalName())->trim('.pdf');
            $fileManifestation1->url = $fileEtudiantsLocauxPath;
            $fileManifestation1->manifestation_id = $manifestation->getAttributes()["id"];
            $fileManifestation1 = FileManifestation::create($fileManifestation1->getAttributes());

            $fileEnseignantsLocauxPath = Storage::disk('local')->put("manifestation_files", $data['file_nbr_enseignants_locaux']);
            $fileManifestation2 = new FileManifestation();
            $fileManifestation2->titre = Str::of($request->file('file_nbr_enseignants_locaux')->getClientOriginalName())->trim('.pdf');
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


            $natureContributions = $data['natureContributions'];
            for ($i = 0; $i < count($natureContributions); $i++) {
                $natureManifestation = new NatureContributionManifestation();
                $natureManifestation->manifestation_id = $manifestation->getAttributes()["id"];
                $natureManifestation->nature_con_id = $natureContributions[$i];
                $natureManifestation = NatureContributionManifestation::create($natureManifestation->getAttributes());
            }

            $contributeurs = json_decode($data['contributeurs'], true);
            for ($i = 0; $i < count($contributeurs); $i++) {
                $contributeur = Contributeur::create($contributeurs[$i]);
                $manifestationContributeur = new ManifestationContributeur();
                $manifestationContributeur->contributeur_id = $contributeur->getAttributes()['id'];
                $manifestationContributeur->manifestation_id = $manifestation->getAttributes()["id"];
                $manifestationContributeur = ManifestationContributeur::create($manifestationContributeur->getAttributes());
            }

            $contributionParticipants = json_decode($data['contributionParticipants'], true);
            for ($i = 0; $i < count($contributionParticipants); $i++) {
                $contributeurParticipant = ContributionParticipant::create($contributionParticipants[$i]);
                $manifestationContributionParticipant = new ManifestationContributionParticipant();
                $manifestationContributionParticipant->cont_par_id = $contributeurParticipant->getAttributes()['id'];
                $manifestationContributionParticipant->manifestation_id = $manifestation->getAttributes()["id"];
                $manifestationContributionParticipant = ManifestationContributionParticipant::create($manifestationContributionParticipant->getAttributes());
            }

            $comiteOrganisationLocal = $data['comiteOrganisationLocal'];
            for ($i = 0; $i < count($comiteOrganisationLocal); $i++) {
                $cl = new ComiteOrganisationLocal();
                $cl->id_cher = $comiteOrganisationLocal[$i];
                $cl['manifestation_id'] = $manifestation->getAttributes()["id"];
                ComiteOrganisationLocal::create($cl->getAttributes());
            }

            $comiteOrganisationNonLocal = json_decode($data['comiteOrganisationNonLocal'], true);
            for ($i = 0; $i < count($comiteOrganisationNonLocal); $i++) {
                $cnl = $comiteOrganisationNonLocal[$i];
                $cnl['manifestation_id'] = $manifestation->getAttributes()["id"];
                ComiteOrganisationNonLocal::create($cnl);
            }

            $comiteScientifiqueLocal = json_decode($data['comiteScientifiqueLocal'], true);
            for ($i = 0; $i < count($comiteScientifiqueLocal); $i++) {
                $csl = $comiteScientifiqueLocal[$i];
                $csl['manifestation_id'] = $manifestation->getAttributes()["id"];
                ComiteScientifiqueLocal::create($csl);
            }

            $comiteScientifiqueNonLocal = json_decode($data['comiteScientifiqueNonLocal'], true);
            for ($i = 0; $i < count($comiteScientifiqueNonLocal); $i++) {
                $csnl = $comiteScientifiqueNonLocal[$i];
                $csnl['manifestation_id'] = $manifestation->getAttributes()["id"];
                ComiteScientifiqueNonLocal::create($csnl);
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

            if ($request->has('pieces')) {
                $pieces = $data['pieces'];
                for ($i = 0; $i < count($pieces); $i++) {
                    $path = Storage::disk('local')->put("manifestation_files", $pieces[$i]);
                    $fileManifestation = new FileManifestation();
                    $fileManifestation->url = $path;
                    $fileManifestation->manifestation_id = $manifestation->getAttributes()["id"];
                    FileManifestation::create($fileManifestation->getAttributes());
                }
            }
            return redirect()->route('dashboard.user');
        }

        return view('user/create-request', ["piecesDemande" => $piecesDemande, "chercheurs" => $chercheurs, "natureContributions" => $natureContributions, "typeContributeurs" => $typeContributeurs, "etablissements" => $etablissements, 'user' => $user, 'fraisCouvert' => $fraisCouvert]);
    }

    public function uploadRapport(Request $request)
    {


        if (!$request->hasFile('rapport')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'le rapport est requis! '
                ]);
        }

        $demande = $request->all()['demande'];
        $file = $request->file('rapport');


        $manifestation = $this->manifestationService->findByDemandeId($demande);

        $fileEtudiantsLocauxPath = Storage::disk('local')->put("manifestation_files", $file);
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

    public function addFile(Request $request)
    {


        if (!$request->hasFile('file')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'le fichier est requis! '
                ]);
        }

        $demande = $request->all()['demande'];
        $file = $request->file('file');


        $manifestation = $this->manifestationService->findByDemandeId($demande);

        $fileEtudiantsLocauxPath = Storage::disk('local')->put("manifestation_files", $file);
        $fileManifestation = new FileManifestation();
        $fileManifestation->url = $fileEtudiantsLocauxPath;
        $fileManifestation->manifestation_id = $manifestation->getAttributes()["id"];
        $fileManifestation = FileManifestation::create($fileManifestation->getAttributes());
        return response()
            ->json([
                'code' => 200,
                'message' => "Le fichier est ajouté avec succès!"
            ]);
    }

    public function readRapport(Request $request)
    {

        $url = $request->route('url');
        $url = str_replace('-', '/', $url);
        $response = Common::readFileFromLocalStorage($url);
        if ($response == null) return redirect()->route('dashboard.user');
        return $response;
    }
}
