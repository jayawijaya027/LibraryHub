@extends('layouts.app')

@section('title', 'Riwayat Peminjaman - LibraryHub')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="page-header slide-in-left">
                <h2>Riwayat Peminjaman Buku</h2>
                <p class="text-muted">Kelola dan pantau semua aktivitas peminjaman buku Anda di sini.</p>
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-lg-end mt-3 mt-lg-0 slide-in-right">
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary me-2">
                <i class="fas fa-search me-1"></i> Cari Buku
            </a>
            <a href="{{ route('user.loans.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Pinjam Buku
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
                            <th style="width: 40%">Judul Buku</th>
                            <th style="width: 15%">Tanggal Pinjam</th>
                            <th style="width: 15%">Jatuh Tempo</th>
                            <th style="width: 15%">Status</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $key => $loan)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
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
                                <a href="{{ route('user.loans.create', ['book_id' => $loan->book->id]) }}" 
                                   class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$loan->returned)
                                <form action="{{ route('user.loans.cancel', $loan->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Batalkan Peminjaman" onclick="return confirm('Yakin ingin membatalkan peminjaman ini?');">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="empty-state-icon mb-3">
                                        <i class="fas fa-book-open fa-3x text-muted"></i>
                                    </div>
                                    <h5>Belum ada riwayat peminjaman buku</h5>
                                    <p class="text-muted">Mulai pinjam buku sekarang untuk melihat riwayat peminjaman Anda di sini.</p>
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-search me-1"></i> Jelajahi Buku
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