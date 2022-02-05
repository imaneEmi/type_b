<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConditionsGenerale;
use Illuminate\Http\Request;

class ConditionsGeneraleController extends Controller
{

    public function index()
    {

        return view('admin/conditions_generale', ["conditionsGenerale" => ConditionsGenerale::all()]);
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


        $conditionsGeneralee = new ConditionsGenerale();

        $conditionsGeneralee->libelle = $request->all()['libelle'];
        $conditionsGeneralee->description = $request->all()['description'];

        ConditionsGenerale::create($conditionsGeneralee->getAttributes());

        return response()
            ->json([
                'code' => 200,
                'message' => "créé!"
            ]);
    }


    public function delete(Request $request, $id)
    {

        $conditionsGeneralee =  ConditionsGenerale::findOrFail($id);
        $conditionsGeneralee->delete();

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


        $conditionsGeneralee =  ConditionsGenerale::findOrFail($request->all()['id']);
        $conditionsGeneralee->libelle = $request->all()['libelle'];
        $conditionsGeneralee->description = $request->all()['description'];

        $conditionsGeneralee->update();

        return response()
            ->json([
                'code' => 200,
                'message' => " modifiée!"
            ]);
    }
}
