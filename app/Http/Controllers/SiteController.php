<?php

namespace App\Http\Controllers;

use App\Site;
use App\Site_Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
		$sites = Site::with('customer','machine','technology','database')->get();
		return response()->json([
				'sites' => $sites
				], 200);
    }
 
    public function show($id)
    {
		$site = Site::with('customer','machine','technology','database')->find($id);
		return response()->json([
				'site' => $site
				], 200);
    }
 
    public function destroy($id)
    {
		Site::find($id)->delete();

		Log::info('site '.$id.' deleted');

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
		$site->database()->attach($databases);
		
		$url = route('sites.show', ['id' => $site->sid]);

		Log::info('site '.$site->sid.' updated');

		return response()->json([
				'message' => 'site updated',
				'site' => $url
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
		$site->database()->attach($databases);

		$url = route('sites.show', ['id' => $site->sid]);

		Log::info('site '.$site->sid.' added');

		return response()->json([
				'message' => 'site added',
				'site' => $url
				], 201);
	}
}
