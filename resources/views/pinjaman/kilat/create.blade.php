@extends('layouts.master', ['pinjaman'=>'active'])

@section('title', 'Tambah Pinjaman Kilat')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'kilat', 'method'=>'post']) !!}
                        @include('pinjaman.kilat.form', ['button' => 'OK'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
