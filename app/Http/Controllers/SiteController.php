<?php

namespace App\Http\Controllers;

use App\Site;
use App\Site_Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Site $Site)
    {
        $sites = $Site->with('customer', 'machine', 'technology', 'database')->get();

        return response()->json([
                'sites' => $sites,
                ], 200);
    }

    public function show($id, Site $Site)
    {
        $site = $Site->with('customer', 'machine', 'technology', 'database')->find($id);

        return response()->json([
                'site' => $site,
                ], 200);
    }

    public function destroy($id, Site $Site)
    {
        $Site->destroy($id);
        Log::info('site '.$id.' deleted');

        return response()->json([
            'message' => 'site deleted',
            ], 200);
    }

    public function update($id, Site $Site, Site_Database $Site_Database)
    {
        $site = $Site->find($id);
        $site->update($this->request->all());
        $databases = $this->request->input('dids');

        if (!empty($databases)) {
            $site->database()->sync($databases);
        } else {
            $site->database()->detach();
        }

        $url = route('sites.show', ['id' => $site->id]);
        Log::info('site '.$site->id.' updated');

        return response()->json([
                'message' => 'site updated',
                'site' => $url,
                ], 200);
    }

    public function store(Site $Site)
    {
        $site = new $Site();
        $id = $site->create($this->request->all())->id;
        $databases = $this->request->input('dids');
        $site = $site->find($id);

        if (!empty($databases)) {
            $site->database()->attach($databases);
        }

        $url = route('sites.show', ['id' => $id]);
        Log::info('site '.$id.' added');

        return response()->json([
                'message' => 'site added',
                'site' => $site,
                ], 201);
    }
}
