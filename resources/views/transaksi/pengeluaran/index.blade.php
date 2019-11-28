@extends('layouts.master', ['transaksi'=>'active'])

@section('title', 'Transaksi Pengeluaran')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <div class="clearfix">
                            <div class="pull-left">
                                <p class="category "><a href="{{ url('pengeluaran/create') }}"><i class="ti-layers"></i> Tambah</a></p>
                            </div>
                            {!! Form::open(['url'=>'pengeluaran', 'method'=>'get']) !!}
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
                    </div>

                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Akun</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Keterangan</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $key => $row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->tanggal !!}</td>
                                    <td>{!! $row->akun->kode !!} - {!! $row->akun->nama !!}</td>
                                    <td>{!! number_format($row->masuk) !!}</td>
                                    <td>{!! number_format($row->keluar) !!}</td>
                                    <td>{!! $row->keterangan !!}</td>
                                    <td><a href="#"><i class="ti-trash" title="Hapus" onclick="hapus('{{ $row->id }}', '{{ $key+1 }}')"></i></a>
                                    </td>
                                </tr>
                            @if ($loop->last)
                            <tfoot>
                                <tr style="font-weight: bold"> 
                                    <td colspan="3" class="text-center">TOTAL</td>
                                    <td>{!! number_format($sumMasuk) !!}</td>
                                    <td>{!! number_format($sumKeluar) !!}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            @endif
                            @endforeach
                            </tbody>
                        </table>

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                            {!! $transaksi->appends(['s' => Request::get('s')])->links() !!}
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
            url = '{{ url('pengeluaran') }}/'+id;

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