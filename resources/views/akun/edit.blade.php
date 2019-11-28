@extends('layouts.master', ['akun'=>'active'])

@section('title', 'Tambah Akun')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.alert')
                <div class="card">
                    <div class="content">
                        {!! Form::model($akun, ['url'=>'akun/'.$akun->id, 'method'=>'patch']) !!}
                            
                            @include('akun.form', ['button' => 'Update Akun'])
                            
                        {!! Form::close() !!}
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection