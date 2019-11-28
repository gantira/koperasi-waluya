<?php

namespace App\Http\Controllers;

use App\Pokok;
use App\User;
use Session;
use App\Http\Requests\PokokRequest;
use Illuminate\Http\Request;

class PokokController extends Controller
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
        //     $data['pokok'] = Pokok::filter($awal,$akhir)->get();
        //     $data['sumMasuk'] = Pokok::whereBetween('tanggal', [$awal, $akhir])->sum('masuk');
        //     $data['sumKeluar'] = Pokok::whereBetween('tanggal', [$awal, $akhir])->sum('keluar');

        // }else {
        //     $data['pokok'] = Pokok::all();
        //     $data['sumMasuk'] = Pokok::sum('masuk');
        //     $data['sumKeluar'] = Pokok::sum('keluar');
        // }

        $data['pokok'] = Pokok::search($request->s)->orderBy('id', 'desc')->paginate(10);
        $data['sumMasuk'] = Pokok::search($request->s)->sum('masuk');
        $data['sumKeluar'] = Pokok::search($request->s)->sum('keluar');

        return view('simpanan.pokok.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kf'] = $this->kf();

        return view('simpanan.pokok.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PokokRequest $request)
    {
        $data = new Pokok;
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
     * @param  \App\pokok  $pokok
     * @return \Illuminate\Http\Response
     */
    public function show($nomor)
    {
        $data = User::whereNoAnggota($nomor)->first();

        if ($data) {
            $saldo = $data->pokok()->selectRaw('CAST(sum(masuk) - sum(keluar) as UNSIGNED) as saldo')->value('saldo');
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
     * @param  \App\pokok  $pokok
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokok $pokok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pokok  $pokok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pokok $pokok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pokok  $pokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokok $pokok)
    {
        $pokok->delete();

        return json_encode(true);
    }

    public function kf()
    {
        $jml = Pokok::max('id')+1;
        $no_urut = 'P'.$jml;

        return $no_urut;
    }
}
