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
									<td>Tanggal</td>
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
								@for ($i = 1; $i <= 31; $i++)
									<tr class="text-center">
										<td>{!! $tahun.'-'.$bulan.'-'.$i !!}</td>
										<td>{!! number_format(App\AngsuranDetail::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
										<td>{!! number_format(App\KilatDetail::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
										<td>{!! number_format(App\Kilat::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')); !!}</td>
										<td>{!! number_format(App\Kilat::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')); !!}</td>
									@foreach ($transaksi_pendapatan as $row)
										<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')) !!}</td>
										@if ($loop->last)
										<td style="font-weight: bold;">{!! number_format($row->whereYear('tanggal', $tahun)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')+App\AngsuranDetail::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')+App\KilatDetail::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')+App\Kilat::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')+App\Kilat::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')) !!}</td>
										@endif
									@endforeach
									</tr>
									@if ($i == 31)
									<tr style="font-weight: bold" class="text-center">
										<td>Total</td>
										<td>{!! number_format(App\AngsuranDetail::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
										<td>{!! number_format(App\KilatDetail::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
										<td>{!! number_format(App\Kilat::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')); !!}</td>
										<td>{!! number_format(App\Kilat::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')); !!}</td>
										@foreach ($transaksi_pendapatan as $row)
											<td>{!! number_format($row->whereAkunId($row->akun_id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')) !!}</td>
											@if ($loop->last)
											<td>{!! number_format($row->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')+App\AngsuranDetail::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')+App\KilatDetail::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jasa')+App\Kilat::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('provisi')+App\Kilat::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('administrasi')); !!}</td>
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
							<strong>Pengeluaran</strong>
						</p>
					</div>
					<div class="content table-responsive">
						<table class="table table-striped table-bordered">
								<tr style="font-weight: bold;" class="text-center">
									<td>Tanggal</td>
									@foreach ($pengeluaran->get() as $row)
										<td>{!! $row->akun->nama !!}</td>
									@if ($loop->last)
										<td>Jumlah</td>
									@endif
									@endforeach
								</tr>
								@for ($i = 1; $i <= 31; $i++)
									<tr class="text-center">
										<td>{!! $tahun.'-'.$bulan.'-'.$i !!}</td>
									@foreach ($transaksi_pengeluaran as $row)
										<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
										@if ($loop->last)
										<td style="font-weight: bold;">{!! number_format($row->whereYear('tanggal', $tahun)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
										@endif
									@endforeach
									</tr>
									@if ($i == 31)
									<tr style="font-weight: bold" class="text-center">
										<td>Total</td>
										@foreach ($transaksi_pengeluaran as $row)
											<td>{!! number_format($row->whereAkunId($row->akun_id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
											@if ($loop->last)
											<td>{!! number_format($row->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')); !!}</td>
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
