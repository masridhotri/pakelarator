@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/peminjaman">peminjaman</a></li>
          <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-content-center justify-content-between">
            <h4>Detail peminjaman</h4>
            <a href="{{url(session('links')[1])}}" class="btn btn-warning">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <table class="table">
            <tr>
    <th>nama peminjam</th>
    <td>{{$data->user}}</td>
</tr>

<tr>
    <th>judul buku</th>
    <td>{{$data->buku}}</td>
</tr>

<tr>
    <th>tanggal pinjam</th>
    <td>{{$data->tgl_pinjam}}</td>
</tr>

<tr>
    <th>tanggal kembali</th>
    <td>{{$data->tgl_kembali}}</td>
</tr>

<tr>
    <th>denda</th>
    <td>{{$data->denda}}</td>
</tr>


        </table>
    </div>
  </div>
@endsection
