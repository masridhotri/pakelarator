<?php

namespace App\Http\Controllers;

use App\Exports\peminjamanExport;
use App\Models\peminjaman;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class peminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = peminjaman::query();

        $sort = request('sort_val') ?? 'DESC';
        if (request('sort_name') == 'user') {
            $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
            $peminjaman->orderBy('user', request('sort_val'));
        }

        if (request('sort_name') == 'buku') {
            $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
            $peminjaman->orderBy('buku', request('sort_val'));
        }

        if (request('sort_name') == 'tgl_pinjam') {
            $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
            $peminjaman->orderBy('tgl_pinjam', request('sort_val'));
        }

        if (request('sort_name') == 'tgl_kembali') {
            $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
            $peminjaman->orderBy('tgl_kembali', request('sort_val'));
        }

        if (request('sort_name') == 'denda') {
            $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
            $peminjaman->orderBy('denda', request('sort_val'));
        }


        if (request('cari')) {
            $peminjaman->where(function ($q) {
                $q->where('user', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('buku', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('tgl_pinjam', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('tgl_kembali', 'LIKE', '%' . request('cari') . '%')
                    ->orWhere('denda', 'LIKE', '%' . request('cari') . '%');
            });
        }

        $peminjaman = $peminjaman->orderBy('created_at', $sort)->paginate()->withQueryString();

        return view('pages.peminjaman.list', [
            'data' => $peminjaman->withPath('peminjaman'),
            'sort' => $sort
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.peminjaman.add', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user' => 'required',
            'buku' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'denda' => 'required'
        ];

        $messages = [
            'user.required' => 'nama peminjam Wajib terisi!',
            'buku.required' => 'judul buku Wajib terisi!',
            'tgl_pinjam.required' => 'tanggal pinjam Wajib terisi!',
            'tgl_kembali.required' => 'tanggal kembali Wajib terisi!',
            'denda.required' => 'denda Wajib terisi!'
        ];


        $request->validate($rules, $messages);
        $datarow = $request->all();



        peminjaman::create($datarow);

        return redirect('peminjaman')->with('success', 'Success create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(peminjaman $peminjaman)
    {
        return view('pages.peminjaman.detail', [
            'data' => $peminjaman
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(peminjaman $peminjaman)
    {
        return view('pages.peminjaman.edit', [
            'data' => $peminjaman,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peminjaman $peminjaman)
    {
        $rules = [
            'user' => 'required',
            'buku' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'denda' => 'required'
        ];

        $messages = [
            'user.required' => 'nama peminjam Wajib terisi!',
            'buku.required' => 'judul buku Wajib terisi!',
            'tgl_pinjam.required' => 'tanggal pinjam Wajib terisi!',
            'tgl_kembali.required' => 'tanggal kembali Wajib terisi!',
            'denda.required' => 'denda Wajib terisi!'
        ];


        $request->validate($rules, $messages);
        $datarow = $request->all();



        $peminjaman->update($datarow);

        return redirect('peminjaman')->with('success', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(peminjaman $peminjaman)
    {

        $peminjaman->delete();
        return redirect('peminjaman')->with('success', 'Success delete data');
    }

    public function export()
    {
        return Excel::download(new peminjamanExport, 'peminjamen.xlsx');
    }

    // public function import(Request $request)
    // {
    //     Excel::import(new peminjamanImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

    //     return redirect('/peminjaman')->with('success', 'All good!');
    // }
}
