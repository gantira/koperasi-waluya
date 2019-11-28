@extends('layouts.master', ['akun'=>'active'])

@section('title', 'Tambah Kategori')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">

                                {!! Form::open(['url'=>'kategori', 'method'=>'post', 'class'=>'form-inline']) !!}
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
                                    <label>Nama Kategori</label>
                                    {!! Form::text('nama', null, ['class'=>'form-control border-input', 'placeholder'=>'Nama']) !!}
                                    
                                    <span class="help-block {{ $errors->has('kode') ? 'has-error' : '' }}">
                                        <small>{{ $errors->first('kode') }}</small>
                                    </span>
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    {!! Form::submit('Tambah', ['class'=>'btn btn-info btn-fill ']) !!}
                                </div>
                            </div>
                                {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $key => $row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->nama !!}</td>
                                    <td><a href="#"><i class="ti-trash" title="Hapus" onclick="hapus('{{ $row->id }}', '{{ $row->nama }}')"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        var r = confirm('Menghapus '+nama+'. Anda Yakin?');
        
        if (r == true) {
            var dataString = { 
                _token : '{{ csrf_token() }}'
            };
            url = '{{ url('kategori') }}/'+id;

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