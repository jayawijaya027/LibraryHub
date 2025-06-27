@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Data Peminjaman</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('loans.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="member_id" class="form-label">Anggota</label>
                            <select name="member_id" id="member_id" class="form-select @error('member_id') is-invalid @enderror" required>
                                <option value="">Pilih Anggota</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }} ({{ $member->member_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="book_id" class="form-label">Buku</label>
                            <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                                <option value="">Pilih Buku</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ (old('book_id') == $book->id || (isset($selectedBookId) && $selectedBookId == $book->id)) ? 'selected' : '' }}>
                                        {{ $book->title }} - {{ $book->author }}
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="loan_date" class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="loan_date" id="loan_date" 
                                class="form-control @error('loan_date') is-invalid @enderror" 
                                value="{{ old('loan_date', date('Y-m-d')) }}" required>
                            @error('loan_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="return_date" class="form-label">Tanggal Kembali (opsional)</label>
                            <input type="date" name="return_date" id="return_date" 
                                class="form-control @error('return_date') is-invalid @enderror" 
                                value="{{ old('return_date') }}">
                            @error('return_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="returned" class="form-label">Status Pengembalian</label>
                            <select name="returned" id="returned" class="form-select @error('returned') is-invalid @enderror">
                                <option value="0" {{ old('returned') == '0' ? 'selected' : '' }}>Belum Dikembalikan</option>
                                <option value="1" {{ old('returned') == '1' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                            </select>
                            @error('returned')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
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
