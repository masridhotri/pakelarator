<?php

namespace App\Http\Controllers;

use App\Models\kategori;

use Illuminate\Http\Request;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::query();
        
        $sort = request('sort_val') ?? 'DESC';
        if(request('sort_name')=='nama'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $kategori->orderBy('nama', request('sort_val'));
}


        if(request('cari')){
    $kategori->where(function($q){
        $q->where('nama','LIKE','%'.request('cari').'%');
    });
}

        $kategori = $kategori->orderBy('created_at', $sort)->paginate()->withQueryString();

        return view('pages.kategori.list', [
            'data' => $kategori->withPath('kategori'),
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
        return view('pages.kategori.add',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
    'nama' => 'required'
];

$messages = [
    'nama.required' => 'kategori Wajib terisi!'
];


        $request->validate($rules, $messages);
        $datarow = $request->all();

        

        kategori::create($datarow);

        return redirect('kategori')->with('success', 'Success create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(kategori $kategori)
    {
        return view('pages.kategori.detail', [
            'data' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(kategori $kategori)
    {
        return view('pages.kategori.edit', [
            'data' => $kategori,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kategori $kategori)
    {
        $rules =[
    'nama' => 'required'
];

$messages = [
    'nama.required' => 'kategori Wajib terisi!'
];


        $request->validate($rules, $messages);
        $datarow = $request->all();

        

        $kategori->update($datarow);

        return redirect('kategori')->with('success', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
}
