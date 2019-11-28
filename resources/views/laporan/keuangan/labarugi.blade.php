@extends('layouts.master', ['laporan'=>'active'])

@section('title', $title )

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
						<p class="title lead">
							<strong>Pendapatan</strong>
						</p>
					</div>
					<div class="content table-responsive">
						<table class="table table-striped table-bordered">
								<tr style="font-weight: bold;" class="text-center">
									<td>No</td>
									<td>Bulan</td>
									<td>Jasa Pinjaman Angsuran</td>
									<td>Jasa Pinjaman Kilat</td>
									<td>Provisi Pinjaman</td>
									<td>Administrasi</td>
									@foreach ($pendapatan->get() as $row)
										<td>{!! $row->akun->nama !!}</td>
									@if ($loop->last)
										<td>Jumlah</td>
									@endif
									@endforeach
								</tr>
								@for ($i = 1; $i <= 12; $i++)
									<tr class="text-center">
										<td>{!! $i !!}</td>
										<td><a href="{!! url()->full().'&bulan='.Carbon\Carbon::now()->startOfMonth()->month($i)->format('m') !!}">{!! Carbon\Carbon::now()->startOfMonth()->subMonth()->month($i)->format('F') !!}</a></td>
										<td>{!! number_format(App\AngsuranDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')) !!}</td>
										<td>{!! number_format(App\KilatDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')) !!}</td>
										<td>{!! number_format(App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')) !!}</td>
										<td>{!! number_format(App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')) !!}</td>
									@foreach ($transaksi_pendapatan as $row)
										<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')) !!}</td>
										@if ($loop->last)
										<td style="font-weight: bold;">{!! number_format($row->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')+App\AngsuranDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')+App\KilatDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')+App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')+App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')) !!}</td>
										@endif
									@endforeach
									</tr>
									@if ($i == 12)
									<tr style="font-weight: bold" class="text-center">
										<td colspan="2">Total</td>
										<td>{!! number_format(App\AngsuranDetail::whereYear('tanggal', $tahun)->sum('jasa')) !!}</td>
										<td>{!! number_format(App\KilatDetail::whereYear('tanggal', $tahun)->sum('jasa')) !!}</td>
										<td>{!! number_format(App\Kilat::whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('provisi')) !!}</td>
										<td>{!! number_format(App\Kilat::whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('administrasi')) !!}</td>
										@foreach ($transaksi_pendapatan as $row)
											<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')) !!}</td>
											@if ($loop->last)
											<td>{!! number_format($row->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')+App\AngsuranDetail::whereYear('tanggal', $tahun)->sum('jasa')+App\KilatDetail::whereYear('tanggal', $tahun)->sum('jasa')+App\Kilat::whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('provisi')+App\Kilat::whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('administrasi')) !!}</td>
											@endif
										@endforeach
									</tr>
									@endif
								@endfor
						</table>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
						<p class="title lead">
							<strong>Pengeluaran <a href="{{ url('laporan/keuangan/pengeluaran?tahun='.$tahun) }}"><i class="ti-search">detail</i></a></strong>
						</p>
					</div>
					<div class="content table-responsive">
						<table class="table table-striped table-bordered">
								<tr style="font-weight: bold;" class="text-center">
									<td>No</td>
									<td>Bulan</td>
									@foreach ($pengeluaran->get() as $row)
										<td>{!! $row->akun->nama !!}</td>
									@if ($loop->last)
										<td>Jumlah</td>
									@endif
									@endforeach
								</tr>
								@for ($i = 1; $i <= 12; $i++)
									<tr class="text-center">
										<td>{!! $i !!}</td>
										<td><a href="{!! url()->full().'&bulan='.Carbon\Carbon::now()->startOfMonth()->month($i)->format('m') !!}">{!! Carbon\Carbon::now()->startOfMonth()->month($i)->format('F') !!}</a></td>
									@foreach ($transaksi_pengeluaran as $row)
										<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
										@if ($loop->last)
										<td style="font-weight: bold;">{!! number_format($row->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
										@endif
									@endforeach
									</tr>
									@if ($i == 12)
									<tr style="font-weight: bold" class="text-center">
										<td colspan="2">Total</td>
										@foreach ($transaksi_pengeluaran as $row)
											<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
											@if ($loop->last)
											<td>{!! number_format($row->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
											@endif
										@endforeach
									</tr>
									@endif
								@endfor
						</table>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
@endsection
