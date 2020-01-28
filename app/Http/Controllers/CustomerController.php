<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'Desc')->paginate(10);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.add');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|max:15',
            'address' => 'required|string',
            'email' => 'required|email'
        ]);

        try {
            $customers = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email
            ]);
            return redirect('/customer')->with(['success' => 'Data telah disimpan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit',compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|max:15',
            'address' => 'required|string',
            'email' => 'required|email'
        ]);

        try {
            $customer = Customer::find($id);
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
            return redirect('/customer')->with(['success' => 'Data Telah Diperbarui']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/customer')->with(['success' => 'Data Telah DiHapus']);
    }
}
