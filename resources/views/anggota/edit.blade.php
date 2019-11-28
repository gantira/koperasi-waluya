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
                        {!! Form::model($anggota, ['url'=>'anggota/'.$anggota->id, 'method'=>'patch']) !!}
                        @include('anggota.form', ['button' => 'Update Anggota'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection