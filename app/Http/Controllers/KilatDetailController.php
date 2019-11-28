<?php

namespace App\Http\Controllers;

use App\Kilat;
use App\KilatDetail;
use Illuminate\Http\Request;
use App\Http\Requests\KilatDetailRequest;

class KilatDetailController extends Controller
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
    public function store(KilatDetailRequest $request)
    {
        KilatDetail::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KilatDetail  $kilatDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Kilat $kilatDetail)
    {
        $data['kilat'] = $kilatDetail;
        $data['kilatDetail'] = $kilatDetail->kilatDetail;
        $data['bayar'] = $kilatDetail->pinjam/$kilatDetail->cicilan;
        $subtotal = $kilatDetail->kilatDetail()->latest()->value('subtotal');
        $subtotal = $subtotal ? ($kilatDetail->pinjam-$kilatDetail->kilatDetail->sum('bayar'))*$kilatDetail->jasa/100 : $kilatDetail->pinjam*$kilatDetail->jasa/100;
        $data['jasa'] = $subtotal;
        $data['total_bayar'] = $kilatDetail->kilatDetail->sum('bayar');
        $data['total_jasa'] = $kilatDetail->kilatDetail->sum('jasa');
        $data['subtotal'] = $kilatDetail->kilatDetail->sum('subtotal');

        return view('pinjaman.kilat.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KilatDetail  $kilatDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Kilat $kilatDetail)
    {
        $kilatDetail->update(['flag_lunas'=>0]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KilatDetail  $kilatDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KilatDetail $kilatDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KilatDetail  $kilatDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(KilatDetail $kilatDetail)
    {
        return json_encode($kilatDetail->delete());
    }
}
