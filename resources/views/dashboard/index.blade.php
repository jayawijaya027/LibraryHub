@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Beranda</h2>
            <p class="text-muted">Selamat datang di Perpustakaan Digital</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white" style="background:#006b00;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Data Buku</h6>
                            <h2 class="mb-0">{{ $bookCount }}</h2>
                        </div>
                        <i class="fas fa-book fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Data Anggota</h6>
                            <h2 class="mb-0">{{ $memberCount }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Peminjaman</h6>
                            <h2 class="mb-0">{{ $loanCount }}</h2>
                        </div>
                        <i class="fas fa-book-reader fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Belum Kembali</h6>
                            <h2 class="mb-0">{{ $notReturned }}</h2>
                        </div>
                        <i class="fas fa-exclamation-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Peminjaman Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status Peminjaman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentLoans as $loan)
                                    <tr>
                                        <td>{{ $loan->member ? $loan->member->name : 'Anggota Tidak Ditemukan' }}</td>
                                        <td>{{ $loan->book ? $loan->book->title : 'Buku Tidak Ditemukan' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge {{ $loan->returned ? 'bg-success' : 'bg-warning' }}">
                                                {{ $loan->returned ? 'Sudah Kembali' : 'Belum Kembali' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data peminjaman terbaru</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Buku Terpopuler</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Jumlah Dipinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularBooks as $book)
                                    <tr>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->loans_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data buku terpopuler</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
