<?php

namespace App\Http\Controllers;

use App\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Routing\ResponseFactory;

class TechnologyController extends Controller
{
    protected $request;
	
	public function __construct(Request $request)
    {
        $this->request = $request;
    }

     public function index()
    {
		$technologies = Technology::all();
		return response()->json([
				'technologies' => $technologies
				], 200);
    }
 
    public function show($id)
    {
		$technology = Technology::find($id);
		return response()->json([
				'technology' => $technology
				], 200);
    }
 
    public function destroy($id)
    {
		$technology = Technology::find($id)->delete();

		Log::info('Technology '.$id.' deleted');

		return response()->json([
			'message' => 'technology deleted'
			], 200);
    }
 
	public function update($id){
		$technology = Technology::find($id);
		$technology->name = $this->request->input('name');
		$technology->notes = $this->request->input('notes');
		$technology->save();

		Log::info('Technology '.$technology->tid.' updated');

		$url = route('technologies.show', ['id' => $technology->tid]);
		return response()->json([
				'message' => 'technology updated',
				'technology' => $url
				], 200);
	}
    public function store()  {
		$technology = new Technology;
		$technology->name = $this->request->input('name');
		$technology->notes = $this->request->input('notes');
		$technology->save();

		Log::info('Technology '.$technology->tid.' added');

		$url = route('technologies.show', ['id' => $technology->tid]);
		return response()->json([
				'message' => 'technology added',
				'technology' => $url
				], 201);
	}
}
