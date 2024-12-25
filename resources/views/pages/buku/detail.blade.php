@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/buku">buku</a></li>
          <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-content-center justify-content-between">
            <h4>Detail buku</h4>
            <a href="{{url(session('links')[1])}}" class="btn btn-warning">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <table class="table">
            <tr>
    <th>Judul</th>
    <td>{{$data->judul}}</td>
</tr>

<tr>
    <th>Penulis</th>
    <td>{{$data->penulis}}</td>
</tr>

<tr>
    <th>Kategori</th>
    <td>{{$data->kategori}}</td>
</tr>

<tr>
    <th>Penerbit</th>
    <td>{{$data->penerbit}}</td>
</tr>

<tr>
    <th>Foto</th>
    <td>{{$data->foto}}</td>
</tr>

<tr>
    <th>Stok</th>
    <td>{{$data->stok}}</td>
</tr>

<tr>
    <th>Deskripsi</th>
    <td>{{$data->deskripsi}}</td>
</tr>


        </table>
    </div>
  </div>
@endsection
