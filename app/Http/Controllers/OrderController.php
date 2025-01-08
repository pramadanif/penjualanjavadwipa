<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Salesman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
{

    $customersWithMultipleSalesmen = DB::table('orders')
        ->select('customer_id', DB::raw('COUNT(DISTINCT salesman_id) as salesman_count'))
        ->groupBy('customer_id')
        ->having('salesman_count', '>=', 2)
        ->get();


    $topSalesmen = Salesman::orderBy('commission', 'desc')
        ->take(5) // Ambil 5 teratas
        ->get();

    
    $orders = Order::with(['customer', 'salesman'])
        ->orderBy('order_id', 'desc')
        ->get();

    $customers = Customer::all();
    $salesmans = Salesman::all();

    return view('orders.index', compact(
        'orders',
        'customersWithMultipleSalesmen',
        'topSalesmen',
        'customers',
        'salesmans'
    ));
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
