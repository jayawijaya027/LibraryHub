@extends('layouts.app')

@section('title', 'Data Peminjaman - LibraryHub')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="page-header slide-in-left">
            <h2>Data Peminjaman Buku</h2>
                <p class="text-muted">Kelola semua data peminjaman buku perpustakaan di sini.</p>
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-lg-end mt-3 mt-lg-0 slide-in-right">
            <a href="{{ route('loans.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Peminjaman
            </a>
        </div>
    </div>

    <div class="card shadow fade-in">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 20%">Nama Anggota</th>
                            <th style="width: 25%">Judul Buku</th>
                            <th style="width: 15%">Tanggal Pinjam</th>
                            <th style="width: 15%">Jatuh Tempo</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $key => $loan)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $loan->member ? $loan->member->name : 'Anggota Tidak Ditemukan' }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($loan->book->image)
                                        <img src="{{ asset($loan->book->image) }}" alt="{{ $loan->book->title }}" 
                                             class="me-2 rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center me-2" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-book text-secondary"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong class="d-block">{{ $loan->book->title }}</strong>
                                        <small class="text-muted">{{ $loan->book->author }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <i class="far fa-calendar-check me-1"></i>
                                    {{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $dueDate = \Carbon\Carbon::parse($loan->loan_date)->addDays(14);
                                    $isOverdue = $dueDate->isPast() && !$loan->returned;
                                @endphp
                                <span class="badge {{ $isOverdue ? 'bg-danger' : 'bg-light text-dark' }}">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $dueDate->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>
                                @if($loan->returned)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i> Sudah Kembali
                                    </span>
                                @else
                                    @if($isOverdue)
                                        <span class="badge bg-danger">
                                            <i class="fas fa-exclamation-circle me-1"></i> Terlambat
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-clock me-1"></i> Dipinjam
                                        </span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="empty-state-icon mb-3">
                                        <i class="fas fa-book-open fa-3x text-muted"></i>
                                    </div>
                                    <h5>Tidak ada data peminjaman</h5>
                                    <p class="text-muted">Belum ada data peminjaman yang tersedia.</p>
                                    <a href="{{ route('loans.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus me-1"></i> Tambah Peminjaman Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.empty-state-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
}

.table th {
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.btn-sm {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}
</style>
@endpush
