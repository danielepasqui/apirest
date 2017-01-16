<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Customer $Customer)
    {
        $customers = $Customer->all();

        return response()->json([
                'customers' => $customers,
                ], 200);
    }

    public function show($id, Customer $Customer)
    {
        $customer = $Customer->find($id);

        return response()->json([
                'customer' => $customer,
                ], 200);
    }

    public function destroy($id, Customer $Customer)
    {
        $Customer->destroy($id);
        Log::info('Customer '.$id.' deleted');

        return response()->json([
            'message' => 'customer deleted',
            ], 200);
    }

    public function update($id, Customer $Customer)
    {
        $customer = $Customer->find($id);
        $customer->update($this->request->all());
        $url = route('customers.show', ['id' => $customer->id]);
        Log::info('Customer '.$customer->id.' updated');

        return response()->json([
                'message' => 'customer updated',
                'customer' => $url,
                ], 200);
    }

    public function store(Customer $Customer)
    {
        $customer = new $Customer();
        $id = $customer->create($this->request->all())->id;
        $url = route('customers.show', ['id' => $id]);
        Log::info('Customer '.$id.' added');

        return response()->json([
                'message' => 'customer added',
                'customer' => $url,
                ], 201);
    }
}
