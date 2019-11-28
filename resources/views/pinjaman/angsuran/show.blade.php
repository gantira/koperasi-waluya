@extends('layouts.master', ['pinjaman'=>'active'])

@section('title', 'Bayar Pinjaman Angsuran')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Bayar</th>
                                    <th>Jasa</th>
                                    <th>Subtotal</th>
                                    <th width="1%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($angsuranDetail as $key => $row)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $row->tanggal !!}</td>
                                    <td>{!! number_format($row->bayar) !!}</td>
                                    <td>{!! number_format($row->jasa) !!}</td>
                                    <td>{!! number_format($row->subtotal) !!}</td>
                                    <td>
                                    @if ($loop->last)
                                    @if (!$angsuran->flag_lunas)
                                    <a href="#"><i class="ti-trash" title="Hapus" onclick="hapus('{{ $row->id }}', '{{ $key+1 }}')"></i></a>
                                    @endif
                                    @endif
                                    </td>
                                </tr>
                            @if ($loop->last)
                            <tfoot>
                                <tr style="font-weight: bold">
                                    <td colspan="2" class="text-center">TOTAL</td>
                                    <td>{!! number_format($total_bayar) !!}</td>
                                    <td>{!! number_format($total_jasa) !!}</td>
                                    <td>{!! number_format($subtotal) !!}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="content">
                        <p><b>Info Pinjaman</b></p>
                        <p>
                            Nomor : {!! $angsuran->user->no_anggota !!} <br>
                            Nama : {!! $angsuran->user->nama_depan !!} {!! $angsuran->user->nama_belakang !!} <br>
                            Besar Pinjaman : {!! number_format($angsuran->pinjam) !!}<br>
                            Cicilan : {!! $angsuran->cicilan !!}x<br>
                        </p>
                    </div>
                </div>
                {!! Form::open(['url'=>'angsuranDetail', 'method'=>'post']) !!}
                <div class="card">
                    <div class="content">
                        @if ($angsuran->flag_lunas)
                        <img src="{{ asset('checkmark.png') }}" class="img-responsive" width="50px">
                        @else
                        <div class="form-group">
                            <b>Tanggal</b>
                            <div class="input-group border-input">
                                {!! Form::text('tanggal', Carbon\Carbon::now()->format('Y-m-d'), ['class'=>'form-control border-input', 'id'=>'datepicker', 'data-language'=>'id']) !!}
                                <span class="input-group-addon"><i class="ti-calendar"></i></span>
                            </div>
                            <span class="help-block {{ $errors->has('tanggal') ? 'has-error' : '' }}">
                                <small>{{ $errors->first('tanggal') }}</small>
                            </span>
                        </div>
                        <div class="form-group">
                            <b>Cicilan ke-{!! $angsuranDetail->count()+1 !!}</b>
                            {!! Form::text('bayar', number_format($bayar,2,".",""), ['class'=>'form-control border-input text-right', 'id'=>'bayar', 'onkeyup'=>'manual()']) !!}
                            <span class="help-block {{ $errors->has('bayar') ? 'has-error' : '' }}">
                                <small>{{ $errors->first('bayar') }}</small>
                            </span>
                        </div>
                        <div class="form-group">
                            <b>Jasa ({!! $angsuran->jasa !!}%)</b>
                            {!! Form::text('jasa', number_format($jasa,2,".",""), ['class'=>'form-control border-input text-right', 'id'=>'jasa', 'onkeyup'=>'manual()']) !!}
                            <span class="help-block {{ $errors->has('jasa') ? 'has-error' : '' }}">
                                <small>{{ $errors->first('jasa') }}</small>
                            </span>

                            <p align="center"> 
                                <b>TOTAL</b><br>
                                <b id="total">Rp. {!! number_format($bayar+$jasa,2) !!}</b>
                            </p>
                        </div>
                            {!! Form::hidden('angsuran_id', $angsuran->id, []) !!}
                            {!! Form::hidden('subtotal', $bayar+$jasa, ['id'=>'subtotal']) !!}
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger" onClick="this.disabled=true;this.form.submit();">Bayar</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            @if ($angsuran->angsuranDetail->count() >= $angsuran->cicilan)
                            <button type="reset" class="btn btn-success" onclick="window.location.assign('{{ url('angsuran/'.$angsuran->id.'/edit') }}')">Lunas</button>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        function manual() {
            var cicilan = $('#bayar').val();
            var jasa = $('#jasa').val();
            var hasil = parseInt(cicilan)+parseInt(jasa);

            document.getElementById("subtotal").value = hasil;
            document.getElementById("total").innerHTML = 'Rp. ' + parseFloat(hasil).toLocaleString('id', 'Rp');
        }

        function hapus(id, nama) {
            var r = confirm('Menghapus ID '+nama+'. Anda Yakin?');
            
            if (r == true) {
                var dataString = { 
                    _token : '{{ csrf_token() }}'
                };
                url = '{{ url('angsuranDetail') }}/'+id;

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