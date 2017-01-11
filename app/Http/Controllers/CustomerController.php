<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
		return response()->json([
				'customers' => $customers
				], 200);
    }
 
    public function show($id)
    {
		$customer = Customer::find($id);
		return response()->json([
				'customer' => $customer
				], 200);
    }
 
    public function destroy($id)
    {
		$customer = Customer::find($id)->delete();

		Log::info('Customer '.$id.' deleted');

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

		$url = route('customers.show', ['id' => $customer->cid]);

		Log::info('Customer '.$customer->cid.' updated');
		
		return response()->json([
				'message' => 'customer updated',
				'customer' => $url
				], 200);
	}
    public function store()  {
		$customer = new Customer;
		$customer->name = $this->request->input('name');
		$customer->support_queue = $this->request->input('support_queue');
		$customer->active = $this->request->input('active');
		$customer->notes = $this->request->input('notes');
		$customer->save();

		$url = route('customers.show', ['id' => $customer->cid]);

		Log::info('Customer '.$customer->cid.' added');

		return response()->json([
				'message' => 'customer added',
				'customer' => $url
				], 201);
	}
}
