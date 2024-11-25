<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class pdfController extends Controller
{
    public function generateConvocation($user_id, $exam_id, $grade_id, $cost){

        $pdf = Pdf::loadView('generatedPdf.examconvocation',
            ['user_id' => $user_id, 'exam_id' => $exam_id, 'grade_id'=>$grade_id,'cost' =>$cost] );

        Log::info('on va télécharger le pdf');
        return $pdf->download('exam_report.pdf');
    }

    public function generateBulletin($user_id, $exam_id, $grade_id, $cost){

        $pdf = Pdf::loadView('generatedPdf.exambulletin',
            ['user_id' => $user_id, 'exam_id' => $exam_id, 'grade_id'=>$grade_id,'cost' =>$cost] );

        Log::info('on va télécharger le bulletin');
        return $pdf->download('exam_report.pdf');
    }

    public function generateFacture($user_id, $exam_id, $cost){

        $pdf = Pdf::loadView('generatedPdf.exambulletin',
            ['user_id' => $user_id, 'exam_id' => $exam_id, 'cost' =>$cost] );

        Log::info('on va télécharger le facture');
        return $pdf->download('facture.pdf');
    }
}
