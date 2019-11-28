@extends('layouts.master', ['akun'=>'active'])

@section('title', 'Tambah Akun')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
        @include('layouts.alert')
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'akun', 'method'=>'post']) !!}
                            
                            @include('akun.form', ['button' => 'Buat Akun'])
                            
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection