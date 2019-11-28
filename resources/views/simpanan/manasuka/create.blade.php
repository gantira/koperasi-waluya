@extends('layouts.master', ['simpanan'=>'active'])

@section('title', 'Tambah Simpanan Manasuka')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'manasuka', 'method'=>'post']) !!}
                        @include('simpanan.manasuka.form', ['button' => 'OK'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection