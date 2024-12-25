@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/peminjaman">peminjaman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-content-center justify-content-between">
            <h4>Tambah peminjaman</h4>
            <a href="{{url(session('links')[1])}}" class="btn btn-warning">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <form method="POST" class="" action="/peminjaman" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
    <label for="inputUser" class="form-label">nama peminjam</label>
    <input type="text" name="user" value="{{old('user')}}"
        class="form-control @error('user') is-invalid @enderror" id="inputuser"
        aria-describedby="userHelp">
    @error('user')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="mb-3">
    <label for="inputBuku" class="form-label">judul buku</label>
    <input type="text" name="buku" value="{{old('buku')}}"
        class="form-control @error('buku') is-invalid @enderror" id="inputbuku"
        aria-describedby="bukuHelp">
    @error('buku')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="mb-3">
    <label for="inputTgl_pinjam" class="form-label">tanggal pinjam</label>
    <input type="date" name="tgl_pinjam" value="{{old('tgl_pinjam')}}"
        class="form-control @error('tgl_pinjam') is-invalid @enderror" id="inputtgl_pinjam"
        aria-describedby="tgl_pinjamHelp">
    @error('tgl_pinjam')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="mb-3">
    <label for="inputTgl_kembali" class="form-label">tanggal kembali</label>
    <input type="date" name="tgl_kembali" value="{{old('tgl_kembali')}}"
        class="form-control @error('tgl_kembali') is-invalid @enderror" id="inputtgl_kembali"
        aria-describedby="tgl_kembaliHelp">
    @error('tgl_kembali')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="mb-3">
    <label for="inputDenda" class="form-label">denda</label>
    <input type="number" name="denda" value="{{old('denda')}}"
        class="form-control @error('denda') is-invalid @enderror" id="inputdenda"
        aria-describedby="dendaHelp">
    @error('denda')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
