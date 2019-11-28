<table border="1">
	<tr>
		<td colspan="12" style="font-size: 20px" align="center">{!! $title !!}</td>
	</tr>
	<thead>
		<tr>
			<td colspan="2" align="center">No</td>
			<td rowspan="2" align="center">Nama</td>
			<td colspan="3" align="center">Simpanan</td>
			<td rowspan="2" align="center">Jumlah</td>
			<td colspan="2" align="center">Piutang</td>
			<td rowspan="2" align="center">Jumlah</td>
			<td colspan="2" align="center">SHU</td>
		</tr>
		<tr>
			<td align="center">Urut</td>
			<td align="center">Anggota</td>
			<td align="center"></td>
			<td align="center">Wajib</td>
			<td align="center">Pokok</td>
			<td align="center">Manasuka</td>
			<td align="center"></td>
			<td align="center">Angsuran</td>
			<td align="center">Kilat</td>
			<td align="center"></td>
			<td align="center">Simpanan</td>
			<td align="center">Pinjaman</td>
		</tr>
	</thead>
	<tbody>
		@foreach ($user as $key => $row)
		<tr class="text-center">
			<td>{!! $key+1 !!}</td>
			<td>{!! $row->no_anggota !!}</td>
			<td>{!! $row->nama_depan !!} {!! $row->nama_belakang !!}</td>
			<td>{!! number_format($row->wajib()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo')) !!}</td>
			<td>{!! number_format($row->pokok()->whereYear('tanggal', '<=', $tahun)->sum('masuk') - $row->pokok()->whereYear('tanggal', '<=', $tahun)->sum('keluar')) !!}</td>
			<td>{!! number_format($row->manasuka()->whereYear('tanggal', '<=', $tahun)->sum('masuk') - $row->manasuka()->whereYear('tanggal', '<=', $tahun)->sum('keluar')) !!}</td>
			<td>{!! number_format($row->wajib()->whereYear('tanggal', '<=', $tahun)->sum('masuk')+$row->pokok()->whereYear('tanggal', '<=', $tahun)->sum('masuk')+$row->manasuka()->whereYear('tanggal', '<=', $tahun)->sum('masuk')-$row->wajib()->whereYear('tanggal', '<=', $tahun)->sum('keluar')+$row->pokok()->whereYear('tanggal', '<=', $tahun)->sum('keluar')+$row->manasuka()->whereYear('tanggal', '<=', $tahun)->sum('keluar')) !!}</td>

			<td>{!! number_format($row->angsuran()->whereFlagLunas(false)->value('pinjam') - $row->angsuranDetail()->whereRaw('angsurans.flag_lunas = 0')->sum('bayar')) !!}</td>

			<td>{!! number_format($row->kilat()->whereFlagLunas(false)->value('pinjam') - $row->kilatDetail()->whereRaw('kilats.flag_lunas = 0')->sum('bayar')) !!}</td>

			<td>{!! number_format(($row->angsuran()->whereFlagLunas(false)->value('pinjam') - $row->angsuranDetail()->whereRaw('angsurans.flag_lunas = 0')->sum('bayar')) + ($row->kilat()->whereFlagLunas(false)->value('pinjam') - $row->kilatDetail()->whereRaw('kilats.flag_lunas = 0')->sum('bayar'))) !!}</td>

			<td>{!! number_format(($row->wajib()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo') + $row->pokok()->whereYear('tanggal', '<=', $tahun)->selectRaw('sum(masuk)-sum(keluar) as saldo')->value('saldo')) * ($shu_simpanan/$wajibpokok)) !!}</td>
			<td>{!! number_format(($row->angsuranDetail()->sum('angsuran_details.jasa') + $row->kilatDetail()->sum('kilat_details.jasa')) / $jasaanggota * $shu_pinjaman ) !!} </td>
		</tr>
		
		@endforeach
	</tbody>
</table>