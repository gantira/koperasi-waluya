@extends('layouts.master', ['transaksi'=>'active'])

@section('title', 'Tambah Transaksi Pendapatan')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'pendapatan', 'method'=>'post']) !!}
                        @include('transaksi.pendapatan.form', ['button' => 'OK'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
