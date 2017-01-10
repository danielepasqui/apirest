<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class CustomerController extends Controller
{
	
	protected $request;
	
	public function __construct(Request $request)
    {
        $this->request = $request;
    }

     public function index()
    {
		$customers = Customer::all();
		$response=array();
		foreach ($customers as $customer) {
			$response[] = [
                    'id' => $customer->cid,
                    'name' => $customer->name,
                    'support_queue' => $customer->support_queue,
                    'active' => $customer->active,
					'notes' => $customer->notes
                ];
		}
		return response()->json([
				'customers' => $response
				], 200);
    }
 
    public function show($id)
    {
		$customer = Customer::find($id);
		$response=array();
		$response = [
				'id' => $customer->cid,
				'name' => $customer->name,
				'support_queue' => $customer->support_queue,
				'active' => $customer->active,
				'notes' => $customer->notes
            ];
		return response()->json([
				'customer' => $response
				], 200);
    }
 
    public function destroy($id)
    {
		$customer = Customer::find($id);
		$customer->delete();
		return response()->json([
			'message' => 'customer deleted'
			], 200);
    }
 
	public function update($id){
		$customer = Customer::find($id);
		$customer->name = $this->request->input('name');
		$customer->support_queue = $this->request->input('support_queue');
		$customer->active = $this->request->input('active');
		$customer->notes = $this->request->input('notes');
		$customer->save();

		$url = '/customer/'.$customer->cid;
		return response()->json([
				'message' => 'customer updated',
				'customer' => url($url)
				], 200);
	}
    public function store()  {
		$customer = new Customer;
		$customer->name = $this->request->input('name');
		$customer->support_queue = $this->request->input('support_queue');
		$customer->active = $this->request->input('active');
		$customer->notes = $this->request->input('notes');
		$customer->save();

		$url = '/customer/'.$customer->cid;
		return response()->json([
				'message' => 'customer added',
				'customer' => url($url)
				], 201);
	}
}
