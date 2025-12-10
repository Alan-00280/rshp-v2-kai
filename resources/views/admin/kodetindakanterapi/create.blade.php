@extends('layouts.app')
@section('title', 'Tambah Kategori Klinis - RSHP UNAIR')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">  
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Kode Tindakan</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>  
                    @endif      

                    <form action="{{ route('admin.kodetindakanterapi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Tindakan<span class="text-danger">*</span></label>
                            <input type="text" 
                                class="form-control @error('kode') is-invalid @enderror"
                                id="kode"
                                name="kode"
                                value="{{ old('kode') }}"
                                placeholder="Masukkan kode tindakan"
                                required>
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kodetindakanterapi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

