<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    function index(){
        $data = kategori::with('bukus')->get();
        $cart = Session::get('cart', []);
       
        return view('dashboard',compact('data','cart'));
       
    }
  
    // // Tambah item ke cart
    // public function add(Request $request)
    // {
    //     $cart = Session::get('cart', []);
    
    //     // Tambahkan item ke keranjang
    //     $id = $request->id;
    //     $judul = $request->judul;
    //     $userName = $request->userName;
    
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] += 1;
    //     } else {
    //         $cart[$id] = [
    //             'id' => $id,
    //             'judul' => $judul,
    //             'userName' => $userName, // Simpan nama pengguna
    //             'quantity' => 1
    //         ];
    //     }
    
    //     Session::put('cart', $cart);
    //     dd($request);
    
    //     return response()->json($cart);
    // }
    

    // // Update item quantity
    // public function update(Request $request)
    // {
    //     $id = $request->id;
    //     $quantity = $request->quantity;

    //     $cart = Session::get('cart', []);
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] = $quantity;
    //     }

    //     Session::put('cart', $cart);
    //     return response()->json($cart);
    // }

    // // Hapus item dari cart
    // public function remove(Request $request)
    // {
    //     $id = $request->id;

    //     $cart = Session::get('cart', []);
    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
    //     }

    //     Session::put('cart', $cart);
    //     return response()->json($cart);
    // }
}


