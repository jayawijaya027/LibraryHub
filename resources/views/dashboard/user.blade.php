@extends('layouts.app')

@section('title', 'Dashboard User - LibraryHub')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="page-header slide-in-left">
                <h2>Selamat Datang di LibraryHub</h2>
                <p class="text-muted">Jelajahi koleksi buku digital kami dan temukan pengetahuan baru setiap hari.</p>
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-lg-end mt-3 mt-lg-0 slide-in-right">
            <a href="{{ route('user.loans.index') }}" class="btn btn-outline-primary me-2">
                <i class="fas fa-book-reader me-1"></i> Peminjaman Saya
            </a>
            <a href="{{ route('user.loans.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Pinjam Buku
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm fade-in">
                <div class="card-body">
                    <form method="GET" action="{{ route('user.dashboard') }}" class="row g-3">
                        <div class="col-lg-5 col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <select name="category" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="d-grid d-md-flex">
                                <button type="submit" class="btn btn-primary me-md-2 mb-2 mb-md-0">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($books as $book)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm book-card">
                    <div class="position-relative book-image">
                        @if($book->image)
                            <img src="{{ asset($book->image) }}" class="card-img-top" alt="{{ $book->title }}" loading="lazy">
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="fas fa-book fa-3x text-secondary"></i>
                                <p class="mt-2 text-muted">Tidak ada gambar</p>
                            </div>
                        @endif
                        <div class="book-overlay">
                            <a href="{{ route('user.loans.create', ['book_id' => $book->id]) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-book-reader me-1"></i> Pinjam / Detail
                            </a>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $book->title }}">{{ $book->title }}</h5>
                        <p class="card-text mb-1"><small><i class="fas fa-tag me-1 text-primary"></i> {{ $book->category->name }}</small></p>
                        <p class="card-text mb-1"><small><i class="fas fa-user me-1 text-secondary"></i> {{ $book->author }}</small></p>
                        <p class="card-text mb-2"><small><i class="fas fa-calendar me-1 text-muted"></i> {{ $book->year }}</small></p>
                        <div class="mt-auto">
                            <a href="{{ route('user.loans.create', ['book_id' => $book->id]) }}" class="btn btn-success btn-sm w-100">
                                <i class="fas fa-book-reader me-1"></i> Pinjam / Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5 shadow-sm">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <h4>Tidak ada buku ditemukan</h4>
                    @if(request('search') || request('category'))
                        <p>Tidak ada buku yang sesuai dengan kriteria pencarian Anda.</p>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-redo me-1"></i> Reset Pencarian
                        </a>
                    @else
                        <p>Belum ada buku tersedia di perpustakaan.</p>
                    @endif
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
.book-card {
    transition: transform 0.3s ease;
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

.book-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.book-image {
    overflow: hidden;
    position: relative;
}

.book-image img {
    height: 200px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.book-card:hover .book-image img {
    transform: scale(1.05);
}

.book-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.book-card:hover .book-overlay {
    opacity: 1;
}

.card-title {
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.card-text {
    color: #6c757d;
}

.btn-success {
    background: #006b00;
    border: none;
}

.btn-success:hover {
    background: #008f00;
}

.btn-outline-success {
    color: #006b00;
    border-color: #006b00;
}

.btn-outline-success:hover {
    background-color: #006b00;
    color: white;
}
</style>
@endpush 