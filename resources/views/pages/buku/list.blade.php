@extends('layouts.app')

@section('breadcrumb')
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">buku</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-content-center justify-content-between mb-3">
                <h4 class="card-title mb-0">Data buku</h4>
                <div class="d-flex">
                    <!-- Button trigger modal -->
                    <a class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-cart-plus"></i> keranjang
                    </a>
                    <a href="{{ route('addbuku') }}" class="btn btn-primary me-2">
                        <span data-feather="plus"></span> Tambah
                    </a>
                    <a data-bs-toggle="collapse" href="#collapseImport" class="btn btn-info me-2">
                        <span data-feather="upload"></span> Import
                    </a>
                    <a href="/buku-export" class="btn btn-secondary">
                        <span data-feather="download"></span> Export
                    </a>
                </div>
            </div>
            <div class="collapse" id="collapseImport">
                <div class="card card-body">
                    <form action="/buku-import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="file" class="form-control">
                            <p class="mt-2"><a href="/imports/data_buku.xlsx">Download Template</a></p>
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-between align-content-center mb-3">
                <p class="m-0 py-2">Tampil {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }}
                    data</p>
                <form>
                    <div class="input-group">
                        <input type="search" name="cari" value="{{ request('cari') }}" class="form-control"
                            placeholder="Cari data..." aria-label="Cari data..." aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="row ">
                @foreach ($data as $buku)
                    <div class="col mt-3">
                        <div class="card" id="kartu"
                            style="width: 20rem; height: 25rem; background-image: url('{{ asset('file/' . $buku->foto) }}'); ">
                            {{-- <img src="{{ asset('file/' . $buku->foto) }}" class="calerd-img-top" alt="..."
                                style="height: 20rem;"> --}}
                            <div class="card-body" id="body">
                                <div class="contbody">
                                    <h5 class="card-title"> {{ $buku->judul }} </h5>
                                    <p class="card-text"> {{ $buku->deskripsi }} </p>
                                    <div class="col">
                                        <button class="add-book btn btn-warning btn-sm" data-id="{{ $buku->judul }}">
                                            <span data-feather="eye"></span>
                                        </button>
                                        {{-- <a class="btn btn-warning btn-sm add-book" data-id="{{ $buku->id }}" data-title="{{ $buku->judul }}">
                                            <span data-feather="eye"></span>
                                        </a> --}}
                                        <a class="btn btn-primary btn-sm" href="{{ route('edit', $buku->id) }}">
                                            <span data-feather="edit"></span>
                                        </a>
                                        <a>
                                            <form action="{{ route('bukdel', $buku->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><span
                                                        data-feather="trash"></span></button>
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- {!! $data->links() !!} --}}
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookForm" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="inputJudul" class="form-label">nama peminjam</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="form-control @error('judul') is-invalid @enderror" id="inputjudul"
                                aria-describedby="judulHelp">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                        <div id="booksList">
                            <label for="inputJudul" class="form-label">judul</label>
                            <!-- Buku yang akan ditambahkan akan muncul di sini -->
                        </div>
                        <div class="d-flex mt-3">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.querySelectorAll('.add-book').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah refresh halaman
                const bookId = this.getAttribute('data-id');
                // const bookTitle = this.getAttribute('data-title');

                // Buat elemen baru untuk menambahkan buku ke form
                const booksList = document.getElementById('booksList');
                const bookRow = document.createElement('div');
                bookRow.classList.add('book-row');
                bookRow.innerHTML = `
                 <div class="d-flex">
                    <input type="text" name="judul" value="${bookId}"
                        class="form-control @error('judul') is-invalid @enderror" id="inputjudul"
                        aria-describedby="judulHelp">
                    <button type="button" class="remove-book btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </div>
            `;
                booksList.appendChild(bookRow);

                // Tambahkan event listener untuk tombol hapus
                bookRow.querySelector('.remove-book').addEventListener('click', function() {
                    bookRow.remove();
                });
            });
        });
    </script>
@endsection
