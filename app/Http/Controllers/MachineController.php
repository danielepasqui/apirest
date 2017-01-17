<?php

namespace App\Http\Controllers;

use App\Machine;
use App\Http\Requests\StoreMachine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MachineController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Machine $Machine)
    {
        $machines = $Machine->all();

        return response()->json([
                'machines' => $machines,
                ], 200);
    }

    public function show($id, Machine $Machine)
    {
        $machine = $Machine->find($id);

        return response()->json([
                'machine' => $machine,
                ], 200);
    }

    public function destroy($id, Machine $Machine)
    {
        $Machine->destroy($id);
        Log::info('machine '.$id.' deleted');

        return response()->json([
            'message' => 'machine deleted',
            ], 200);
    }

    public function update($id, Machine $Machine, StoreMachine $request)
    {
        $machine = $Machine->find($id);
        $machine->update($this->request->all());
        $url = route('machines.show', ['id' => $machine->id]);
        Log::info('machine '.$machine->id.' updated');

        return response()->json([
                'message' => 'machine updated',
                'machine' => $url,
                ], 200);
    }

    public function store(Machine $Machine, StoreMachine $request)
    {
        $machine = new $Machine();
        $id = $machine->create($this->request->all())->id;
        $url = route('machines.show', ['id' => $id]);
        Log::info('machine '.$id.' added');

        return response()->json([
                'message' => 'machine added',
                'machine' => $url,
                ], 201);
    }
}
