<?php

namespace App\Http\Controllers;

use App\Enums\DojoStatus;
use App\Models\Discipline;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'grades' => 'required'
        ]);


        try{

            DB::transaction(function () use ($request) {

                $discipline = new Discipline();
                $discipline->name = $request->name;
                $discipline->description = $request->description;
                $discipline->save();

                foreach ($request->grades as $grade) {
                    $discipline->grades()->create([
                        'beltColor' => $grade['beltColor'],
                        'beltName' => $grade['beltName'],
                    ]);
                }
            });
            return response()->json([
                'message' => 'Discipline added successfully'
            ],201);
        }catch (QueryException | \HttpSocketException | Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'grades' => 'required'
        ]);


        try {

            DB::transaction(function () use ($request, $id) {

                $discipline = Discipline::findOrFail($id);
                $discipline->update([
                    'name'=> $request->name,
                    'description'=> $request->description,
                ]);

                $discipline->grades()->delete();
                foreach ($request->grades as $grade) {

                    $discipline->grades()->create([
                        'beltColor' => $grade['beltColor'],
                        'beltName' => $grade['beltName'],
                    ]);
                }


            });
            return response()->json([
                'message' => 'Discipline updated successfully'
            ],200);
        }catch (QueryException | \HttpSocketException | Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }



    }

    public function show($id){


        try{

            $discipline = Discipline::findOrFail($id);
            $grades = $discipline->grades;

            return response()->json([
                $grades,
            ],200);
        }catch (QueryException | \HttpSocketException | Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function destroy($id){

        try {
            DB::transaction(function () use ($id) {
                $discipline = Discipline::findOrFail($id);

                $discipline->grades()->delete();
                $discipline->delete();
            });


            return response()->json([
                'message' => 'Discipline deleted successfully'
            ],200);
        }catch (QueryException | \HttpSocketException | Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
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
