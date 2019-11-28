@extends('layouts.master', ['pinjaman'=>'active'])

@section('title', 'Pinjaman')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <p class="category"><a href="{{ url('angsuran') }}"><i class="ti-layers"></i> Angsuran</a></p>
                        <p class="category"><a href="{{ url('kilat') }}"><i class="ti-layers"></i> Kilat</a></p>
                    </div>
                    <div class="content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
