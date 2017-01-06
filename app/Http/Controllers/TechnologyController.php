<?php

namespace App\Http\Controllers;

use App\Technology;
use Illuminate\Http\Request;
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
		$response=array();
		foreach ($technologies as $technology) {
			$response[] = [
                    'id' => $technology->tid,
                    'name' => $technology->name,
					'notes' => $technology->notes
                ];
		}
		return response()->json([
				'technologies' => $response
				], 200);
    }
 
    public function show($id)
    {
		$technology = Technology::find($id);
		$response=array();
		$response = [
				'id' => $technology->tid,
				'name' => $technology->name,
				'notes' => $technology->notes
            ];
		return response()->json([
				'technology' => $response
				], 200);
    }
 
    public function destroy($id)
    {
		$technology = Technology::find($id);
		$technology->delete();
		return response()->json([
			'message' => 'technology deleted'
			], 200);
    }
 
	public function update($id){
		$technology = Technology::find($id);
		$technology->name = $this->request->input('name');
		$technology->notes = $this->request->input('notes');
		$technology->save();
		return response()->json([
				'message' => 'technology updated'
				], 200);
	}
    public function store()  {
		$technology = new Technology;
		$technology->name = $this->request->input('name');
		$technology->notes = $this->request->input('notes');
		$technology->save();
		return response()->json([
				'message' => 'technology added'
				], 201);
	}
}
