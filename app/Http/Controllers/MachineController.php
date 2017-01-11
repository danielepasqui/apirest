<?php

namespace App\Http\Controllers;

use App\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
		return response()->json([
				'machines' => $machines
				], 200);
    }
 
    public function show($id)
    {
		$machine = Machine::find($id);
		return response()->json([
				'machine' => $machine
				], 200);
    }
 
    public function destroy($id)
    {
		$machine = Machine::find($id)->delete();

		Log::info('machine '.$id.' deleted');

		return response()->json([
			'message' => 'machine deleted'
			], 200);
    }
 
	public function update($id){
		$machine = Machine::find($id);
		$machine->name = $this->request->input('name');
		$machine->notes = $this->request->input('notes');
		$machine->save();

		$url = route('machines.show', ['id' => $machine->mid]);

		Log::info('machine '.$machine->mid.' updated');

		return response()->json([
				'message' => 'machine updated',
				'machine' => $url
				], 200);
	}
    public function store()  {
		$machine = new Machine;
		$machine->name = $this->request->input('name');
		$machine->notes = $this->request->input('notes');
		$machine->save();

		$url = route('machines.show', ['id' => $machine->mid]);

		Log::info('machine '.$machine->mid.' added');

		return response()->json([
				'message' => 'machine added',
				'machine' => $url
				], 201);
	}
}
