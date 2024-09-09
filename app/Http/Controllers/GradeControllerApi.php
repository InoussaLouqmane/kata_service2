<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeControllerApi extends Controller
{
    public function index(){
        $grades = Grade::all();
        return response()->json([
            'grades' => $grades
        ]);
    }
}
