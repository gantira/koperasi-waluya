<table>
	<td style="font-size: 20px">{!! $title !!}</td>
</table>	
<h3>Laba Rugi</h3>
<table>
	<tr>
		<td style="color: #00db24">Pendapatan</td>
	</tr>
	<tbody>
		<tr>
			<td>Jasa Pinjaman Angsuran</td>
			<td>{!! number_format($jasa_angsuran) !!}</td>
		</tr>
		<tr>
			<td>Jasa Pinjaman Kilat</td>
			<td>{!! number_format($jasa_kilat) !!}</td>
		</tr>
		<tr>
			<td>Provisi Pinjaman</td>
			<td>{!! number_format($provisi_pinjaman) !!}</td>
		</tr>
		<tr>
			<td>Administrasi</td>
			<td>{!! number_format($administrasi) !!}</td>
		</tr>
		@foreach ($pendapatan as $key => $row)
		<tr>
			<td>{!! $row->akun->nama !!}</td>
			<td>{!! number_format($row->masuk) !!}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td style="font-weight: bold;">Jumlah Pendapatan</td>
			<td style="font-weight: bold;">{!! number_format($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk')) !!}</td>
		</tr>
	</tfoot>
</table>

<table>
	<tr>
		<td style="color: #00db24">Pengeluaran</td>
	</tr>
	<tbody>
		@foreach ($pengeluaran as $key => $row)
		<tr>
			<td>{!! $row->akun->nama !!}</td>
			<td>{!! number_format($row->keluar) !!}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td style="font-weight: bold;">Jumlah Pengeluaran</td>
			<td style="font-weight: bold;">{!! number_format($pengeluaran->sum('keluar')) !!}</td>
		</tr>
	</tfoot>
</table>

<table>
	<tr>
		<td style="color: #00db24">Laba Bersih</td>
	</tr>
	<tfoot>
		<tr>
			<td style="font-weight: bold;">Jumlah Laba Bersih SHU</td>
			<td style="font-weight: bold;">{!! number_format($shu) !!}</td>
		</tr>
	</tfoot>
</table>

<h3>Pembagian SHU</h3>
<table class="table table-bordered table-striped">
	<tr>
		<td>Jasa Pengurus ({!! $setting->jasa_pengurus !!}%)</td>
		<td">{!! number_format($jasa_pengurus) !!}</td>
	</tr>
	<tr>
		<td>Jasa Pengawas ({!! $setting->jasa_pengawas !!}%)</td>
		<td">{!! number_format($jasa_pengawas) !!}</td>
	</tr>
	<tr>
		<td>SHU Sosial ({!! $setting->shu_sosial !!}%)</td>
		<td">{!! number_format($shu_sosial) !!}</td>
	</tr>
	<tr>
		<td>SHU Cadangan ({!! $setting->shu_cadangan !!}%)</td>
		<td">{!! number_format($shu_cadangan) !!}</td>
	</tr>
	<tr>
		<td>Jasa Simpanan ({!! $setting->jasa_simpanan !!}%)</td>
		<td">{!! number_format($jasa_simpanan) !!}</td>
	</tr>
	<tr>
		<td>Jasa Pinjaman ({!! $setting->jasa_pinjaman !!}%)</td>
		<td>{!! number_format($jasa_pinjaman) !!}</td>
	</tr>
	<tr>
		<td style="font-weight: bold;">Jumlah</td>
		<td style="font-weight: bold;">{!! number_format($pembagian_shu) !!}</td>
	</tr>
</table>

<h3>Neraca</h3>
<table>
	<thead>
		<tr>
			<td rowspan="2" align="center" valign="center" style="font-weight: bold; vertical-align: middle;">Aktiva</td>
			<td colspan="2" align="center" style="font-weight: bold;">Tahun</td>
			<td rowspan="2" align="center" valign="center" style="font-weight: bold; vertical-align: middle;">Pasiva</td>
			<td colspan="2" align="center" style="font-weight: bold;">Tahun</td>
		</tr>
		<tr>
			<td align="center" style="font-weight: bold;"></td>
			<td align="center" style="font-weight: bold;">{!! $tahun ? $tahun - 1 : '' !!}</td>
			<td align="center" style="font-weight: bold;">{!! $tahun or '' !!}</td>
			<td align="center" style="font-weight: bold;"></td>
			<td align="center" style="font-weight: bold;">{!! $tahun ? $tahun - 1 : '' !!}</td>
			<td align="center" style="font-weight: bold;">{!! $tahun or '' !!}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Kas</td>
			<td>{!! number_format($kas_before) !!}</td>
			<td>{!! number_format($kas) !!}</td>
			<td>Simpanan Pokok</td>
			<td>{!! number_format($pokok_before) !!}</td>
			<td>{!! number_format($pokok) !!}</td>
		</tr>
		<tr>
			<td>Bank</td>
			<td>{!! number_format($bank_before) !!}</td>
			<td>{!! number_format($bank) !!}</td>
			<td>Simpanan Wajib</td>
			<td>{!! number_format($wajib_before) !!}</td>
			<td>{!! number_format($wajib) !!}</td>
		</tr>
		<tr>
			<td>Piutang Angsuran</td>
			<td>{!! number_format($piutang_angsuran_before) !!}</td>
			<td>{!! number_format($piutang_angsuran) !!}</td>
			<td>Simpanan Manasuka</td>
			<td>{!! number_format($manasuka_before) !!}</td>
			<td>{!! number_format($manasuka) !!}</td>
		</tr>
		<tr>
			<td>Piutang Kilat</td>
			<td>{!! number_format($piutang_kilat_before) !!}</td>
			<td>{!! number_format($piutang_kilat) !!}</td>
			<td>Sosial</td>
			<td>{!! number_format($sosial_before) !!}</td>
			<td>{!! number_format($sosial) !!}</td>
		</tr>
		<tr>
			<td>Inventaris</td>
			<td>{!! number_format($inventaris_before) !!}</td>
			<td>{!! number_format($inventaris) !!}</td>
			<td>Cadangan</td>
			<td>{!! number_format($cadangan_before) !!}</td>
			<td>{!! number_format($cadangan) !!}</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td style="font-weight: bold;">Jumlah Aktiva</td>
			<td style="font-weight: bold;">{!! number_format($kas_before+$bank_before+$piutang_angsuran_before+$piutang_kilat_before+$inventaris_before) !!}</td>
			<td style="font-weight: bold;">{!! number_format($kas+$bank+$piutang_angsuran+$piutang_kilat+$inventaris) !!}</td>
			<td style="font-weight: bold;">Jumlah Pasiva</td>
			<td style="font-weight: bold;">{!! number_format($pokok_before+$wajib_before+$manasuka_before+$sosial_before+$cadangan_before) !!}</td>
			<td style="font-weight: bold;">{!! number_format($pokok+$wajib+$manasuka+$sosial+$cadangan) !!}</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">SHU</td>
			<td style="font-weight: bold;">{!! number_format($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar')) !!}</td>
			<td style="font-weight: bold;">{!! number_format($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar')) !!}</td>
			<td style="font-weight: bold;">SHU</td>
			<td style="font-weight: bold;">{!! number_format($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar')) !!}</td>
			<td style="font-weight: bold;">{!! number_format($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar')) !!}</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">TOTAL</td>
			<td style="font-weight: bold;">{!! number_format(($kas_before+$bank_before+$piutang_angsuran_before+$piutang_kilat_before+$inventaris_before) + ($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar'))) !!}</td>
			<td style="font-weight: bold;">{!! number_format(($kas+$bank+$piutang_angsuran+$piutang_kilat+$inventaris) + ($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar'))) !!}</td>
			<td style="font-weight: bold;">TOTAL</td>
			<td style="font-weight: bold;">{!! number_format(($pokok_before+$wajib_before+$manasuka_before+$sosial_before+$cadangan_before) + ($jasa_angsuran_before+$jasa_kilat_before+$provisi_pinjaman_before+$administrasi_before+$pendapatan_before->sum('masuk') - $pengeluaran_before->sum('keluar'))) !!}</td></td>
			<td style="font-weight: bold;">{!! number_format(($pokok+$wajib+$manasuka+$sosial+$cadangan) + ($jasa_angsuran+$jasa_kilat+$provisi_pinjaman+$administrasi+$pendapatan->sum('masuk') - $pengeluaran->sum('keluar'))) !!}</td></td>
		</tr>
	</tfoot>
</table>