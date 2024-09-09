<?php

namespace App\Http\Controllers;


use App\Models\Resource;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResourceApiController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'type' => 'nullable',
            'videoLink' => 'required',
            'grades' => 'nullable'
        ]);




        try {

            $resource = Resource::create([

                Resource::TITLE => $request->title,
                Resource::DESCRIPTION => $request->description,
                Resource::TYPE => $request->type,
                Resource::VIDEO_LINK => $request->videoLink,

            ]);

            if($request->grades)
            $resource->grades()->attach($request->grades);

            return response()->json([
                'resource' => $resource,
            ], 200);
        } catch (Exception|QueryException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'type' => 'nullable',
            'videoLink' => 'required',
            'grades' => 'required'
        ]);

        try {

            $resource = Resource::find($id);
            $resource->update([
                Resource::TITLE => $request->title,
                Resource::DESCRIPTION => $request->description,
                Resource::TYPE => $request->type,
                Resource::VIDEO_LINK => $request->videoLink,
            ]);

            $resource->grades()->sync($request->grades);

            return response()->json([
                'resource' => $resource,
            ], 200);


        } catch (Exception|QueryException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function delete($id)
    {
        try {
            $resource = Resource::findOrFail($id);
            $resource->grades()->detach();
            $resource->delete();
            return response()->json([
                'resource' => $resource,
            ], 200);


        } catch (ModelNotFoundException $e) {
            // Gestion de l'exception si la ressource n'est pas trouvée
            return response()->json([
                'message' => 'Resource not found',
            ], 404);

        } catch (Exception|QueryException $exception) {
            // Gestion des autres exceptions
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

}
