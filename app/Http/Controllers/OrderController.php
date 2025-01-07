<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Salesman;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'salesman'])
            ->latest()
            ->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $salesmans = Salesman::all();
        return view('orders.create', compact('customers', 'salesmans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'customer_id' => 'required|exists:customers,customer_id',
            'salesman_id' => 'required|exists:salesman,salesman_id'
        ]);

        try {
            $order = Order::create($validatedData);
            return redirect()->route('orders.index')
                ->with('success', 'Order berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan order: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'salesman'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $customers = Customer::all();
        $salesmans = Salesman::all();
        return view('orders.edit', compact('order', 'customers', 'salesmans'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'amount' => 'required|numeric|min:0', 'customer_id' => 'required|exists:customers,customer_id',
            'salesman_id' => 'required|exists:salesman,salesman_id'
        ]);

        try {
            $order = Order::findOrFail($id);
            $order->update($validatedData);

            return redirect()->route('orders.index')
                ->with('success', 'Order berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate order: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->route('orders.index')
                ->with('success', 'Order berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus order: ' . $e->getMessage());
        }
    }
}
