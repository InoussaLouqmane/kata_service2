<?php

namespace App\Http\Controllers;

use App\Enums\DojoStatus;
use App\Models\Discipline;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DisciplineController extends Controller
{
    public function list(){
        try {

            $disciplines = Discipline::all();
            return response()->json($disciplines);
        }catch (QueryException | \HttpSocketException | Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);


        $discipline = new Discipline();

        try {
            $discipline->name = $request->input('name');
            $discipline->save();

            return redirect()->route('main.subject.subjects')->with('success', 'Discipline créée avec succès');
        } catch (QueryException $exception) {
            return redirect()->back()->with('Oops, une erreur s\'est produite :', $exception->getMessage());
        } catch (Exception $exception) {
            return redirect()->back()->with('Oops, une erreur est survenue : ', $exception->getMessage());
        }
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $discipline = Discipline::findOrFail($request->id);

        try {

            $discipline->name = $request->name ?? $discipline->name;
            $discipline->save();
            return redirect()->route('main.subject.subjects')->with('success', 'Discipline créée avec succès');

        } catch (QueryException $exception) {
            Log::error('Error lors de la modification de la discipline : ' . $exception->getMessage());
            return redirect()->route('main.subject.subjects')->with('Oops, une erreur s\'est produite :', $exception->getMessage());
        } catch (Exception $exception) {
            Log::error('Error lors de la désactivation de la discipline : ' . $exception->getMessage());
            return redirect()->back()->with('Oops, une erreur s\'est produite :', $exception->getMessage());

        }

    }

    public function activateDiscipline(Request $request)
    {

        $discipline = Discipline::findOrFail($request->id);
        try {

            $discipline->status = DojoStatus::ACTIVE;
            $discipline->save();
        } catch (QueryException $exception) {
            Log::error('Error lors de l\'activation de la discipline : ' . $exception->getMessage());
            return redirect()->back()->with('Oops, une erreur s\'est produite :', $exception->getMessage());
        } catch (Exception $exception) {
            return redirect()->back()->with('Oops, une erreur s\'est produite :', $exception->getMessage());

        }

    }

    public function desactivateDiscipline(Request $request)
    {

        $discipline = Discipline::findOrFail($request->id);
        try {

            $discipline->status = DojoStatus::INACTIVE;
            $discipline->save();
        } catch (QueryException $exception) {
            Log::error('Error lors de la désactivation de la discipline : ' . $exception->getMessage());
            return redirect()->back()->with('Oops, une erreur s\'est produite :', $exception->getMessage());
        } catch (Exception $exception) {
            Log::error('Error lors de la désactivation de la discipline : ' . $exception->getMessage());
            return redirect()->back()->with('Oops, une erreur s\'est produite :', $exception->getMessage());

        }

    }
}
