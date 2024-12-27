@extends('layouts.app')

@section('breadcrumb')
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/buku">buku</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Ubah buku</h4>
                <a href="{{ url(session('links')[1]) }}" class="btn btn-warning">
                    <span data-feather="arrow-left"></span> Kembali
                </a>
            </div>
            <form method="POST" class="" action="{{route('bupdate',$data->id)}}" enctype="multipart/form-data">
               
                @csrf
                <div class="mb-3">
                    <label for="inputJudul" class="form-label">Judul</label>
                    <input type="text" name="judul" value="{{ $data->judul }}"
                        class="form-control @error('judul') is-invalid @enderror" id="inputjudul"
                        aria-describedby="judulHelp">
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputPenulis" class="form-label">Penulis</label>
                    <input type="text" name="penulis" value="{{ $data->penulis }}"
                        class="form-control @error('penulis') is-invalid @enderror" id="inputpenulis"
                        aria-describedby="penulisHelp">
                    @error('penulis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleSelectrole">kategori</label>
                    <select class="form-control" name="kategoris" id="exampleSelectrole">
                        @foreach ($kategori as $kate)
                            <option value="{{ $kate->id }}" {{ $kate->id == old('kategoris_id') ? 'selected' : '' }}>
                                {{ $kate->nama }} <!-- Sesuaikan dengan nama kolom -->
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputPenerbit" class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ $data->penerbit }}"
                        class="form-control @error('penerbit') is-invalid @enderror" id="inputpenerbit"
                        aria-describedby="penerbitHelp">
                    @error('penerbit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputFoto" class="form-label">Foto</label>
                    <input type="text" name="foto" value="{{ $data->foto }}"
                        class="form-control @error('foto') is-invalid @enderror" id="inputfoto" aria-describedby="fotoHelp">
                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputStok" class="form-label">Stok</label>
                    <input type="text" name="stok" value="{{ $data->stok }}"
                        class="form-control @error('stok') is-invalid @enderror" id="inputstok" aria-describedby="stokHelp">
                    @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputDeskripsi" class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" value="{{ $data->deskripsi }}"
                        class="form-control @error('deskripsi') is-invalid @enderror" id="inputdeskripsi"
                        aria-describedby="deskripsiHelp">
                    @error('deskripsi')
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
