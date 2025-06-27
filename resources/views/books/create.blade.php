@extends('layouts.app')

@push('styles')
<style>
.btn-primary {
    background: linear-gradient(45deg, #006b00, #006b00);
    border: none;
}
.btn-primary:hover {
    background: #008f00;
}
.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 107, 0, 0.25);
    border-color: #006b00;
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Buku</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Buku</label>
                            <input type="text" name="title" id="title" 
                                class="form-control @error('title') is-invalid @enderror" 
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Penulis</label>
                            <input type="text" name="author" id="author" 
                                class="form-control @error('author') is-invalid @enderror" 
                                value="{{ old('author') }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" 
                                class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun Terbit</label>
                            <input type="number" name="year" id="year" 
                                class="form-control @error('year') is-invalid @enderror" 
                                value="{{ old('year') }}" required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Buku</label>
                            <input type="file" name="image" id="image" 
                                class="form-control @error('image') is-invalid @enderror" 
                                accept="image/*">
                            <small class="form-text text-muted">Upload gambar sampul buku (opsional)</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
