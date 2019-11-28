<?php

namespace App\Http\Controllers;
use App\Transaksi;
use App\Akun;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\PendapatanRequest;

class PendapatanController extends Controller
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
    public function index(Request $request)
    {

        $data['transaksi'] = Transaksi::search($request->s)->orderBy('id', 'desc')->paginate(10);
        $data['sumMasuk'] = Transaksi::search($request->s)->sum('masuk');
        $data['sumKeluar'] = Transaksi::search($request->s)->sum('keluar');

        return view('transaksi.pendapatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['akun'] = Akun::whereKeterangan('masuk')->pluck('nama', 'id');

        return view('transaksi.pendapatan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PendapatanRequest $request)
    {
        Transaksi::create($request->all());

        Session::flash('message', 'Success! Data Berhasil Disimpan.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $pendapatan)
    {
        return json_encode($pendapatan->delete());
    }
}
