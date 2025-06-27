@extends('layouts.app')

@section('title', 'Pinjam Buku - LibraryHub')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-book-reader me-2"></i>Pinjam Buku</h4>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if($selectedBook)
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="position-relative book-image">
                                        @if($selectedBook->image)
                                            <img src="{{ asset($selectedBook->image) }}" alt="{{ $selectedBook->title }}" class="img-fluid rounded shadow-sm">
                                        @else
                                            <div class="bg-light text-center p-5 rounded shadow-sm">
                                                <i class="fas fa-book fa-4x text-secondary"></i>
                                            </div>
                                        @endif
                                        <div class="book-badge">
                                            <span class="badge bg-success">Tersedia</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3 class="mb-3">{{ $selectedBook->title }}</h3>
                                    <div class="book-details">
                                        <div class="detail-item">
                                            <span class="detail-icon"><i class="fas fa-tag text-primary"></i></span>
                                            <span class="detail-label">Kategori:</span>
                                            <span class="detail-value">{{ $selectedBook->category->name }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-icon"><i class="fas fa-user text-secondary"></i></span>
                                            <span class="detail-label">Penulis:</span>
                                            <span class="detail-value">{{ $selectedBook->author }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-icon"><i class="fas fa-calendar text-muted"></i></span>
                                            <span class="detail-label">Tahun Terbit:</span>
                                            <span class="detail-value">{{ $selectedBook->year }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                    @endif

                    <form method="POST" action="{{ route('user.loans.store') }}" class="loan-form">
                        @csrf
                        
                        @if($selectedBook)
                            <input type="hidden" name="book_id" value="{{ $selectedBook->id }}">
                        @else
                            <div class="mb-4">
                                <label for="book_id" class="form-label">Pilih Buku</label>
                                <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Buku --</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                            {{ $book->title }} - {{ $book->author }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="loan_date" class="form-label">Tanggal Pinjam</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" name="loan_date" id="loan_date" 
                                            class="form-control @error('loan_date') is-invalid @enderror" 
                                            value="{{ old('loan_date', date('Y-m-d')) }}" required>
                                    </div>
                                    @error('loan_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Jatuh Tempo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        <input type="date" class="form-control bg-light" 
                                            value="{{ date('Y-m-d', strtotime('+14 days')) }}" disabled>
                                    </div>
                                    <div class="form-text">Otomatis 14 hari setelah peminjaman</div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-info-circle fa-2x text-info"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Informasi Peminjaman</h5>
                                    <p class="mb-0">Buku harus dikembalikan dalam 14 hari setelah tanggal peminjaman. Keterlambatan pengembalian dapat dikenakan denda sesuai ketentuan perpustakaan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check me-2"></i> Konfirmasi Peminjaman
                            </button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Batalkan
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card-header {
    background: linear-gradient(45deg, #006b00, #008f00) !important;
}

.book-image {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.book-badge {
    position: absolute;
    top: 10px;
    right: 10px;
}

.book-details {
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.8rem;
    padding-bottom: 0.8rem;
    border-bottom: 1px dashed #e9ecef;
}

.detail-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.detail-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-size: 0.9rem;
}

.detail-label {
    font-weight: 600;
    width: 110px;
    color: #495057;
}

.detail-value {
    color: #212529;
    flex: 1;
}

.loan-form label {
    font-weight: 500;
    color: #495057;
}

.btn-success {
    background: linear-gradient(45deg, #006b00, #008f00);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(45deg, #005a00, #007f00);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
</style>
@endpush 