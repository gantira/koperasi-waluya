@extends('layouts.master', ['anggota'=>'active'])

@section('title', 'Tambah Anggota')

@section('content')
<div class="content">
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'anggota', 'method'=>'post']) !!}
                        @include('anggota.form', ['button' => 'Buat Anggota'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection