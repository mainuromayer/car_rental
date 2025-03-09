<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function create()
    {
        return view('backend.admin.customer.create');
    }


    public function store(Request $request)
    {
        try {
            $customer_id = $request->id;
            if ($customer_id) {
                $customer = User::where('role', 'customer')->findOrFail($customer_id);
            } else {
                $customer = new User();

            }
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email,' . $request->id,
                'phone' => 'required|string',
                'address' => 'nullable|string',
                'password' => 'nullable|string|min:8',

            ]);

            $customerData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => Hash::make($request->input('password')),
                'role' => 'customer',
            ];


            if ($customer->exists) {
                $customer->update($customerData);
                $message = 'Car updated successfully';
            } else {
                $customer->create($customerData);
                $message = 'Customer created successfully';
            }

            return redirect()->route('admin.customer.list')->with('status', 'success')->with('message', $message);
        } catch (Exception $e) {
            return redirect()->route('admin.customer.list')->with('status', 'error')->with('message', 'Operation failed: ' . $e->getMessage());
        }
    }


    public function list(Request $request)
    {
        try {
            $customers = User::where('role', 'customer')->orderBy('id', 'desc')->paginate(5);
            return view('backend.admin.customer.list', compact('customers'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function details($id)
    {

        $customer = User::where('role', 'customer')->find($id);
        $rentals = Rental::where('user_id', $id)->whereNot('status', 'completed')->get();
        return view('backend.admin.customer.details', compact('customer', 'rentals'));
    }

    public function delete($id)
    {
        try {
            $customer = User::where('role', 'customer')->find($id);
            $customer->delete();
            return redirect()->route('admin.customer.list')->with('status', 'success')->with('message', 'Customer deleted successfully!');

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }

    }

    public function edit($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        return view('backend.admin.customer.edit', compact('customer'));
    }
}
