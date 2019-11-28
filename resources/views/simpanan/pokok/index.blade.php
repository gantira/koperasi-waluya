@extends('layouts.master', ['simpanan'=>'active'])

@section('title', 'Simpanan Pokok')

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
                                <p class="category "><a href="{{ url('pokok/create') }}"><i class="ti-layers"></i> Tambah</a></p>
                            </div>
                            <div class="form-inline pull-right">
                                {{-- {!! Form::open(['url'=>'pokok', 'method'=>'get']) !!}
                                <div class="input-group border-input">
                                    {!! Form::text('awal', null, ['class'=>'form-control border-input', 'id'=>'awal']) !!}
                                    <span class="input-group-addon"><i class="ti-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <label>to</label>
                                </div>
                                <div class="input-group border-input">
                                    {!! Form::text('akhir', null, ['class'=>'form-control border-input', 'id'=>'akhir']) !!}
                                    <span class="input-group-addon"><i class="ti-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    {!! Form::submit('Cari', ['class'=>'btn btn-info', 'onclick'=>'cari()']) !!}
                                </div>
                                {!! Form::close() !!} --}}


                                {!! Form::open(['url'=>'pokok', 'method'=>'get']) !!}
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
                                    <th>Tanggal</th>
                                    <th>Nomor</th>
                                    <th>Nama</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                                    <th width="5%"></th>
                                    @else
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                                @foreach ($pokok as $key => $row)
                                <tr id="tr{{$row->id}}">
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->tanggal !!}</td>
                                    <td>{!! $row->user->no_anggota !!}</td>
                                    <td>{!! $row->user->nama_depan !!} {!! $row->user->nama_belakang !!}</td>
                                    <td>{!! $row->masuk !!}</td>
                                    <td>{!! $row->keluar !!}</td>
                                    <td><a href="#"><i class="ti-trash" title="Hapus" onclick="hapus('{{ $row->id }}', '{{ $key+1 }}')"></i></a></td>
                                </tr>
                                @if ($loop->last)
                                <tfoot>
                                    <tr style="font-weight: bolder;">
                                        <td colspan="4" class="text-center">TOTAL</td>
                                        <td>{!! number_format($sumMasuk) !!}</td>
                                        <td>{!! number_format($sumKeluar) !!}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                @endif
                                @endforeach
                            @elseif (Auth::user()->role == 'anggota')
                                @foreach (App\Pokok::whereUserId(Auth::user()->id)->orderBy('id', 'desc')->limit(20)->get() as $key => $row)
                                <tr id="tr{{$row->id}}">
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->tanggal !!}</td>
                                    <td>{!! $row->user->no_anggota !!}</td>
                                    <td>{!! $row->user->nama_depan !!} {!! $row->user->nama_belakang !!}</td>
                                    <td>{!! $row->masuk !!}</td>
                                    <td>{!! $row->keluar !!}</td>
                                </tr>
                                @if ($loop->last)
                                <tfoot>
                                    <tr style="font-weight: bolder;">
                                        <td colspan="4" class="text-center">TOTAL</td>
                                        <td>{!! number_format(App\Pokok::whereUserId(Auth::user()->id)->sum('masuk')) !!}</td>
                                        <td>{!! number_format(App\Pokok::whereUserId(Auth::user()->id)->sum('keluar')) !!}</td>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                                        <td></td>
                                        @else
                                        @endif
                                        
                                    </tr>
                                </tfoot>
                                @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                            
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pengurus')
                            {!! $pokok->appends(['s' => Request::get('s')])->links() !!}
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
    $('#awal').dateRangePicker(
        {
            language : 'id',
            separator : ' to ',
            getValue: function()
            {
                if ($('#awal').val() && $('#akhir').val() )
                    return $('#awal').val() + ' to ' + $('#akhir').val();
                else
                    return '';
            },
            setValue: function(s,s1,s2)
            {
                $('#awal').val(s1);
                $('#akhir').val(s2);
            }
        }
    );
    $('#akhir').dateRangePicker(
        {
            language : 'id',
            separator : ' to ',
            getValue: function()
            {
                if ($('#awal').val() && $('#akhir').val() )
                    return $('#awal').val() + ' to ' + $('#akhir').val();
                else
                    return '';
            },
            setValue: function(s,s1,s2)
            {
                $('#awal').val(s1);
                $('#akhir').val(s2);
            }
        }
    );

    function hapus(id, nama) {
        var r = confirm('Menghapus ID '+nama+'. Anda Yakin?');
        
        if (r == true) {
            var dataString = { 
                _token : '{{ csrf_token() }}'
            };
            url = '{{ url('pokok') }}/'+id;

            $.ajax({
                url: url,
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

</script>
@endpush