@extends('layouts.lay')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Salesman</h1>

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

        <!-- Tombol Tambah Salesman -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahSalesmanModal">
        Tambah Salesman Baru
    </button>

    <!-- Modal Tambah Salesman -->
    <div class="modal fade" id="tambahSalesmanModal" tabindex="-1" aria-labelledby="tambahSalesmanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSalesmanModalLabel">Tambah Salesman Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('salesmans.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="salesman_name" class="form-label">Nama Salesman</label>
                            <input type="text" class="form-control" id="salesman_name" name="salesman_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="salesman_city" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="salesman_city" name="salesman_city">
                        </div>
                        <div class="mb-3">
                            <label for="commission" class="form-label">Komisi</label>
                            <input type="number" class="form-control" id="commission" name="commission" step="0.01" min="0" max="1" required>
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


    <!-- Tabel Daftar Salesman -->
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Daftar Salesman
        </div>

        <div class="card-body">
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Salesman</th>
                        <th>Kota</th>
                        <th>Komisi</th>
                        <th>Jumlah Order</th>
                        <th>Total Penjualan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesmans as $salesman)
                    <tr>
                        <td>{{ $salesman->salesman_id }}</td>
                        <td>{{ $salesman->salesman_name }}</td>
                        <td>{{ $salesman->salesman_city ?? 'Tidak ada' }}</td>
                        <td>{{ $salesman->commission ? number_format($salesman->commission, 2) . '%' : '0%' }}</td>
                        <td>{{ $salesman->orders_count }}</td>
                        <td>
                            {{
                                $salesman->orders->sum('amount') ?
                                'Rp ' . number_format($salesman->orders->sum('amount'), 0, ',', '.') :
                                'Rp 0'
                            }}
                        </td>
                        <td>
                            <a href="{{ route('salesmans.edit', $salesman->salesman_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('salesmans.destroy', $salesman->salesman_id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus salesman ini?')">Hapus</button>
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
            "order": [[0, 'desc']], // Urutkan berdasarkan ID secara descending
            "columnDefs": [
                {
                    "targets": [3, 4, 5],
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
