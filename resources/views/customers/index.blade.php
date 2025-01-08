@extends('layouts.lay')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Customers</h1>

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

    <!-- Tombol Tambah Customer Baru -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCustomerModal">Tambah Customer Baru</button>

    <!-- Modal untuk Tambah Customer -->
    <div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="createCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCustomerModalLabel">Tambah Customer Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Customer</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_city" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="customer_city" name="customer_city">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Customer -->
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Daftar Customer
        </div>

        <div class="card-body">
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Customer</th>
                        <th>Kota</th>
                        <th>Jumlah Order</th>
                        <th>Total Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->customer_id }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_city ?? 'Tidak ada' }}</td>
                        <td>{{ $customer->orders_count }}</td>
                        <td>
                            {{
                                $customer->orders->sum('amount') ?
                                'Rp ' . number_format($customer->orders->sum('amount'), 0, ',', '.') :
                                'Rp 0'
                            }}
                        </td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus customer ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [5, 10, 25, 50],
            "order": [[0, 'desc']] // Urutkan berdasarkan ID secara descending
        });
    });
</script>
@endpush

@if(session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
@endif
