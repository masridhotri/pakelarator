<?php

namespace App\Http\Controllers;

use App\Exports\bukuExport;
use App\Models\buku;
use App\Imports\bukuImport;
use App\Models\kategori;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class bukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = buku::query();
      


        $sort = request('sort_val') ?? 'DESC';
        if (request('sort_name') == 'judul') {
            $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
            $buku->orderBy('judul', request('sort_val'));
        }

        if (request('cari')) {
            $buku->where(function ($q) {
                $q->where('judul', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('penulis', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('kategoris_id', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('penerbit', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('foto', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('stok', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . request('cari') . '%');
            });
        }

        $buku = $buku->orderBy('created_at', $sort)->paginate()->withQueryString();

        return view('pages.buku.list', [
            'data' => $buku->withPath('buku'),
            'sort' => $sort,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kategori = kategori::all(); // Ambil semua kategori dari tabel

        return view('pages.buku.add', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filepath = public_path('file');
        $buku = new buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->kategori_id = $request->kategoris;
        // $buku->harga = $request->harga;
        $buku->stok = $request->stok;
        $buku->deskripsi = $request->deskripsi;


        if ($request->hasfile('foto')) {
            $file = $request->file('foto');
            $file_name = time() . $file->getClientOriginalName();

            $file->move(public_path('file'), $file_name);
            $buku->foto = $file_name;
        }

        $buku->save();
       
        return redirect('buku')->with('success', 'Success create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(buku $buku)
    {
        return view('pages.buku.detail', [
            'data' => $buku
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(buku $buku)
    {
        return view('pages.buku.edit', [
            'data' => $buku,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, buku $buku)
    {
        $rules = [
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'penerbit' => 'required',
            'foto' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required'
        ];

        $messages = [
            'judul.required' => 'Judul Wajib terisi!',
            'penulis.required' => 'Penulis Wajib terisi!',
            'kategori.required' => 'Kategori Wajib terisi!',
            'penerbit.required' => 'Penerbit Wajib terisi!',
            'foto.required' => 'Foto Wajib terisi!',
            'stok.required' => 'Stok Wajib terisi!',
            'deskripsi.required' => 'Deskripsi Wajib terisi!'
        ];


        $request->validate($rules, $messages);
        $datarow = $request->all();



        $buku->update($datarow);

        return redirect('buku')->with('success', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = buku::find($id);     
        $buku->delete();
        return redirect()->route('showbuku');
    }

    public function export()
    {
        return Excel::download(new bukuExport, 'bukus.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new bukuImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect('/buku')->with('success', 'All good!');
    }
}
