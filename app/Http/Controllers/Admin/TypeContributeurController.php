<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PieceDemande;
use App\Models\TypeContributeur;
use App\Services\BudgetAnnuelService;
use Illuminate\Http\Request;

class TypeContributeurController extends Controller
{

    public function index()
    {

        return view('admin/type_contributeur', ["typeContributeurs" => TypeContributeur::all()]);
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



        $typeContributeur = new TypeContributeur();

        $typeContributeur->libelle = $request->all()['libelle'];

        TypeContributeur::create($typeContributeur->getAttributes());

        return response()
            ->json([
                'code' => 200,
                'message' => "créé!"
            ]);
    }


    public function delete(Request $request, $id)
    {

        $typeContributeur =  TypeContributeur::findOrFail($id);
        $typeContributeur->delete();

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



        $typeContributeur =  TypeContributeur::findOrFail($request->all()['id']);
        $typeContributeur->libelle = $request->all()['libelle'];

        $typeContributeur->update();

        return response()
            ->json([
                'code' => 200,
                'message' => "La pièce a été modifiée!"
            ]);
    }
}
