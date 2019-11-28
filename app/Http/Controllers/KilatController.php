<?php

namespace App\Http\Controllers;

use App\Kilat;
use App\Wajib;
use App\User;
use App\Setting;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\KilatRequest;

class KilatController extends Controller
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
        $data['kilat'] = Kilat::search($request->s)->orderBy('id', 'desc')->paginate(10);
        
        return view('pinjaman.kilat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['setting'] = Setting::findOrFail(1);
        $data['kf'] = $this->kf();

        return view('pinjaman.kilat.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KilatRequest $request)
    {
        $cek_pinjaman = User::whereId($request->user_id)->whereHas('kilat', function ($query) {
            $query->whereFlagLunas(0);
        })->first();
        $data = User::find($request->user_id);

        if (Setting::value('cek_pinjaman')) {
            if ($request->pinjam > $this->maxPinjaman($data)) {
                Session::flash('message', 'Maaf! Saldo tidak memenuhi.');
                return back();
            }
            if ($cek_pinjaman) {
                Session::flash('message', 'Maaf! Anggota dalam masa pinjaman.');
                return back();
            }
        }
        
        Kilat::create($request->all());
        Wajib::create(['masuk'=>$request->pemupukan, 'user_id'=>$request->user_id, 'tanggal'=>$request->tanggal, 'kf'=>$request->kf]);

        Session::flash('message', 'Success! Anggota berhasil melakukan transaksi.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kilat  $kilat
     * @return \Illuminate\Http\Response
     */
    public function show($nomor)
    {
        $data = User::whereNoAnggota($nomor)->first();

        if ($data) {
            $data = array_merge($data->toArray(), ['saldo' => $this->maxPinjaman($data)]);
        }else {
            $data = null;
        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kilat  $kilat
     * @return \Illuminate\Http\Response
     */
    public function edit(Kilat $kilat)
    {
        $kilat->update(['flag_lunas'=>1]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kilat  $kilat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kilat $kilat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kilat  $kilat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kilat $kilat)
    {
        Wajib::whereKf($kilat->kf)->delete();

        return json_encode($kilat->delete());
    }

    public function cari($cari = null)
    {
        $data['kilat'] = User::where('no_anggota', 'like', '%'.$cari.'%')->get();
        
        return view('pinjaman.kilat.index', $data);
    }

    public function maxPinjaman($data)
    {
        return Setting::value('besar_kilat') * ($data->wajib()->sum('masuk') + $data->pokok()->sum('masuk'));
    }

    public function kf()
    {
        $jml = Kilat::max('id')+1;
        $no_urut = 'K'.$jml;

        return $no_urut;
    }


}
