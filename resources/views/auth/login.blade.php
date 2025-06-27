@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-success text-white text-center py-4" style="background-color: #006b00 !important;">
                    <h3 class="mb-0 fw-bold">Selamat Datang</h3>
                    <p class="mb-0">Silakan login untuk melanjutkan</p>
                </div>
                <div class="card-body p-5">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Masukkan email Anda" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Masukkan password Anda" required>
                                <span class="input-group-text bg-light" style="cursor: pointer;" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="togglePassword"></i>
                                </span>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="captcha" class="form-label fw-bold">Captcha</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light captcha-image">{!! captcha_img() !!}</span>
                                <input type="text" class="form-control @error('captcha') is-invalid @enderror"
                                       id="captcha" name="captcha" placeholder="Masukkan Captcha" required>
                                <button type="button" class="btn btn-outline-secondary" id="reload-captcha">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                @error('captcha')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        background: #fff !important;
    }
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .btn-primary {
        background: linear-gradient(45deg, #006b00, #006b00);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #006b00, #006b00);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 107, 0, 0.3);
    }
    .input-group-text {
        border: none;
    }
    .form-control {
        border: 1px solid #e0e0e0;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 107, 0, 0.25);
        border-color: #006b00;
    }
</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePassword');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

document.getElementById('reload-captcha').addEventListener('click', function () {
    fetch('{{ route("captcha.reload") }}')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.captcha-image').innerHTML = data.captcha;
        });
});
</script>
@endpush
@endsection 