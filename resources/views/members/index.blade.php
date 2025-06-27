@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Data Anggota Perpustakaan</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Data Anggota</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Email</th>
                    <th>ID Anggota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $key => $member)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->member_code }}</td>
                        <td>
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data anggota yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
