@extends('layouts.lay')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Salesman</h1>

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

    <!-- Form edit salesman -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Salesman
        </div>
        <div class="card-body">
            <form action="{{ route('salesmans.update', $salesman->salesman_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="salesman_id" class="form-label">ID Salesman</label>
                            <input type="text"
                                   name="salesman_id"
                                   id="salesman_id"
                                   class="form-control"
                                   value="{{ $salesman->salesman_id }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="salesman_name" class="form-label">Nama Salesman</label>
                            <input type="text"
                                   name="salesman_name"
                                   id="salesman_name"
                                   class="form-control @error('salesman_name') is-invalid @enderror"
                                   value="{{ old('salesman_name', $salesman->salesman_name) }}"
                                   required>
                            @error('salesman_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="salesman_city" class="form-label">Kota</label>
                            <input type="text"
                                   name="salesman_city"
                                   id="salesman_city"
                                   class="form-control"
                                   value="{{ old('salesman_city', $salesman->salesman_city) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="commission" class="form-label">Komisi (%)</label>
                            <input type="number"
                                   name="commission"
                                   id="commission"
                                   class="form-control @error('commission') is-invalid @enderror"
                                   value="{{ old('commission', $salesman->commission * 100) }}"
                                   step="0.01"
                                   min="0"
                                   max="100"
                                   required>
                            @error('commission')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Perbarui Salesman
                    </button>
                    <a href="{{ route('salesmans.index') }}" class="btn btn-secondary">
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
        // Konversi komisi dari persen ke desimal saat submit
        $('form').on('submit', function() {
            let commission = $('#commission').val();
            $('#commission').val(commission / 100);
        });
    });
</script>
@endpush
