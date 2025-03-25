<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function list($id): \Illuminate\Http\JsonResponse
    {



        try {
            $events = Event::all();
            return response()->json([
                $events,
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
