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
    <div class="row mb-4">
        <div class="col">
            <h2>Data Buku</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Data Buku</a>
            <a href="{{ route('books.print') }}" class="btn btn-success">Cetak Data Buku</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('books.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                        placeholder="Cari Judul/Penulis Buku..." 
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-select">
                        <option value="">-- Semua Kategori Buku --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" 
                                {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Cari Data</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Reset Pencarian</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Kategori Buku</th>
                    <th>Tahun Terbit</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $key => $book)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->year }}</td>
                        <td>
                            @if($book->image)
                                <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" style="width: 50px; height: auto;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data buku ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data buku yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
