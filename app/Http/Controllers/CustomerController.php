<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
{
    
    $customers = Customer::withCount('orders')
        ->with('orders') // untuk menghitung total pembelian
        ->latest('customer_id')
        ->get();

    return view('customers.index', compact('customers'));
}

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|max:100',
            'customer_city' => 'nullable|max:100'
        ]);

        try {
            $customer = Customer::create($validatedData);
            return redirect()->route('customers.index')
                ->with('success', 'Customer berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan customer: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $orders = $customer->orders()->paginate(10);
        return view('customers.show', compact('customer', 'orders'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|max:100',
            'customer_city' => 'nullable|max:100'
        ]);

        try {
            $customer = Customer::findOrFail($id);
            $customer->update($validatedData);

            return redirect()->route('customers.index')
                ->with('success', 'Customer berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate customer: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return redirect()->route('customers.index')
                ->with('success', 'Customer berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus customer: ' . $e->getMessage());
        }
    }
}
