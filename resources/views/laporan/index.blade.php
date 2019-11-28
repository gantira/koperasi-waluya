@extends('layouts.master', ['laporan'=>'active'])

@section('title', 'Laporan')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <p class="category"><a href="{{ url('laporan/anggota') }}"><i class="ti-book"></i> Anggota</a></p>
                        <p class="category"><a href="{{ url('laporan/keuangan') }}"><i class="ti-book"></i> Keuangan</a></p>
                        <p class="category"><a href="{{ url('laporan/rit') }}"><i class="ti-book"></i> Rit</a></p>
                    </div>
                    <div class="content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modal')

@endsection