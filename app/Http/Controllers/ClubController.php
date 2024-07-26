<?php

namespace App\Http\Controllers;

use App\Models\Club;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ClubController extends Controller
{
    public function index()
    {
        return Club::all();
    }

    public function store(Request $request)
    {


        try {
            $club = new Club();
            $this->extracted($request, $club);

            if ($request->hasFile('clubLogoPath')) {
                $path = $request->file('clubLogoPath')->store('images', 'public');
                $club->logoPath = $path;
            }
            $club->save();

            return redirect(route('main.department.departments'))->with('success', 'Le club a bien été ajouté');
        } catch (QueryException $e) {

            Log::error("Enregistrement du club échoué : " . $e->getMessage());
            return redirect()->back()->withErrors(['fail' => 'Oops, une erreur s\'est produite. Email déjà utilisé.']);

        } catch (Exception $e) {

            Log::error("Enregistrement du club échoué : " . $e->getMessage());
            return redirect()->back()->withErrors(['fail' => 'Oops, une erreur s\'est produite.']);
        }
    }




    public function updateClubInformation(Request $request)
    {
        try {

            $id = $request->input('id');
            $club = Club::findOrFail($id);


            $this->extracted($request, $club);

            if ($request->hasFile('clubLogoPath')) {
                 /*Supprimer l'ancien fichier s'il existe*/
                if ($club->logoPath) {
                    Storage::disk('public')->delete($club->logoPath);
                }

                // Enregistrer le nouveau fichier
                $path = $request->file('clubLogoPath')->store('images', 'public');
                $club->logoPath = $path;
            }

            if ($club->isDirty()) {
                $club->save();
                return redirect(route('main.department.departments'))->with('success', 'Le club a bien été mis à jour');
            } else {
                return redirect(route('main.department.departments'))->with('info', 'Aucun changement détecté');
            }
        } catch (QueryException $e) {
            Log::error("Mise à jour du club échouée : " . $e->getMessage());
            return redirect()->back()->withErrors(['fail' => 'Oops, une erreur s\'est produite. Email déjà utilisé.']);
        } catch (Exception $e) {
            Log::error("Mise à jour du club échouée : " . $e->getMessage());
            return redirect()->back()->withErrors(['fail' => 'Oops, une erreur s\'est produite.']);
        }
    }

    /**
     * @param Request $request
     * @param $club
     * @return void
     */
    public function extracted(Request $request, $club): void
    {
        $club->name = $request->clubName;
        $club->ifuNumber = $request->ClubIfuNumber ?? null;
        $club->RegisteredBy = $request->user_id ?? null;
        $club->martialArtType = $request->martialArtType ?? null;
        $club->email = $request->clubEmail ?? null;
        $club->description = $request->clubDescription ?? null;
        $club->websiteUrl = $request->ClubWebsiteUrl ?? null;
        $club->address = $request->clubAddress ?? null;
    }

}
