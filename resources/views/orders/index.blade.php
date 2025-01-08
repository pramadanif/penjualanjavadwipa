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

    <!-- Tombol Tambah Order Baru -->
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tambah Order Baru</a>


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
