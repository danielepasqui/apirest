<?php

namespace App\Http\Controllers;

use App\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DatabaseController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Database $Database)
    {
        $databases = $Database->all();

        return response()->json([
                'databases' => $databases,
                ], 200);
    }

    public function show($id, Database $Database)
    {
        $database = $Database->find($id);

        return response()->json([
                'database' => $database,
                ], 200);
    }

    public function destroy($id, Database $Database)
    {
        $Database->destroy($id);
        Log::info('database '.$id.' deleted');

        return response()->json([
            'message' => 'database deleted',
            ], 200);
    }

    public function update($id, Database $Database)
    {
        $database = $Database->find($id);
        $database->update($this->request->all());
        $url = route('databases.show', ['id' => $database->id]);
        Log::info('database '.$database->id.' updated');

        return response()->json([
                'message' => 'database updated',
                'database' => $url,
                ], 200);
    }

    public function store(Database $Database)
    {
        $database = new $Database();
        $id = $database->create($this->request->all())->id;
        $url = route('databases.show', ['id' => $id]);
        Log::info('database '.$id.' added');

        return response()->json([
                'message' => 'database added',
                'database' => $url,
                ], 201);
    }
}
