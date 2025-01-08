@extends('layouts.lay')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Orders</h1>

    @if(session('success'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-1 mt-1">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-1 mt-1">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <!-- Tombol Tambah Order -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahOrderModal">
        Tambah Order Baru
    </button>

    <!-- Modal Tambah Order -->
    <div class="modal fade" id="tambahOrderModal" tabindex="-1" aria-labelledby="tambahOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahOrderModalLabel">Tambah Order Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="order_date" class="form-label">Tanggal Order</label>
                                <input type="date" class="form-control" id="order_date" name="order_date"
                                    value="{{ old('order_date', date('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Jumlah Order</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        value="{{ old('amount') }}" min="0" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="customer_id" class="form-label">Pilih Customer</label>
                                <select class="form-control" id="customer_id" name="customer_id" required>
                                    <option value="">Pilih Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->customer_id }}"
                                            {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}>
                                            {{ $customer->customer_name }} ({{ $customer->customer_city ?? 'Tidak ada kota' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="salesman_id" class="form-label">Pilih Salesman</label>
                                <select class="form-control" id="salesman_id" name="salesman_id" required>
                                    <option value="">Pilih Salesman</option>
                                    @foreach($salesmans as $salesman)
                                        <option value="{{ $salesman->salesman_id }}"
                                            {{ old('salesman_id') == $salesman->salesman_id ? 'selected' : '' }}>
                                            {{ $salesman->salesman_name }} ({{ $salesman->salesman_city ?? 'Tidak ada kota' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Tabel Daftar Order -->
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Daftar Order
        </div>

        <div class="card-body">
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID Order</th>
                        <th>Tanggal Order</th>
                        <th>Customer</th>
                        <th>Salesman</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                        <td>{{ $order->customer->customer_name ?? 'Tidak ada' }}</td>
                        <td>{{ $order->salesman->salesman_name ?? 'Tidak ada' }}</td>
                        <td class="text-right">{{ number_format($order->amount, 0, ',', '.') }}</td>
                        <td class="text-right">
                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                        </td>
                        <td>
                            <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus order ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Total Keseluruhan:</th>
                        <th class="text-right">
                            Rp {{ number_format($orders->sum('amount'), 0, ',', '.') }}
                        </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Statistik Ringkasan -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Order: {{ $orders->count() }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Penjualan: Rp {{ number_format($orders->sum('amount'), 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Rata-rata Order: Rp {{ number_format($orders->avg('amount'), 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Order Terbesar: Rp {{ number_format($orders->max('amount'), 0, ',', '.') }}</div</div>
        </div>
    </div>
        {{-- <!-- Pelanggan dengan Multiple Salesmen -->
    <div class="card mt-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i> Pelanggan dengan Minimal 2 Salesmen
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Nama Customer</th>
                        <th>Jumlah Salesmen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customersWithMultipleSalesmen as $customer)
                        @php
                            $customerDetail = Customer::find($customer->customer_id);
                        @endphp
                        <tr>
                            <td>{{ $customer->customer_id }}</td>
                            <td>{{ $customerDetail->customer_name }}</td>
                            <td>{{ $customer->salesman_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Top Salesmen berdasarkan Komisi -->
    <div class="card mt-4">
        <div class="card-header">
            <i class="fas fa-chart-line me-1"></i> Top Salesmen Berdasarkan Komisi
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Salesman ID</th>
                        <th>Nama Salesman</th>
                        <th>Komisi</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topSalesmen as $salesman)
                        @php
                            $totalSales = Order::where('salesman_id', $salesman->salesman_id)
                                ->sum('amount');
                        @endphp
                        <tr>
                            <td>{{ $salesman->salesman_id }}</td>
                            <td>{{ $salesman->salesman_name }}</td>
                            <td>{{ number_format($salesman->commission, 2) }}%</td>
                            <td>Rp {{ number_format($totalSales, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [5, 10, 25, 50],
            "order": [], // Hapus pengurutan default
            "columnDefs": [
                {
                    "targets": [4, 5],
                    "className": "text-right"
                }
            ]
        });
    });
</script>
@endpush

@if(session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
@endif
