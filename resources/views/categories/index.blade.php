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
            <h2>Data Kategori Buku</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori Buku</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori Buku</th>
                    <th>Jumlah Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->books->count() }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data kategori ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data kategori yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
