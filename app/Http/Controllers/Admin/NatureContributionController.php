<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NatureContribution;
use Illuminate\Http\Request;

class NatureContributionController extends Controller
{

    public function index()
    {

        return view('admin/nature_contribution', ["natureContribution" => NatureContribution::all()]);
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



        $natureContribution = new NatureContribution();

        $natureContribution->libelle = $request->all()['libelle'];

        NatureContribution::create($natureContribution->getAttributes());

        return response()
            ->json([
                'code' => 200,
                'message' => "créé!"
            ]);
    }


    public function delete(Request $request, $id)
    {

        $natureContribution =  NatureContribution::findOrFail($id);
        $natureContribution->delete();

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



        $natureContribution =  NatureContribution::findOrFail($request->all()['id']);
        $natureContribution->libelle = $request->all()['libelle'];

        $natureContribution->update();

        return response()
            ->json([
                'code' => 200,
                'message' => "La pièce a été modifiée!"
            ]);
    }
}
