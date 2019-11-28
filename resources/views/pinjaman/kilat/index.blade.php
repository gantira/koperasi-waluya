@extends('layouts.master', ['pinjaman'=>'active'])

@section('title', 'Pinjaman Kilat')
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
                                <p class="category "><a href="{{ url('kilat/create') }}"><i class="ti-layers"></i> Tambah</a></p>
                            </div>
                            {!! Form::open(['url'=>'kilat', 'method'=>'get']) !!}
                            <div class="form-inline pull-right">
                                <div class="input-group">
                                    {!! Form::text('s', null, ['class'=>'form-control border-input', 'placeholder'=>'Kata Kunci']) !!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="submit">Cari</button>
                                    </span>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @endif
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nomor</th>
                                <th>Pinjam</th>
                                <th>Cicilan</th>
                                <th>Setor</th>
                                <th>Sisa Bayar</th>
                                <th>Jasa Kilat</th>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                                <th>Aksi</th>
                                @endif
                            </thead>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                            <tbody>
                                @foreach ($kilat as $key => $row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->tanggal !!}</td>
                                    <td><a href="#" data-toggle="tooltip" title="{!! $row->user->nama_depan !!} {!! $row->user->nama_belakang !!}">{!! $row->user->no_anggota !!}</a></td>
                                    <td>{!! number_format($row->pinjam) !!}</td>
                                    <td>{!! $row->cicilan !!} ({!! $row->kilatDetail->count() !!})</td>
                                    <td>{!! number_format($row->kilatDetail->sum('bayar')) !!}</td>
                                    <td {!! number_format(abs($row->pinjam-$row->kilatDetail->sum('bayar'))) > 0 ? "style='color:red'"  : '' !!}>{!! number_format(abs($row->pinjam-$row->kilatDetail->sum('bayar'))) !!}</td>
                                    <td>{!! number_format($row->kilatDetail()->sum('jasa')) !!}</td>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                                    <td>
                                        <div class="btn-group">
                                        @if ($row->flag_lunas)
                                            <button type="button" class="btn btn-success btn-sm" onclick="window.location.assign('{{ url('kilatDetail/'.$row->id) }}')">Lunas</button>
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                            <li><a href="javascript:void(0)" onclick="window.location.assign('{{ url('kilatDetail/'.$row->id.'/edit') }}')">Batal</a>
                                            </ul>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.assign('{{ url('kilatDetail/'.$row->id) }}')">Bayar</button>
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="javascript:void(0)" onclick="window.location.assign('{{ url('kilat/'.$row->id.'/edit') }}')">Lunas</a>
                                                <a href="javascript:void(0)" onclick="hapus('{{ $row->id }}', '{{ $key+1 }}')">Hapus</a></li>
                                            </ul>
                                        @endif
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                                <tbody>
                                @foreach (App\Kilat::whereUserId(Auth::user()->id)->orderBy('id', 'desc')->limit(20)->get() as $key => $row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->tanggal !!}</td>
                                    <td><a href="#" data-toggle="tooltip" title="{!! $row->user->nama_depan !!} {!! $row->user->nama_belakang !!}">{!! $row->user->no_anggota !!}</a></td>
                                    <td>{!! number_format($row->pinjam) !!}</td>
                                    <td>{!! $row->cicilan !!} ({!! $row->kilatDetail->count() !!})</td>
                                    <td>{!! number_format($row->kilatDetail->sum('bayar')) !!}</td>
                                    <td {!! number_format(abs($row->pinjam-$row->kilatDetail->sum('bayar'))) > 0 ? "style='color:red'"  : '' !!}>{!! number_format(abs($row->pinjam-$row->kilatDetail->sum('bayar'))) !!}</td>
                                    <td>{!! number_format($row->kilatDetail()->sum('jasa')) !!}</td>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                                    <td>
                                        <div class="btn-group">
                                        @if ($row->flag_lunas)
                                            <button type="button" class="btn btn-success btn-sm" onclick="window.location.assign('{{ url('kilatDetail/'.$row->id) }}')">Lunas</button>
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                            <li><a href="javascript:void(0)" onclick="window.location.assign('{{ url('kilatDetail/'.$row->id.'/edit') }}')">Batal</a>
                                            </ul>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.assign('{{ url('kilatDetail/'.$row->id) }}')">Bayar</button>
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="javascript:void(0)" onclick="window.location.assign('{{ url('kilat/'.$row->id.'/edit') }}')">Lunas</a>
                                                <a href="javascript:void(0)" onclick="hapus('{{ $row->id }}', '{{ $key+1 }}')">Hapus</a></li>
                                            </ul>
                                        @endif
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            @endif 
                        </table>

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                            {!! $kilat->appends(['s' => Request::get('s')])->links() !!}
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
            url = '{{ url('kilat') }}/'+id;

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