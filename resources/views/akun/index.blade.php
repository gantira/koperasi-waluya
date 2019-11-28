@extends('layouts.master', ['akun'=>'active'])

@section('title', 'Akun')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <p class="category"><a href="{{ url('akun/create') }}"><i class="ti-view-list-alt"></i> Tambah</a></p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($akun as $key => $row)
                                <tr id="tr{{ $row->id }}">
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->kode !!}</td>
                                    <td>{!! $row->nama !!}</td>
                                    <td>{!! $row->kategori['nama'] !!}</td>
                                    <td>{!! $row->keterangan !!}</td>
                                     <td>{!! $row->deleted_at ? "<span class='label label-danger'>disable</span>" : "<span class='label label-success'>aktif</span>" !!}</td>
                                    <td>
                                        @if ($row->deleted_at)
                                        <a href="{{ url('akun/'.$row->id.'/active') }}"><i class="ti-reload" title="Aktif"></i></a>
                                        @else
                                        <a href="#"><i class="ti-trash" title="Hapus" onclick="hapus('{{ $row->id }}', '{{ $row->no_akun }}')"></i></a>
                                        <a href="#"><i class="ti-eye" title="View" onclick="show('{{ $row->id }}')"></i></a>
                                        <a href="{{ url('akun/'.$row->id.'/edit') }}"><i class="ti-pencil" title="Edit"></i></a>
                                        @endif
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
<!-- Button trigger modal -->

@include('modal')

@endsection

@push('scripts')
<script type="text/javascript">

    function hapus(id, nama) {
        var r = confirm('Menghapus '+nama+'. Anda Yakin?');
        
        if (r == true) {
            var dataString = { 
                _token : '{{ csrf_token() }}'
            };

            url = '{{ url('akun') }}/'+id;

            $.ajax({
                url: url,
                data: dataString,
                type: "DELETE",
                success: function(data){
                    console.log(data);
                    location.reload();
                }
            });
        }
    }

    function show(id) {
        $('#modalDetail').modal('show')  

        $.ajax({
            url: 'akun/'+id,
            type: "GET",
            success: function(data){
                console.log(data);
                document.getElementById("detail").innerHTML = "Kode : "+String(data.kode).bold()+"<br>"+
                                                              "Nama : "+String(data.nama).bold()+"<br>"+
                                                              "Keterangan : "+String(data.keterangan).bold();
            }
        }); 
    }
</script>
@endpush