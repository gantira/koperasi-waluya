@extends('layouts.master', ['simpanan'=>'active'])

@section('title', 'Simpanan')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <p class="category"><a href="{{ url('wajib') }}"><i class="ti-layers"></i> Wajib</a></p>
                        <p class="category"><a href="{{ url('pokok') }}"><i class="ti-layers"></i> Pokok</a></p>
                        <p class="category"><a href="{{ url('manasuka') }}"><i class="ti-layers"></i> Manasuka</a></p>
                    </div>
                    <div class="content">
                        
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

            $.ajax({
                url: 'simpanan/'+id,
                data: dataString,
                type: "DELETE",
                success: function(data){
                    console.log(data);
                    $("#tr"+id).remove();

                    $.notify({
                        icon: 'ti-trash',
                        message: nama.bold()+" berhasil dihapus! ",

                    },{
                        type: 'success',
                        timer: 4000
                    });
                }
            });
        }
    }

    function show(id) {
        $('#modalDetail').modal('show')  

        $.ajax({
            url: 'simpanan/'+id,
            type: "GET",
            success: function(data){
                console.log(data);

                document.getElementById("detail").innerHTML = "No simpanan : "+data.no_simpanan.bold()+"<br>"+
                                                              "No Identitas : "+data.no_identitas.bold()+"<br>"+
                                                              "Nama  : "+data.nama_depan.bold()+" "+data.nama_belakang.bold()+"<br>"+
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