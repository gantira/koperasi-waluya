<h3>{!! $title !!}</h3>

<table>
	<tr>
		<td>Pendapatan</td>
	</tr>
	<tr>
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
	<tr>
		<td>{!! $i !!}</td>
		<td>{!! Carbon\Carbon::now()->month($i)->format('F') !!}</td>
		<td>{!! number_format(App\AngsuranDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
		<td>{!! number_format(App\KilatDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
		<td>{!! number_format(App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')); !!}</td>
		<td>{!! number_format(App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')); !!}</td>
		@foreach ($transaksi_pendapatan as $row)
		<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')) !!}</td>
		@if ($loop->last)
		<td style="font-weight: bold;">{!! number_format($row->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')+App\AngsuranDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')+App\KilatDetail::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('jasa')+App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('provisi')+App\Kilat::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereMonth('tanggal', $i)->whereYear('tanggal', $tahun)->sum('administrasi')) !!}</td>
		@endif
		@endforeach
	</tr>
	@if ($i == 12)
	<tr style="font-weight: bold">
		<td>Total</td>
		<td></td>
		<td>{!! number_format(App\AngsuranDetail::whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
		<td>{!! number_format(App\KilatDetail::whereYear('tanggal', $tahun)->sum('jasa')); !!}</td>
		<td>{!! number_format(App\Kilat::whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('provisi')); !!}</td>
		<td>{!! number_format(App\Kilat::whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('administrasi')); !!}</td>
		@foreach ($transaksi_pendapatan as $row)
		<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')) !!}</td>
		@if ($loop->last)
		<td>{!! number_format($row->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('masuk')->whereNotIn('kode', [1, 2, 3]); })->sum('masuk')+App\AngsuranDetail::whereYear('tanggal', $tahun)->sum('jasa')+App\KilatDetail::whereYear('tanggal', $tahun)->sum('jasa')+App\Kilat::whereYear('tanggal', $tahun)->sum('provisi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('provisi')+App\Kilat::whereYear('tanggal', $tahun)->sum('administrasi')+App\Angsuran::whereYear('tanggal', $tahun)->sum('administrasi')); !!}</td>
		@endif
		@endforeach
	</tr>
	@endif
	@endfor
</table>

<table>
	<tr>
		<td>Pengeluaran</td>
	</tr>
	<tr>
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
	<tr>
		<td>{!! $i !!}</td>
		<td>{!! Carbon\Carbon::now()->month($i)->format('F') !!}</td>
		@foreach ($transaksi_pengeluaran as $row)
		<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
		@if ($loop->last)
		<td style="font-weight: bold;">{!! number_format($row->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
		@endif
		@endforeach
	</tr>
	@if ($i == 12)
	<tr style="font-weight: bold">
		<td colspan="2">Total</td>
		@foreach ($transaksi_pengeluaran as $row)
		<td>{!! number_format($row->whereAkunId($row->akun_id)->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')) !!}</td>
		@if ($loop->last)
		<td>{!! number_format($row->whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereKeterangan('keluar')->whereNotIn('kode', [1, 2, 3, 20, 24]); })->sum('keluar')); !!}</td>
		@endif
		@endforeach
	</tr>
	@endif
	@endfor
</table>