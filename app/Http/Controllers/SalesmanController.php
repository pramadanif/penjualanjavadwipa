<?php

namespace App\Http\Controllers;

use App\Models\Salesman;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    public function index()
    {
        $salesmans = Salesman::latest()->paginate(10);
        return view('salesmans.index', compact('salesmans'));
    }

    public function create()
    {
        return view('salesmans.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'salesman_name' => 'required|max:100',
            'salesman_city' => 'nullable|max:100',
            'commission' => 'nullable|numeric|between:0,99.99'
        ]);

        try {
            $salesman = Salesman::create($validatedData);
            return redirect()->route('salesmans.index')
                ->with('success', 'Salesman berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan salesman: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $salesman = Salesman::findOrFail($id);
        $orders = $salesman->orders()->paginate(10);
        return view('salesmans.show', compact('salesman', 'orders'));
    }

    public function edit($id)
    {
        $salesman = Salesman::findOrFail($id);
        return view('salesmans.edit', compact('salesman'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'salesman_name' => 'required|max:100',
            'salesman_city' => 'nullable|max:100',
            'commission' => 'nullable|numeric|between:0,99.99'
        ]);

        try {
            $salesman = Salesman::findOrFail($id);
            $salesman->update($validatedData);

            return redirect()->route('salesmans.index')
                ->with('success', 'Salesman berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate salesman: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $salesman = Salesman::findOrFail($id);
            $salesman->delete();

            return redirect()->route('salesmans.index')
                ->with('success', 'Salesman berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus salesman: ' . $e->getMessage());
        }
    }
}
