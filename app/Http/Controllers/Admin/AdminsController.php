<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoutienAccorde;
use App\Services\ManifestationService;
use App\Services\DemandeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getManifestation($id, ManifestationService $manifestationService, DemandeService $demandeService)
    {
        return view('admin/edit_demande', $manifestationService->getManifestation($id, $demandeService));
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
            for ($i=0; $i < sizeof($request->forfait_id); $i++) {
                $soutienAccorde->nbr = $request->nbrOk[$i];
                $soutienAccorde->montant = $request->montantOk[$i];
                $soutienAccorde->frais_couvert_id= $request->forfait_id[$i];
                $soutienAccorde->manifestation_id = $request->manifestation;
                SoutienAccorde::create($soutienAccorde->getAttributes());
            }
            $demandeService->changeEtat($request->demande,'Acceptée');
            $msg = "Demande acceptée";
            return redirect('/demandes-acceptees');
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return redirect()->back();
        }
    }

    public function getManifestationDetails($id, ManifestationService $manifestationService, DemandeService $demandeService)
    {
        return view('admin/manif_details', $manifestationService->getManifestationDetails($id, $demandeService));
    }

    public function getDemandesCourantes(DemandeService $demandeService,ManifestationService $manifestationService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat('Courante',$manifestationService));
    }

    public function getDemandesAcceptees(DemandeService $demandeService,ManifestationService $manifestationService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat('Acceptée',$manifestationService));
    }
    public function getDemandesResfusees(DemandeService $demandeService,ManifestationService $manifestationService)
    {
        return view('admin/liste_demandes', $demandeService->findByEtat('Refusée'));
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
    public function archive(DemandeService $demandeService)
    {

        return view('admin/archive',$demandeService->findAll());
    }
}
