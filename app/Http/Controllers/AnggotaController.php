<?php

namespace App\Http\Controllers;

use App\User;
use Session;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnggotaController extends Controller
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
        $data['anggota'] = User::withTrashed()->search($request->s)->get();

        return view('anggota.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->no_anggota = $this->noUrut();
        $user->save();

        Session::flash('message', 'Success! Tambah Anggota Berhasil.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $anggota)
    {
        return $anggota;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $anggota)
    {
        $data['no_urut'] = $this->noUrut();
        $data['anggota'] = $anggota;

        return view('anggota.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $anggota)
    {
        if ($request->password) {
            $anggota->fill($request->all())->save();
        }else {
            $anggota->fill($request->except('password'))->save();

        }

        Session::flash('message', 'Success! Edit Anggota Berhasil.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $anggota)
    {
        $anggota->delete();

        return json_encode(true);
    }

    public function active($anggota)
    {
        User::withTrashed()->find($anggota)->restore();

        Session::flash('message', 'Success! Anggota telah aktif.');
        return back();
    }

    public function noUrut()
    {
        $jml = User::withTrashed()->max('id')+1;
        $no_urut = Carbon::now()->year;

        if (strlen($jml) == 1) {
            $no_urut .= "00".$jml;
        }elseif (strlen($jml) == 2) {
            $no_urut .= "0".$jml;
        }elseif (strlen($jml) == 3) {
            $no_urut .= $jml;
        }

        return $no_urut;
    }
}
