@extends('layouts.master', ['pinjaman'=>'active'])

@section('title', 'Tambah Pinjaman Angsuran')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="content">
                        {!! Form::open(['url'=>'angsuran', 'method'=>'post']) !!}
                        @include('pinjaman.angsuran.form', ['button' => 'OK'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
