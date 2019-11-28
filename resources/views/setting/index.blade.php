@extends('layouts.master', ['setting'=>'active'])

@section('title', 'Settings')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
        	@include('layouts.alert')
                {!! Form::model($setting, ['url'=>'setting/'.$setting->id, 'method'=>'patch']) !!}
                @include('setting.form', ['button' => 'Update Setting'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection