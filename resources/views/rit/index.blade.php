@extends('layouts.master', ['rit'=>'active'])

@section('title', 'Rit Perahu')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <div class="clearfix">
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                            <div class="pull-left">
                                <p class="category "><a href="{{ url('rit/create') }}"><i class="ti-layers"></i> Tambah</a></p>
                            </div>
                            <div class="form-inline pull-right">

                                {!! Form::open(['url'=>'rit', 'method'=>'get']) !!}
                                <div class="form-inline pull-right">
                                    <div class="input-group">
                                        {!! Form::text('s', null, ['class'=>'form-control border-input', 'placeholder'=>'Kata Kunci']) !!}
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="submit">Cari</button>
                                        </span>
                                    </div>
                                </div>
                                {!! Form::close() !!}

                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Anggota</th>
                                    <th>Perahu</th>
                                    <th>Jumlah Rit</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rit as $key => $row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->tanggal !!}</td>
                                    <td>{!! $row->user->nama_depan !!} {!! $row->user->belakang !!}</td>
                                    <td>{!! $row->jumlah_rit !!}</td>
                                    <td><a href="#"><i class="ti-trash" title="Hapus" onclick="hapus('{{ $row->id }}', '{{ $key+1 }}')"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          
                        </table>

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                            {!! $rit->appends(['s' => Request::get('s')])->links() !!}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modal')

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });

    function hapus(id, nama) {
        var r = confirm('Menghapus ID '+nama+'. Anda Yakin?');
        
        if (r == true) {
            var dataString = { 
                _token : '{{ csrf_token() }}'
            };
            url = '{{ url('rit') }}/'+id;

            $.ajax({
                url: url,
                data: dataString,
                type: "DELETE",
                success: function(data){
                    console.log(data);
                    window.location.reload();
                }
            });
        }
    }

</script>
@endpush
