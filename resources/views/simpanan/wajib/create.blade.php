@extends('layouts.master', ['simpanan'=>'active'])

@section('title', 'Tambah Simpanan Wajib')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'wajib', 'method'=>'post']) !!}
                        @include('simpanan.wajib.form', ['button' => 'OK'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection