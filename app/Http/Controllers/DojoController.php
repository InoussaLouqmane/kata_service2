<?php

namespace App\Http\Controllers;

use App\Models\Dojo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DojoController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'club_id' => 'required',
            'address' => 'required',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        try{
            $dojo = new Dojo();
            $dojo->name = $request->input('name');
            $dojo->club_id = $request->input('club_id');
            $dojo->address = $request->input('address');
            $dojo->longitude = $request->input('longitude') ?? null;
            $dojo->latitude = $request->input('latitude') ?? null;




        } catch (Exception $exception) {
            Log::info("Une erreur s'est produit : ".$exception->getMessage());
            return response()->json([]);
        }

    }
}
