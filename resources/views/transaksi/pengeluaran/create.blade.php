@extends('layouts.master', ['transaksi'=>'active'])

@section('title', 'Tambah Transaksi Pengeluaran')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'pengeluaran', 'method'=>'post']) !!}
                        @include('transaksi.pengeluaran.form', ['button' => 'OK'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
