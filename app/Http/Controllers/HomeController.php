<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use App\Models\buku;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    function index(){
      
      $bukuter = buku::count(); 
        return view('dashboard',compact('bukuter'));
       
    }

}


