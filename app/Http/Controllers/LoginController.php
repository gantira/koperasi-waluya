<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\NewPasswordRequest;
use Auth;
use App\User;
use Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request) 
    {

        $credentials = $request->only('no_anggota', 'password');

        $credentials = [
            'no_anggota' => $request->no_anggota,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials)) {
            return redirect('/');
        }else {
            Session::flash('message', 'Wrong Number and Password');
            return back();
        }
    }

    public function formreset()
    {
        return view('reset.index');
    }

    public function reset(Request $request)
    {
        $user = User::whereNoAnggota($request->no_anggota)->whereTanggalLahir($request->tanggal_lahir)->first();
        if ($user) {
            return view('reset.newpassword')->with('user', $user);
        }

        Session::flash('message', 'Reset password fail.');
        return back();
    }

    public function newpassword(Request $request)
    {
        User::whereNoAnggota($request->no_anggota)->update(['password'=>bcrypt($request->password)]);

        Session::flash('message', 'Reset Password Berhasil.');
        return redirect('login');
    }

    public function logout() 
    {
        Auth::logout();

        return redirect('login');
    }
}
