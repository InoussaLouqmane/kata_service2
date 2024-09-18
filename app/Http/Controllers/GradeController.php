<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class GradeController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([

            'beltColor' => 'required|string',
            'beltName'=> 'required|string',
            'numberOfRedBar' => 'nullable|string',
            'numberOfWhiteBar' => 'nullable|string',
            'numberOfYellowBar' => 'nullable',
            'beltPicturePath' => 'nullable',

        ]);

        try {

            $grade = new Grade();

            $grade->beltName = $request->input('beltName');
            $grade->beltColor = $request->input('beltColor');
            $grade->numberOfRedBar = $request->input('numberOfRedBar');
            $grade->numberOfWhiteBar = $request->input('numberOfWhiteBar');
            $grade->numberOfYellowBar = $request->input('numberOfYellowBar');

            if ($request->beltPicturePath) {
                $path = $request->file('beltPicturePath')->store('images', 'public');
                $grade->beltPicturePath = $path;
            }
            $grade->save();
            return redirect()->route('main.grade.grades')->with('success', 'Grade créé avec succès');

        } catch (Exception $exception) {
            Log::info("Une erreur s'est produite au niveau des grades : " . $exception->getMessage());
            return redirect()->route('main.grade.grades')->with('fail', 'Oops, une erreur est survenue');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'beltColor' => 'required|string',
            'beltName' => 'required|string',
            'numberOfRedBar' => 'nullable|string',
            'numberOfWhiteBar' => 'nullable|string',
            'numberOfYellowBar' => 'nullable',
            'beltPicturePath' => 'nullable',
        ]);

        $find = $request->input('id');
        $grade = Grade::find($find);

        try {
            $grade->beltColor = $request->input('beltColor');
            $grade->beltName = $request->input('beltName');
            $grade->numberOfRedBar = $request->input('numberOfRedBar');
            $grade->numberOfWhiteBar = $request->input('numberOfWhiteBar');
            $grade->numberOfYellowBar = $request->input('numberOfYellowBar');

            if ($request->beltPicturePath) {

                if ($grade->beltPicturePath) {
                    Storage::disk('public')->delete($grade->beltPicturePath);
                }
                $path = $request->file('beltPicturePath')->store('images', 'public');
                $grade->beltPicturePath = $path;
            }

            $grade->save();

            return redirect()->back()->with('success', 'Grade mis à jour avec succès');

        } catch (Exception $exception) {
            Log::info("Une erreur s'est produite durant l'update : " . $exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur est survenue');
        }

    }

    public function delete(Request $request)
    {
        try {
            $grade = Grade::find($request->input('id'));
            $grade->delete();
            return redirect()->back()->with('success', 'Grade supprimé avec succès');
        } catch (Exception $exception) {
            Log::info("Une erreur s'est produite durant l'update : " . $exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur est survenue');
        }
    }

}
