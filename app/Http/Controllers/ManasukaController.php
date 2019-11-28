<?php

namespace App\Http\Controllers;

use App\Manasuka;
use App\User;
use Session;
use App\Http\Requests\ManasukaRequest;
use Illuminate\Http\Request;

class ManasukaController extends Controller
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
        // $awal = $request->awal;
        // $akhir = $request->akhir;

        // if ($awal && $akhir) {
        //     $data['manasuka'] = Manasuka::filter($awal,$akhir)->get();
        //     $data['sumMasuk'] = Manasuka::whereBetween('tanggal', [$awal, $akhir])->sum('masuk');
        //     $data['sumKeluar'] = Manasuka::whereBetween('tanggal', [$awal, $akhir])->sum('keluar');

        // }else {
        //     $data['manasuka'] = Manasuka::all();
        //     $data['sumMasuk'] = Manasuka::sum('masuk');
        //     $data['sumKeluar'] = Manasuka::sum('keluar');
        // }

        $data['manasuka'] = Manasuka::search($request->s)->orderBy('id', 'desc')->paginate(10);
        $data['sumMasuk'] = Manasuka::search($request->s)->sum('masuk');
        $data['sumKeluar'] = Manasuka::search($request->s)->sum('keluar');

        return view('simpanan.manasuka.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kf'] = $this->kf();

        return view('simpanan.manasuka.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManasukaRequest $request)
    {
        $data = new Manasuka;
        $data->fill($request->all());

        if ($request->jenis == 'simpan') {
            $data->masuk = $request->jumlah;
            
            $data->save();
            Session::flash('message', 'Success! Simpan Berhasil');
            return back();
        }elseif ($request->jenis == 'keluar') {
            $saldo = $data->whereUserId($request->user_id)->selectRaw('CAST(sum(masuk) - sum(keluar) as UNSIGNED) as saldo')->value('saldo');
            if ($request->jumlah > $saldo) {
                Session::flash('message', 'Maaf! Saldo Tidak Mencukupi.');
                return back();
            }else{
                $data->keluar = $request->jumlah;
                $data->save();

                Session::flash('message', 'Success! Ambil Simpanan Berhasil.');
                return back();
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\manasuka  $manasuka
     * @return \Illuminate\Http\Response
     */
    public function show($nomor)
    {
        $data = User::whereNoAnggota($nomor)->first();

        if ($data) {
            $saldo = $data->manasuka()->selectRaw('CAST(sum(masuk) - sum(keluar) as UNSIGNED) as saldo')->value('saldo');
            if (is_null($saldo)) { 
                $saldo = 0;
            }
            $data = array_merge($data->toArray(), ['saldo' => $saldo]);
        }else {
            $data = null;
        }
        

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\manasuka  $manasuka
     * @return \Illuminate\Http\Response
     */
    public function edit(Manasuka $manasuka)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\manasuka  $manasuka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manasuka $manasuka)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\manasuka  $manasuka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manasuka $manasuka)
    {
        $manasuka->delete();

        return json_encode(true);
    }

    public function kf()
    {
        $jml = Manasuka::max('id')+1;
        $no_urut = 'M'.$jml;

        return $no_urut;
    }
}
