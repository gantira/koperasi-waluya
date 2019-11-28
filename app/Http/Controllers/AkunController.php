<?php

namespace App\Http\Controllers;

use App\Akun;
use App\Http\Requests\AkunRequest;
use Illuminate\Http\Request;
use App\Kategori;
use Session;

class AkunController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['akun'] = Akun::withTrashed()->orderBy('kode')->get();

        return view('akun.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AkunRequest $request)
    {
        Akun::create($request->all());

        Session::flash('message', 'Success! Simpan Data Berhasil.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        return $akun;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        return view('akun.edit', ['akun'=>$akun]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Akun $akun)
    {
        $akun->fill($request->all())->save();

        Session::flash('message', 'Success! Update Data Berhasil.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun)
    {
        $akun->delete();

        return json_encode(true);
    }

    public function active($akun)
    {
        Akun::withTrashed()->find($akun)->restore();

        Session::flash('message', 'Success! Anggota telah aktif.');
        return back();
    }
}

