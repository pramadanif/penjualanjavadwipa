@extends('layouts.lay')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Order</h1>

    <!-- Tampilkan status sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tampilkan error validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form edit order -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Detail Order
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="order_id" class="form-label">ID Order</label>
                            <input type="text"
                                   name="order_id"
                                   id="order_id"
                                   class="form-control"
                                   value="{{ $order->order_id }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="order_date" class="form-label">Tanggal Order</label>
                            <input type="date"
                                   name="order_date"
                                   id="order_date"
                                   class="form-control @error('order_date') is-invalid @enderror"
                                   value="{{ old('order_date', $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') : '') }}"
                                   required>
                            @error('order_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer_id" class="form-label">Customer</label>
                            <select name="customer_id"
                                    id="customer_id"
                                    class="form-control @error('customer_id') is-invalid @enderror"
                                    required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->customer_id }}"
                                        {{ $order->customer_id == $customer->customer_id ? 'selected' : '' }}>
                                        {{ $customer->customer_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="salesman_id" class="form-label">Salesman</label>
                            <select name="salesman_id"
                                    id="salesman_id"
                                    class="form-control @error('salesman_id') is-invalid @enderror"
                                    required>
                                @foreach($salesmans as $salesman)
                                    <option value="{{ $salesman->salesman_id }}"
                                        {{ $order->salesman_id == $salesman->salesman_id ? 'selected' : '' }}>
                                        {{ $salesman->salesman_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('salesman_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="amount" class="form-label">Jumlah</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number"
                                       name="amount"
                                       id="amount"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount', $order->amount) }}"
                                       step="0.01"
                                       min="0"
                                       required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Perbarui Order
                    </button>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi select2 untuk dropdown
        $('#customer_id, #salesman_id').select2({
            theme: 'bootstrap4'
        });
    });
</script>
@endpush
