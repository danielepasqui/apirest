<?php

namespace App\Http\Controllers;

use App\Database;
use Illuminate\Http\Request;
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
		$response=array();
		foreach ($databases as $database) {
			$response[] = [
                    'id' => $database->did,
                    'host' => $database->host,
					'username' => $database->username,
					'password' => $database->password,
					'db_name' => $database->db_name
                ];
		}
		return response()->json([
				'databases' => $response
				], 200);
    }
 
    public function show($id)
    {
		$database = Database::find($id);
		$response=array();
		$response = [
				'id' => $database->did,
				'host' => $database->host,
				'username' => $database->username,
				'password' => $database->password,
				'db_name' => $database->db_name
            ];
		return response()->json([
				'database' => $response
				], 200);
    }
 
    public function destroy($id)
    {
		$database = Database::find($id);
		$database->delete();
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
		return response()->json([
				'message' => 'database updated'
				], 200);
	}
    public function store()  {
		$database = new Database;
		$database->host = $this->request->input('host');
		$database->username = $this->request->input('username');
		$database->password = $this->request->input('password');
		$database->db_name = $this->request->input('db_name');
		$database->save();
		return response()->json([
				'message' => 'database added'
				], 201);
	}
}
