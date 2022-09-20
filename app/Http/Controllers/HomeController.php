<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $noticias = Noticia::all();
        return view('home', compact("noticias"));
    }
}
