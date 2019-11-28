@extends('layouts.master', ['anggota'=>'active'])

@section('title', 'Anggota')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                            <div class="pull-left">
                                <p class="category "><a href="{{ url('anggota/create') }}"><i class="ti-user"></i> Tambah</a></p>
                            </div>
                            {!! Form::open(['url'=>'anggota', 'method'=>'get']) !!}
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
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No Anggota</th>
                                    <th>No Identitas</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $key => $row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->no_anggota !!}</td>
                                    <td>{!! $row->no_identitas !!}</td>
                                    <td>{!! $row->nama_depan !!} {!! $row->nama_belakang !!}</td>
                                    <td><span class="label label-danger">{!! $row->keterangan_anggota !!} {!! $row->keterangan_anggota == 'perahu' ? $row->no_perahu : '' !!}</span></td>
                                    <td><span class="label label-default">{!! $row->role !!}</span></td> 
                                    <td>{!! $row->deleted_at ? "<span class='label label-danger'>keluar</span>" : "<span class='label label-success'>aktif</span>" !!}</td>
                                    <td>
                                        @if ($row->deleted_at)
                                        <a href="{{ url('anggota/'.$row->id.'/active') }}"><i class="ti-reload" title="Aktif"></i></a>
                                        @else
                                        <a href="#"><i class="ti-trash" title="Hapus" onclick="hapus('{{ $row->id }}', '{{ $row->no_anggota }}')"></i></a>
                                        <a href="#"><i class="ti-eye" title="View" onclick="show('{{ $row->id }}')"></i></a>
                                        <a href="{{ url('anggota/'.$row->id.'/edit') }}"><i class="ti-pencil" title="Edit"></i></a>
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
            
            url = '{{ url('anggota') }}/'+id;

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
            url: 'anggota/'+id,
            type: "GET",
            success: function(data){
                console.log(data);

                document.getElementById("detail").innerHTML = "No Anggota : "+data.no_anggota.bold()+"<br>"+
                                                              "No Identitas : "+data.no_identitas.bold()+"<br>"+
                                                              "Nama  : "+data.nama_depan.bold()+" "+data.nama_belakang.bold()+"<br>"+
                                                              "JK  : "+data.jk.bold()+"<br>"+
                                                              "Alamat  : "+data.alamat.bold()+"<br>"+
                                                              "Tempat Lahir  : "+data.tempat_lahir.bold()+"<br>"+
                                                              "Tanggal Lahir  : "+data.tanggal_lahir.bold()+"<br>"+
                                                              "Email  : "+data.email.bold()+"<br>"+
                                                              "HP  : "+data.hp.bold()+"<br>"+
                                                              "Kota  : "+data.kota.bold()+"<br>"+
                                                              "Provinsi  : "+data.provinsi.bold()+"<br>"+
                                                              "Kode Pos  : "+data.kode_pos.bold()+"<br>"+
                                                              "Biodata  : "+data.biodata.bold()+"<br>"
            }
        }); 
    }
</script>
@endpush