@foreach ($kategori as $row)
						<h4>{!! $row->nama !!}</h4>
						@foreach (App\Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) use ($row) { $query->whereNotIn('kode', [1])->whereKeterangan('keluar')->whereHas('kategori', function ($query) use ($row) { $query->whereId($row->id); }); })->groupBy('akun_id')->selectRaw('*, sum(keluar) as keluar')->get() as $val)
							<table class="table table-hover">
								<tr>
									<td width="80%">{!! $val->akun->nama !!}</td>
									<td>{!! number_format($val->keluar) !!}</td>
									<td></td>
								</tr>
							@if ($loop->last)
								<tr style="font-weight: bold;">
									<td>Jumlah</td>
									<td></td>
									<td>{!! number_format(App\Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) use ($row) { $query->whereNotIn('kode', [1])->whereKeterangan('keluar')->whereHas('kategori', function ($query) use ($row) { $query->whereNotIn('id', [16,18,22,24,25])->whereId($row->id); }); })->sum('keluar')) !!}</td>
								</tr>
							@endif
							</table>
						@endforeach
						@if ($loop->last)
						<table class="table table-hover">
							<tr style="font-weight: bold;font-size: larger;">
								<td width="80%">Total Pengeluaran</td>
								<td width="5%">{!! number_format(App\Transaksi::whereYear('tanggal', $tahun)->whereHas('akun', function ($query) { $query->whereNotIn('kode', [1])->whereKeterangan('keluar')->whereHas('kategori', function ($query) { $query->whereNotIn('id', [16,18,22,24,25])->whereKeterangan('keluar'); }); })->sum('keluar')) !!}</td>
							</tr>
						</table>
						@endif
					@endforeach