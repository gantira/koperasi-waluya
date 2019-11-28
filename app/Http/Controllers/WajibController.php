<?php

namespace App\Http\Controllers;

use App\Wajib;
use App\User;
use Session;
use App\Http\Requests\WajibRequest;
use Illuminate\Http\Request;

class WajibController extends Controller
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
        //     $data['wajib'] = Wajib::filter($awal,$akhir)->get();
        //     $data['sumMasuk'] = Wajib::whereBetween('tanggal', [$awal, $akhir])->sum('masuk');
        //     $data['sumKeluar'] = Wajib::whereBetween('tanggal', [$awal, $akhir])->sum('keluar');

        // }else {
        //     $data['wajib'] = Wajib::all();
        //     $data['sumMasuk'] = Wajib::sum('masuk');
        //     $data['sumKeluar'] = Wajib::sum('keluar');
        // }

        $data['wajib'] = Wajib::search($request->s)->orderBy('id', 'desc')->paginate(10);
        $data['sumMasuk'] = Wajib::search($request->s)->sum('masuk');
        $data['sumKeluar'] = Wajib::search($request->s)->sum('keluar');

        return view('simpanan.wajib.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kf'] = $this->kf();

        return view('simpanan.wajib.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WajibRequest $request)
    {
        $data = new Wajib;
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
     * @param  \App\Wajib  $wajib
     * @return \Illuminate\Http\Response
     */
    public function show($nomor)
    {
        $data = User::whereNoAnggota($nomor)->first();

        if ($data) {
            $saldo = $data->wajib()->selectRaw('CAST(sum(masuk) - sum(keluar) as UNSIGNED) as saldo')->value('saldo');
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
     * @param  \App\Wajib  $wajib
     * @return \Illuminate\Http\Response
     */
    public function edit(Wajib $wajib)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wajib  $wajib
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wajib $wajib)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wajib  $wajib
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wajib $wajib)
    {
        $wajib->delete();

        return json_encode(true);
    }

    public function kf()
    {
        $jml = Wajib::max('id')+1;
        $no_urut = 'W'.$jml;

        return $no_urut;
    }
}
