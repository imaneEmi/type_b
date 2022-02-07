<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PieceDemande;
use App\Services\BudgetAnnuelService;
use Illuminate\Http\Request;

class PieceDemandeController extends Controller
{

    public function index()
    {

        return view('admin/pieces_demandee', ["piecesDemande" => PieceDemande::all()]);
    }

    public function create(Request $request)
    {
        if (!$request->filled('libelle')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'Libelle est requis! '
                ]);
        }
        if (!$request->filled('description')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'Description est requis! '
                ]);
        }


        $pieceDemandee = new PieceDemande();

        $pieceDemandee->libelle = $request->all()['libelle'];
        $pieceDemandee->description = $request->all()['description'];

        PieceDemande::create($pieceDemandee->getAttributes());

        return response()
            ->json([
                'code' => 200,
                'message' => "La pièce a été créé!"
            ]);
    }


    public function delete(Request $request, $id)
    {

        $pieceDemande =  PieceDemande::findOrFail($id);
        $pieceDemande->delete();

        return response()
            ->json([
                'code' => 200,
                'message' => ""
            ]);
    }


    public function update(Request $request)
    {
        if (!$request->filled('libelle')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'Libelle est requis! '
                ]);
        }
        if (!$request->filled('description')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'Description est requis! '
                ]);
        }


        $pieceDemandee =  PieceDemande::findOrFail($request->all()['id']);
        $pieceDemandee->libelle = $request->all()['libelle'];
        $pieceDemandee->description = $request->all()['description'];

        $pieceDemandee->update();

        return response()
            ->json([
                'code' => 200,
                'message' => "La pièce a été modifiée!"
            ]);
    }
}
