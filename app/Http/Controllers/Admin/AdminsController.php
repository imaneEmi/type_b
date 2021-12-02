<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin/liste_demandes', $demandeService->findByEtat('Refusée',$manifestationService));
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
}
