<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RitRequest;
use App\Rit;
use App\User;
use App\Manasuka;
use App\Wajib;
use App\Setting;
use Session;

class RitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
    	$data['rit'] = Rit::orderBy('id', 'desc')->search($request->s)->paginate(10);

    	return view('rit.index', $data);
    }

    public function create()
    {
        $data['kf'] = $this->kf();

    	return view('rit.create', $data);
    }

    public function show($nomor)
    {
        $data = User::whereNoAnggota($nomor)->whereKeteranganAnggota('anggota')->first();

        if ($data) {
            $data = $data;
        }else {
            $data = null;
        }

        return $data;
    }

    public function show_perahu($nomor)
    {
        $data = User::whereNoPerahu($nomor)->whereKeteranganAnggota('perahu')->first();

        if ($data) {
            $data = $data;
        }else {
            $data = null;
        }
        
        return $data;
    }

    public function store(RitRequest $request)
    {
    	$cek = Rit::whereTanggal($request->tanggal)->whereUserId($request->user_id)->first();

    	if ($cek) {
    		Session::flash('message', 'Maaf! Anda sudah menginputkan transaksi rit untuk tanggal '. $request->tanggal);
    		return back();
    	}

    	Rit::create($request->all());

        $data = $request->all();
        $data['masuk'] = $request->jumlah_rit * Setting::max('rit_simpanan_wajib');
        Wajib::create($data);
        $data['masuk'] = $request->jumlah_rit * Setting::max('rit_simpanan_manasuka');
        Manasuka::create($data);

    	Session::flash('message', 'Success! Transaksi Berhasil.');
    	return back();
    }

    public function destroy(Rit $rit)
    {
        $rit->delete();

        Manasuka::whereKf($rit->kf)->delete();
        Wajib::whereKf($rit->kf)->delete();

        return json_encode(true);
    }

    public function update(Request $request, Rit $rit)
    {
        $data = $rit->update($request->all());
        $masuk = $request->jumlah_rit * Setting::max('rit_simpanan_wajib');
        Wajib::whereKf($rit->kf)->update(['masuk' => $masuk]);
        $masuk = $request->jumlah_rit * Setting::max('rit_simpanan_manasuka');
        Manasuka::whereKf($rit->kf)->update(['masuk' => $masuk]);

        return 'true';
    }

    public function kf()
    {
        $jml = Rit::max('id')+1;
        $no_urut = 'R'.$jml;

        return $no_urut;
    }

    public function cek($id)
    {
        return Rit::find($id);
    }
}
