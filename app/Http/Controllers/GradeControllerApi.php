<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Grade;
use App\Models\Grade_User;
use App\Models\User;
use HttpSocketException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GradeControllerApi extends Controller
{
    public function index(){
        $grades = Grade::all();
        return response()->json([
            'grades' => $grades
        ]);
    }

    public function show(Request $request, $id)
    {
        $request->validate([
            'clubId' => 'required',
        ]);
        try {
            // Recherche du grade par ID
            $grade = Grade::findOrFail($id);

            /**
             * Récupérer tous les étudiants ayant un grade inférieur à notre grade de 1 au moins
             * et de 2 au plus. Ex : si notre grade est de 7, on renvoie tous les étudiants ayant
             * les grades 6 et 5
             **/



            $elligibleStudents = User::where('role', Role::STUDENT)
                ->whereHas('clubs', function ($query) use ($request) {
                    $query->where('club_id', $request->clubId);
                })
                ->whereHas('grades', function ($query) use ($request) {
                   $query->whereBetween('grade_id', [$request->gradeId+1, $request->gradeId+2]);
                })
                ->get(['id', 'firstName', 'lastName']);


            // Retourner les résultats
            return response()->json([
                $elligibleStudents
            ], 200);
        } catch (ModelNotFoundException | QueryException | HttpSocketException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

}
