<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
    	$data['kategori'] = Kategori::all();

    	return view('kategori.index', $data);
    }

    public function store(Request $request)
    {
    	Kategori::create($request->all());

    	return back();
    }

    public function destroy(Kategori $kategori)
    {
    	$kategori->delete();

    	return json_encode(true);
    }
}
