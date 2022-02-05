<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FraisCouvert;
use Illuminate\Http\Request;

class FraisCouvetController extends Controller
{

    public function index()
    {

        return view('admin/frais_couvert', ["fraisCouvert" => FraisCouvert::all()]);
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

        if (!$request->filled('forfait')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'forfait est requis! '
                ]);
        }



        $fraisCouvert = new FraisCouvert();

        $fraisCouvert->libelle = $request->all()['libelle'];
        $fraisCouvert->description = $request->all()['description'];
        $fraisCouvert->forfait = $request->all()['forfait'];
        $fraisCouvert->unite = $request->all()['unite'];
        $fraisCouvert->limite = $request->all()['limite'];
        $fraisCouvert->remarques = $request->all()['remarques'];

        FraisCouvert::create($fraisCouvert->getAttributes());

        return response()
            ->json([
                'code' => 200,
                'message' => "créé!"
            ]);
    }


    public function delete(Request $request, $id)
    {

        $fraisCouvert =  FraisCouvert::findOrFail($id);
        $fraisCouvert->delete();

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

        if (!$request->filled('forfait')) {
            return response()
                ->json([
                    'code' => 500,
                    'message' => 'forfait est requis! '
                ]);
        }





        $fraisCouvert =  FraisCouvert::findOrFail($request->all()['id']);
        $fraisCouvert->libelle = $request->all()['libelle'];
        $fraisCouvert->description = $request->all()['description'];
        $fraisCouvert->forfait = $request->all()['forfait'];
        $fraisCouvert->unite = $request->all()['unite'];
        $fraisCouvert->limite = $request->all()['limite'];
        $fraisCouvert->remarques = $request->all()['remarques'];
        $fraisCouvert->update();

        return response()
            ->json([
                'code' => 200,
                'message' => "modifiée!"
            ]);
    }
}
