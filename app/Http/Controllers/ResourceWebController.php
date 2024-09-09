<?php

namespace App\Http\Controllers;


use App\Models\Resource;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ResourceWebController extends Controller
{

    public function extractYouTubeID($url)
    {
        // Utilisation d'une expression régulière pour extraire l'ID de la vidéo
        preg_match('/(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+v=([^&]+)|youtu\.be\/([^&?]+)/', $url, $matches);

        // L'ID est dans la position 4 ou 5
        return isset($matches[4]) ? $matches[4] : (isset($matches[5]) ? $matches[5] : null);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'type' => 'nullable',
            'videoLink' => 'required',
            'grades' => 'required'
        ]);

        $youtubeID = $this->extractYouTubeID($request->videoLink);
        $embedLink = "https://www.youtube.com/embed/" . $youtubeID;
        try {

            $resource = Resource::create([
                Resource::TITLE => $request->title,
                Resource::DESCRIPTION => $request->description,
                Resource::TYPE => $request->type,
                Resource::VIDEO_LINK => $embedLink,
            ]);


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
            'grades' => 'nullable'
        ]);
        $youtubeID = $this->extractYouTubeID($request->videoLink);
        $embedLink = "https://www.youtube.com/embed/" . $youtubeID;

        try {

            $resource = Resource::find($id);
            $resource->update([
                Resource::TITLE => $request->title,
                Resource::DESCRIPTION => $request->description,
                Resource::TYPE => $request->type,
                Resource::VIDEO_LINK => $embedLink,
            ]);

            $resource->grades()->sync($request->grades);

            return redirect()->back()->with('success', 'Resource updated');

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
