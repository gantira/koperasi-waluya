@extends('layouts.master', ['transaksi'=>'active'])

@section('title', 'Transaksi')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <p class="category"><a href="{{ url('pendapatan') }}"><i class="ti-layers"></i> Pendapatan</a></p>
                        <p class="category"><a href="{{ url('pengeluaran') }}"><i class="ti-layers"></i> Pengeluaran</a></p>
                    </div>
                    <div class="content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
