<?php

namespace App\Http\Controllers;

use App\Site;
use App\Site_Database;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class SiteController extends Controller
{
    protected $request;
	
	public function __construct(Request $request)
    {
        $this->request = $request;
    }

     public function index()
    {
		$sites = Site::all();
		$response=array();
		foreach ($sites as $site) {
			$databases=array();
			foreach($site->database as $db)
			{
				$databases[] = [
					'host' => $db->host,
					'username' => $db->username,
					'password' => $db->password,
					'db_name' => $db->db_name
				];
			}
			$response[] = [
					'id' => $site->sid,
					'customer' => $site->customer->name,
					'url' => $site->url,
					'pm' => $site->pm,
					'support_queue' => $site->customer->support_queue,
					'technology' => $site->technology->name,
					'machine' => $site->machine->name,
					'doc_root' => $site->doc_root,
					'group' => $site->group,
					'cms_admin' => $site->cms_admin,
					'cms_pass' => $site->cms_pass,
					'auth_name' => $site->auth_name,
					'auth_pass' => $site->auth_pass,
					'databases' => $databases,
					'notes' => $site->notes
                ];
		}
		return response()->json([
				'sites' => $response
				], 200);
    }
 
    public function show($id)
    {
		$site = Site::find($id);
		$response=array();
		$databases=array();
		foreach($site->database as $db)
		{
			$databases[] = [
				'host' => $db->host,
				'username' => $db->username,
				'password' => $db->password,
				'db_name' => $db->db_name
			];
		}
		$response = [
				'id' => $site->sid,
				'nome' => $site->nome,
				'url' => $site->url,
				'pm' => $site->pm,
				'support_queue' => $site->customer->support_queue,
				'technology' => $site->technology->name,
				'machine' => $site->machine->name,
				'doc_root' => $site->doc_root,
				'group' => $site->group,
				'cms_admin' => $site->cms_admin,
				'cms_pass' => $site->cms_pass,
				'auth_name' => $site->auth_name,
				'auth_pass' => $site->auth_pass,
				'databases' => $databases,
				'notes' => $site->notes
			];
		return response()->json([
				'site' => $response
				], 200);
    }
 
    public function destroy($id)
    {
		$site = Site::find($id);
		$site->delete();
		return response()->json([
			'message' => 'site deleted'
			], 200);
    }

	public function update($id){
		$site = Site::find($id);
		$site->nome = $this->request->input('name');
		$site->url = $this->request->input('url');
		$site->doc_root = $this->request->input('doc_root');
		$site->auth_name = $this->request->input('auth_name');
		$site->auth_pass = $this->request->input('auth_pass');
		$site->cms_admin = $this->request->input('cms_admin');
		$site->cms_pass = $this->request->input('cms_pass');
		$site->pm = $this->request->input('pm');
		$site->group = $this->request->input('group');
		$site->notes = $this->request->input('notes');
		$site->tid = $this->request->input('tid');
		$site->mid = $this->request->input('mid');
		$site->cid = $this->request->input('cid');
		$site->save();

		$databases = $this->request->input('dids');

		Site_Database::where('sid', $site->sid)->delete();

		if(is_array($databases)){

			foreach ($databases as $database) {
				$site_database = new Site_Database;
				$site_database->sid = $site->sid;
				$site_database->did = $database;
				$site_database->save();
			}
		}
		$url = '/site/'.$site->sid;
		return response()->json([
				'message' => 'site updated',
				'site' => url($url)
				], 200);
	}
    public function store()  {
		$site = new Site;
		$site->nome = $this->request->input('name');
		$site->url = $this->request->input('url');
		$site->doc_root = $this->request->input('doc_root');
		$site->auth_name = $this->request->input('auth_name');
		$site->auth_pass = $this->request->input('auth_pass');
		$site->cms_admin = $this->request->input('cms_admin');
		$site->cms_pass = $this->request->input('cms_pass');
		$site->pm = $this->request->input('pm');
		$site->group = $this->request->input('group');
		$site->notes = $this->request->input('notes');
		$site->tid = $this->request->input('tid');
		$site->mid = $this->request->input('mid');
		$site->cid = $this->request->input('cid');
		$site->save();

		$databases = $this->request->input('dids');

		if(is_array($databases)){

			foreach ($databases as $database) {
				$site_database = new Site_Database;
				$site_database->sid = $site->sid;
				$site_database->did = $database;
				$site_database->save();
			}
		}
		$url = '/site/'.$site->sid;
		return response()->json([
				'message' => 'site added',
				'site' => url($url)
				], 201);
	}
}
