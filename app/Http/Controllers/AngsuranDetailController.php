<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\AngsuranDetail;
use Illuminate\Http\Request;
use App\Http\Requests\AngsuranDetailRequest;

class AngsuranDetailController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AngsuranDetailRequest $request)
    {
        AngsuranDetail::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AngsuranDetail  $angsuranDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Angsuran $angsuranDetail)
    {
        $data['angsuran'] = $angsuranDetail;
        $data['angsuranDetail'] = $angsuranDetail->angsuranDetail;
        $data['bayar'] = $angsuranDetail->pinjam/$angsuranDetail->cicilan;
        $subtotal = $angsuranDetail->angsuranDetail()->latest()->value('subtotal');
        $subtotal = $subtotal ? ($angsuranDetail->pinjam-$angsuranDetail->angsuranDetail->sum('bayar'))*$angsuranDetail->jasa/100 : $angsuranDetail->pinjam*$angsuranDetail->jasa/100;
        $data['jasa'] = $subtotal;
        $data['total_bayar'] = $angsuranDetail->angsuranDetail->sum('bayar');
        $data['total_jasa'] = $angsuranDetail->angsuranDetail->sum('jasa');
        $data['subtotal'] = $angsuranDetail->angsuranDetail->sum('subtotal');

        return view('pinjaman.angsuran.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AngsuranDetail  $angsuranDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Angsuran $angsuranDetail)
    {
        $angsuranDetail->update(['flag_lunas'=>0]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AngsuranDetail  $angsuranDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AngsuranDetail $angsuranDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AngsuranDetail  $angsuranDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AngsuranDetail $angsuranDetail)
    {
        return json_encode($angsuranDetail->delete());
    }
}
