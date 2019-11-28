@extends('layouts.master', ['dashboard'=>'active'])

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="container-fluid">
            
                
            <h3 class="text-center">Selamat Datang di Aplikasi Informasi Koperasi Waluya</h3 class="text-center">
          
    </div>
    <div class="container-fluid">
            
                
            <h3 class="text-center">RAT Tahun 2017 akan dilaksnakan pada Hari Kamis, 25 Januari 2018 Jam 20:00 WIB</h3 class="text-center">
          
    </div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        demo.initChartist();

        $.notify({
            icon: 'ti-themify-favicon',
            message: "Selamat Datang {!! ucfirst(Auth::user()->nama_depan) . ' ' . ucfirst(Auth::user()->nama_belakang) !!}."

        },{
            type: 'success',
            timer: 4000
        });

    });
</script>
@endpush
