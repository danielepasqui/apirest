<?php

namespace App\Http\Controllers;

use App\Technology;
use App\Http\Requests\StoreTechnology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TechnologyController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Technology $Technology)
    {
        $technologies = $Technology->all();

        return response()->json([
                'technologies' => $technologies,
                ], 200);
    }

    public function show($id, Technology $Technology)
    {
        $technology = $Technology->find($id);

        return response()->json([
                'technology' => $technology,
                ], 200);
    }

    public function destroy($id, Technology $Technology)
    {
        $Technology->destroy($id);
        Log::info('Technology '.$id.' deleted');

        return response()->json([
            'message' => 'technology deleted',
            ], 200);
    }

    public function update($id, Technology $Technology, StoreTechnology $request)
    {
        $technology = $Technology->find($id);
        $technology->update($this->request->all());
        Log::info('Technology '.$technology->id.' updated');
        $url = route('technologies.show', ['id' => $technology->id]);

        return response()->json([
                'message' => 'technology updated',
                'technology' => $url,
                ], 200);
    }

    public function store(Technology $Technology, StoreTechnology $request)
    {
        $technology = new $Technology();
        $technology = $technology->create($this->request->all());
        Log::info('Technology '.$technology->id.' added');
        $url = route('technologies.show', ['id' => $technology->id]);

        return response()->json([
                'message' => 'technology added',
                'technology' => $url,
                ], 201);
    }
}
