<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;

use HttpSocketException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class EventController extends Controller
{


    public function indexApi(){

        try {
            $events = Event::all();
            return response()->json([
                'data' => $events,
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show($id){

        try{
            $targetEvent = Event::find($id);
            return response()->json([
                'data' => $targetEvent,
            ], 200);
        }catch (QueryException | HttpSocketException | Exception $e ) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

    }

    public function updateApi(Request $request, $id){

        try{
            $event = Event::find($id);

            $event->title = $request->title;
            $event->address = $request->location;
            $event->startDate = $request->startDateTime;
            $event->endDate = $request->endDateTime;
            $event->save();
            return response()->json([
                'data' => 'Mis à jour avec succès',
            ], 200);

        }    catch (QueryException | HttpSocketException | Exception $e ) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function deleteApi($id){
        try{
            $event = Event::find($id);

            if ($event) {
                $event->delete();
            }
            return response()->json([
                'data' => 'Supprimé avec succès',
            ], 200);
        }catch (QueryException | HttpSocketException | Exception $e ) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function storeEventApi(Request $request){
        $request->validate([
            'eventID' => 'required',
            'title' => 'required',
            'startDateTime' => 'required',
            'endDateTime' => 'required',
        ]);
        try{
            $event = new Event();
            $event->uiid = $request->eventID;
            $event->address = $request->location;
            $event->title = $request->title;
            $event->startDate = $request->startDateTime;
            $event->endDate = $request->endDateTime;
            $event->save();
            return response()->json([
                'data' => $event->id,
            ], 201);
        }catch (QueryException | Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 400);
        }
    }
}
