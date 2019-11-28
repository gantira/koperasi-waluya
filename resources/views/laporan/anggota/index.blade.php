@extends('layouts.master', ['laporan'=>'active'])

@section('title', $title)

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
                        <h4 class="title"></h4>
                        <div class="clearfix">
                            {!! Form::open(['url'=>'laporan/anggota', 'method'=>'get']) !!}
                            <div class="form-inline pull-right">
                            	<div class="form-group">
	                            	{!! Form::select('tahun', $pluck_tahun, null, ['class'=>'form-control border-input', 'onchange'=>'submit()']) !!}
                                    {!! Form::text('search', null, ['class'=>'form-control border-input', 'placeholder'=>'Kata Kunci']) !!}
                                    
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

					<div class="content table-responsive">
						<table class="table table-striped">
							<thead>
								<tr style="font-weight: bolder;">
									<td colspan="2" class="text-center">No</td>
									<td rowspan="2" class="text-center">Nama</td>
									<td colspan="3" class="text-center">Simpanan</td>
									<td rowspan="2" class="text-center">Jumlah</td>
									<td colspan="2" class="text-center">Piutang</td>
									<td rowspan="2" class="text-center">Jumlah</td>
									<td colspan="2" class="text-center">SHU</td>
								</tr>
								<tr style="font-weight: bolder;" class="text-center">
									<td>Urut</td>
									<td>Anggota</td>
									<td>Wajib</td>
									<td>Pokok</td>
									<td>Manasuka</td>
									<td>Angsuran</td>
									<td>Kilat </td>
									<td>Simpanan </td>
									<td>Pinjaman </td>
								</tr>
							</thead>
							<tbody>
								@foreach ($user as $key => $row)
								<tr class="text-center">
									<td>{!! $key+1 !!}</td>
									<td>{!! $row->no_anggota !!}</td>
									<td>{!! $row->nama_depan !!} {!! $row->nama_belakang !!}</td>
									<td>{!! number_format($row->wajib()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo')) !!}</td>

									<td>{!! number_format($row->pokok()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo')) !!}</td>

									<td>{!! number_format($row->manasuka()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo')) !!}</td>

									<td>{!! number_format($row->wajib()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo') + $row->pokok()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo') + $row->manasuka()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo')) !!}</td>

									<td>{!! number_format($row->angsuran()->whereFlagLunas(false)->value('pinjam') - $row->angsuranDetail()->whereRaw('angsurans.flag_lunas = 0')->sum('bayar')) !!}</td>

									<td>{!! number_format($row->kilat()->whereFlagLunas(false)->value('pinjam') - $row->kilatDetail()->whereRaw('kilats.flag_lunas = 0')->sum('bayar')) !!}</td>

									<td>{!! number_format(($row->angsuran()->whereFlagLunas(false)->value('pinjam') - $row->angsuranDetail()->whereRaw('angsurans.flag_lunas = 0')->sum('bayar')) + ($row->kilat()->whereFlagLunas(false)->value('pinjam') - $row->kilatDetail()->whereRaw('kilats.flag_lunas = 0')->sum('bayar'))) !!}</td>

									<td>{!! number_format(($row->wajib()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo') + $row->pokok()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo')) * ($shu_simpanan/$wajibpokok)) !!}</td>
									<td>{!! number_format(($row->angsuranDetail()->sum('angsuran_details.jasa') + $row->kilatDetail()->sum('kilat_details.jasa')) / $jasaanggota * $shu_pinjaman ) !!} </td>
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

@endsection