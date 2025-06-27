@extends('layouts.app')

@section('title', 'Profil Pengguna - LibraryHub')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profil Pengguna</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                             style="width: 100px; height: 100px; font-size: 2.5rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <h4>{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                        <div class="badge bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'success' }} mb-3">
                            {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="fas fa-info-circle me-2"></i>Informasi Akun</h6>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Nama Lengkap:</span>
                                            <span class="fw-bold">{{ Auth::user()->name }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Email:</span>
                                            <span class="fw-bold">{{ Auth::user()->email }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Peran:</span>
                                            <span class="fw-bold">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pengguna' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Bergabung Pada:</span>
                                            <span class="fw-bold">{{ Auth::user()->created_at->format('d M Y') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="fas fa-cog me-2"></i>Pengaturan Akun</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('profile.password') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-key me-2"></i>Ubah Password
                                        </a>
                                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-user-edit me-2"></i>Edit Profil
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->role === 'user')
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-title"><i class="fas fa-book-reader me-2"></i>Aktivitas Peminjaman</h6>
                            <div class="d-grid gap-2">
                                <a href="{{ route('user.loans.index') }}" class="btn btn-primary">
                                    <i class="fas fa-list me-2"></i>Lihat Riwayat Peminjaman
                                </a>
                                <a href="{{ route('user.loans.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Pinjam Buku Baru
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 