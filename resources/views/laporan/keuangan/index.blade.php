@extends('layouts.master', ['laporan'=>'active'])

@section('title', $title)

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4">
				<div class="card">
					<div class="header">
						<p class="title lead">
							<strong>Laba Rugi</strong> <a href="{{ url('laporan/keuangan/labarugi?tahun='.$tahun) }}" class="pull-right"><i class="ti-search">detail</a></i>
						</p>
					</div>
					<div class="content table-responsive">
						<label>Pendapatan</label>
						<table class="table table-striped table-bordered">
							<tbody>
								<tr>
									<td>Jasa Pinjaman Angsuran</td>
									<td class="text-right">{!! number_format($jasa_angsuran) !!}</td>
								</tr>
								<tr>
									<td>Jasa Pinjaman Kilat</td>
									<td class="text-right">{!! number_format($jasa_kilat) !!}</td>
								</tr>
								<tr>
									<td>Provisi Pinjaman</td>
									<td class="text-right">{!! number_format($provisi_pinjaman) !!}</td>
								</tr>
								<tr>
									<td>Administrasi</td>
									<td class="text-right">{!! number_format($administrasi) !!}</td>
								</tr>
								@foreach ($pendapatan as $key => $row)
								<tr>
									<td>{!! $row->akun->nama !!}</td>
									<td class="text-right">{!! number_format($row->masuk) !!}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr style="font-weight: bolder;">
									<td>Jumlah Pendapatan</td>
									<td class="text-right">{!! number_format($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk')) !!}</td>
								</tr>
							</tfoot>
						</table>
						<label>Pengeluaran</label>
						<table class="table table-striped table-bordered">
							<tbody>
								@foreach ($pengeluaran as $key => $row)
								<tr>
									<td>{!! $row->akun->nama !!}</td>
									<td class="text-right">{!! number_format($row->keluar) !!}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr style="font-weight: bolder;">
									<td>Jumlah Pengeluaran</td>
									<td class="text-right">{!! number_format($pengeluaran->sum('keluar')) !!}</td>
								</tr>
							</tfoot>
						</table>

						<table class="table table-striped table-bordered">
							<tfoot>
								<tr style="font-weight: bolder">
									<label>Laba Bersih</label>
									<td>Jumlah Laba Bersih SHU</td>
									<td class="text-right">{!! number_format($shu) !!}</td>
								</tr>
							</tfoot>
						</table>

						<br>
						<hr>
						<p class="title lead">
							<strong>Pembagian SHU</strong>
						</p>
						<div class="content table-responsive table-full-width">
							<table class="table table-bordered table-striped">
								<tr>
									<td>Jasa Pengurus ({!! $setting->jasa_pengurus !!}%)</td>
									<td class="text-right"">{!! number_format($jasa_pengurus) !!}</td>
								</tr>
								<tr>
									<td>Jasa Pengawas ({!! $setting->jasa_pengawas !!}%)</td>
									<td class="text-right"">{!! number_format($jasa_pengawas) !!}</td>
								</tr>
								<tr>
									<td>SHU Sosial ({!! $setting->shu_sosial !!}%)</td>
									<td class="text-right"">{!! number_format($shu_sosial) !!}</td>
								</tr>
								<tr>
									<td>SHU Cadangan ({!! $setting->shu_cadangan !!}%)</td>
									<td class="text-right"">{!! number_format($shu_cadangan) !!}</td>
								</tr>
								<tr>
									<td>Jasa Simpanan ({!! $setting->jasa_simpanan !!}%)</td>
									<td class="text-right"">{!! number_format($jasa_simpanan) !!}</td>
								</tr>
								<tr>
									<td>Jasa Pinjaman ({!! $setting->jasa_pinjaman !!}%)</td>
									<td class="text-right">{!! number_format($jasa_pinjaman) !!}</td>
								</tr>
								<tr>
									<td style="font-weight: bolder;">Jumlah</td>
									<td class="text-right" style="font-weight: bolder;">{!! number_format($pembagian_shu) !!}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-8">
				<div class="card">
					<div class="header">
						<p class="title lead">
							<strong>Neraca</strong>
						</p>
						<div class="content table-responsive table-full-width">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<td rowspan="2" class="text-center" >Aktiva</td>
										<td colspan="2" class="text-center">Tahun</td>
										<td rowspan="2" class="text-center">Pasiva</td>
										<td colspan="2" class="text-center">Tahun</td>
									</tr>
									<tr>
										<td class="text-center"><a href="{{ url('laporan/keuangan?tahun='.($tahun-1)) }}"> <i class="ti-angle-double-left"></i></a> {!! $tahun ? $tahun - 1 : '' !!}</td>
										<td class="text-center">{!! $tahun or '' !!}<a href="{{ url('laporan/keuangan?tahun='.($tahun+1)) }}"> <i class="ti-angle-double-right"></i></a></td>
										<td class="text-center"><a href="{{ url('laporan/keuangan?tahun='.($tahun-1)) }}"> <i class="ti-angle-double-left"></i></a> {!! $tahun ? $tahun - 1 : '' !!}</td>
										<td class="text-center">{!! $tahun or '' !!}<a href="{{ url('laporan/keuangan?tahun='.($tahun+1)) }}"> <i class="ti-angle-double-right"></i></a></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Kas</td>
										<td class="text-center">{!! number_format($kas_before) !!}</td>
										<td class="text-center">{!! number_format($kas) !!}</td>
										<td>Simpanan Pokok</td>
										<td class="text-center">{!! number_format($pokok_before) !!}</td>
										<td class="text-center">{!! number_format($pokok) !!}</td>
									</tr>
									<tr>
										<td>Bank</td>
										<td class="text-center">{!! number_format($bank_before) !!}</td>
										<td class="text-center">{!! number_format($bank) !!}</td>
										<td>Simpanan Wajib</td>
										<td class="text-center">{!! number_format($wajib_before) !!}</td>
										<td class="text-center">{!! number_format($wajib) !!}</td>
									</tr>
									<tr>
										<td>Piutang Angsuran</td>
										<td class="text-center">{!! number_format($piutang_angsuran_before) !!}</td>
										<td class="text-center">{!! number_format($piutang_angsuran) !!}</td>
										<td>Simpanan Manasuka</td>
										<td class="text-center">{!! number_format($manasuka_before) !!}</td>
										<td class="text-center">{!! number_format($manasuka) !!}</td>
									</tr>
									<tr>
										<td>Piutang Kilat</td>
										<td class="text-center">{!! number_format($piutang_kilat_before) !!}</td>
										<td class="text-center">{!! number_format($piutang_kilat) !!}</td>
										<td>Sosial</td>
										<td class="text-center">{!! number_format($sosial_before) !!}</td>
										<td class="text-center">{!! number_format($sosial) !!}</td>
									</tr>
									<tr>
										<td>Inventaris</td>
										<td class="text-center">{!! number_format($inventaris_before) !!}</td>
										<td class="text-center">{!! number_format($inventaris) !!}</td>
										<td>Cadangan</td>
										<td class="text-center">{!! number_format($cadangan_before) !!}</td>
										<td class="text-center">{!! number_format($cadangan) !!}</td>
									</tr>
								</tbody>
								<tfoot>
									<tr style="font-weight: bold;">
										<td>Jumlah Aktiva</td>
										<td class="text-center">{!! number_format($kas_before+$bank_before+$piutang_angsuran_before+$piutang_kilat_before+$inventaris_before) !!}</td>
										<td class="text-center">{!! number_format($kas+$bank+$piutang_angsuran+$piutang_kilat+$inventaris) !!}</td>
										<td>Jumlah Pasiva</td>
										<td class="text-center">{!! number_format($pokok_before+$wajib_before+$manasuka_before+$sosial_before+$cadangan_before) !!}</td>
										<td class="text-center">{!! number_format($pokok+$wajib+$manasuka+$sosial+$cadangan) !!}</td>
									</tr>
									<tr >
										<td colspan="6"></td>
									</tr>
									<tr style="font-weight: bold;">
										<td>SHU</td>
										<td class="text-center">{!! number_format($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar')) !!}</td>
										<td class="text-center">{!! number_format($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar')) !!}</td>
										<td>SHU</td>
										<td class="text-center">{!! number_format($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar')) !!}</td>
										<td class="text-center">{!! number_format($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar')) !!}</td>
									</tr>
									<tr style="font-weight: bold;">
										<td>TOTAL</td>
										<td class="text-center">{!! number_format(($kas_before+$bank_before+$piutang_angsuran_before+$piutang_kilat_before+$inventaris_before) + ($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar'))) !!}</td>
										<td class="text-center">{!! number_format(($kas+$bank+$piutang_angsuran+$piutang_kilat+$inventaris) + ($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar'))) !!}</td>
										<td>TOTAL</td>
										<td class="text-center">{!! number_format(($pokok_before+$wajib_before+$manasuka_before+$sosial_before+$cadangan_before) + ($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar'))) !!}</td></td>
										<td class="text-center">{!! number_format(($pokok+$wajib+$manasuka+$sosial+$cadangan) + ($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar'))) !!}</td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>	

		</div>
	</div>
</div>
@endsection