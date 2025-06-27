@extends('layouts.app')

@section('title', 'Tentang Kami - LibraryHub')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 fw-bold mb-4">Tentang LibraryHub</h1>
            <p class="lead text-muted">Perpustakaan digital modern untuk semua kebutuhan literasi Anda</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5">
                    <h2 class="mb-4">Visi</h2>
                    <p>Menjadi platform perpustakaan digital terdepan yang menyediakan akses pengetahuan untuk semua kalangan masyarakat, mendorong budaya literasi, dan mendukung pembelajaran sepanjang hayat.</p>
                    <p>Kami percaya bahwa akses terhadap informasi dan pengetahuan adalah hak setiap orang, dan teknologi dapat menjembatani kesenjangan akses tersebut.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5">
                    <h2 class="mb-4">Misi</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Menyediakan akses mudah ke koleksi buku digital berkualitas</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Mengembangkan sistem perpustakaan yang efisien dan user-friendly</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Mendorong minat baca dan pembelajaran di masyarakat</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Membangun komunitas pembaca yang aktif dan kolaboratif</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Terus berinovasi mengikuti perkembangan teknologi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    top: 6px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
}

.timeline::before {
    content: '';
    position: absolute;
    left: -23px;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #e9ecef;
}

.avatar-circle {
    width: 100px;
    height: 100px;
    background-color: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: bold;
}

.team-card {
    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
}

.p {
    text-align: justify;
}
</style>
@endpush 