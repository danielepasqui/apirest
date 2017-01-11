<?php

namespace App\Http\Controllers;

use App\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Routing\ResponseFactory;

class DatabaseController extends Controller
{
    protected $request;
	
	public function __construct(Request $request)
    {
        $this->request = $request;
    }

     public function index()
    {
		$databases = Database::all();
		return response()->json([
				'databases' => $databases
				], 200);
    }
 
    public function show($id)
    {
		$database = Database::find($id);
		return response()->json([
				'database' => $database
				], 200);
    }
 
    public function destroy($id)
    {
		$database = Database::find($id)->delete();

		Log::info('database '.$id.' deleted');

		return response()->json([
			'message' => 'database deleted'
			], 200);
    }

	public function update($id){
		$database = Database::find($id);
		$database->host = $this->request->input('host');
		$database->username = $this->request->input('username');
		$database->password = $this->request->input('password');
		$database->db_name = $this->request->input('db_name');
		$database->save();

		$url = route('databases.show', ['id' => $database->did]);

		Log::info('database '.$database->did.' updated');

		return response()->json([
				'message' => 'database updated',
				'database' => $url
				], 200);
	}
    public function store()  {
		$database = new Database;
		$database->host = $this->request->input('host');
		$database->username = $this->request->input('username');
		$database->password = $this->request->input('password');
		$database->db_name = $this->request->input('db_name');
		$database->save();

		$url = route('databases.show', ['id' => $database->did]);

		Log::info('database '.$database->did.' added');

		return response()->json([
				'message' => 'database added',
				'database' => $url
				], 201);
	}
}
