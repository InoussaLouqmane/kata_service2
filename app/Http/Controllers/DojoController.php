<?php

namespace App\Http\Controllers;

use App\Enums\DojoStatus;
use App\Models\Dojo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DojoController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name' => 'required|string',
            'club_id' => 'required|string',
            'address' => 'required|string',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        try{
            $dojo = new Dojo();
            $this->extracted($request, $dojo);
            $dojo->status = DojoStatus::ACTIVE;

            $dojo->save();

            return redirect()->route('main.dojo.dojos')->with('success', 'Dojo créé avec succès');


        } catch (Exception $exception) {
            Log::info("Une erreur s'est produit : ".$exception->getMessage());
            return redirect()->route('main.dojo.dojos')->with('fail', 'Oops, une erreur est survenue');
        }

    }

    public function updateDojoInformations(Request $request){
        $request->validate([
            'name' => 'required|string',
            'club_id' => 'required|string',
            'address' => 'required|string',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);
        try {

        Log::info('ça vient jusqu\'ici');
        $dojo = Dojo::findOrFail($request->input('id'));


        $this->extracted($request, $dojo);

        if($dojo->isDirty()){
            $dojo->save();
            return redirect()->back()->with('success', 'Le Dojo a bien été mis à jour');

        }else {
            return redirect()->back()->with('success', 'Aucun changement détecté');
        }
        } catch (QueryException $exception) {
            Log::error("Mise à jour du Dojo échouée : " . $exception->getMessage());
            return redirect()->route('main.dojo.dojos')->withErrors(['fail' => 'Oops, une erreur s\'est produite. Veuillez réessayer']);
        } catch (Exception $exception) {
            Log::error("Mise à jour du Dojo échouée : " . $exception->getMessage());
            return redirect()->route('main.dojo.dojos')->withErrors(['fail' => 'Oops, une erreur s\'est produite.']);
        }


    }

    public function activateDojo(Request $request){
        $dojo = Dojo::findOrFail($request->id);

        try {
            $dojo->status = DojoStatus::ACTIVE;
            $dojo->save();
            return redirect()->back()->with('success', 'Le Dojo a bien été activé');
        } catch (QueryException $exception) {
            Log::error('Error dans la requête : '.$exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur est survenue');
        } catch (Exception $exception) {
            Log::error('Une erreur inconnue dans l\'activation du club : '.$exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur est survenue : '.$exception->getMessage());
        }

    }
    public function desactivateDojo(Request $request){
        $dojo = Dojo::findOrFail($request->id);

        try {
            $dojo->status = DojoStatus::INACTIVE;
            $dojo->save();
            return redirect()->back()->with('success', 'Le Dojo a bien été désactivé');
        } catch (QueryException $exception) {
            Log::error('Error dans la requête : '.$exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur est survenue');
        } catch (Exception $exception) {
            Log::error('Une erreur inconnue dans la désactivation du club : '.$exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur est survenue : '.$exception->getMessage());
        }

    }

    /**
     * @param Request $request
     * @param $dojo
     * @return void
     */
    public function extracted(Request $request, $dojo): void
    {
        $dojo->name = $request->input('name');
        $dojo->club_id = $request->input('club_id');
        $dojo->address = $request->input('address');
        $dojo->longitude = $request->input('longitude') ?? null;
        $dojo->latitude = $request->input('latitude') ?? null;
    }
}
