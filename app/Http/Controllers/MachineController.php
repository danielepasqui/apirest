<?php

namespace App\Http\Controllers;

use App\Machine;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class MachineController extends Controller
{
    protected $request;
	
	public function __construct(Request $request)
    {
        $this->request = $request;
    }

     public function index()
    {
		$machines = Machine::all();
		$response=array();
		foreach ($machines as $machine) {
			$response[] = [
                    'id' => $machine->mid,
                    'name' => $machine->name,
					'notes' => $machine->notes
                ];
		}
		return response()->json([
				'machines' => $response
				], 200);
    }
 
    public function show($id)
    {
		$machine = Machine::find($id);
		$response=array();
		$response = [
				'id' => $machine->mid,
				'name' => $machine->name,
				'notes' => $machine->notes
            ];
		return response()->json([
				'machine' => $response
				], 200);
    }
 
    public function destroy($id)
    {
		$machine = Machine::find($id);
		$machine->delete();
		return response()->json([
			'message' => 'machine deleted'
			], 200);
    }
 
	public function update($id){
		$machine = Machine::find($id);
		$machine->name = $this->request->input('name');
		$machine->notes = $this->request->input('notes');
		$machine->save();
		return response()->json([
				'message' => 'machine updated'
				], 200);
	}
    public function store()  {
		$machine = new Machine;
		$machine->name = $this->request->input('name');
		$machine->notes = $this->request->input('notes');
		$machine->save();
		return response()->json([
				'message' => 'machine added'
				], 201);
	}
}
