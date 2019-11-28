<td colspan="15"><h2>{!! $title !!}</h2></td>

<table class="table table-striped table-bordered">
							<thead>	
								<tr>
									<th rowspan="2">No Urut</th>
									<th rowspan="2">No Perahu</th>
									<th rowspan="2">No Anggota</th>
									<th rowspan="2">Nama Perahu</th>
									<td colspan="31" align="center">Tanggal</td>
									<th rowspan="2">Jumlah</th>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									@for ($i = 1; $i <= 31; $i++)
										<td>{!! $i !!}</a></a></td>
									@endfor
								</tr>
							</thead>
							<tbody>
								@foreach ($rit as $key => $row)
								<tr align="center">
									<td>{!! $key+1 !!}</td>
									<td>{!! $row->user->no_perahu !!}</td>
									<td>{!! $row->user->no_anggota !!}</td>
									<td>{!! $row->user->nama_depan. ' ' .$row->user->belakang !!}</td>
									@for ($i = 1; $i <= 31; $i++)
										<td align="center"><a href="#" onclick="edit('{!! $row->whereUserId($row->user_id)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->value('tanggal') !!}', '{!! $row->user->nama_depan !!}', '{!! $row->whereUserId($row->user_id)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->value('id') !!}')">{!! $row->whereUserId($row->user_id)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->value('jumlah_rit') ?: '' !!}</a></td>
									@endfor
									<td align="center">{!! $row->whereUserId($row->user_id)->whereMonth('tanggal', $bulan)->sum('jumlah_rit') !!}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" align="center">Jumlah</td>
									@for ($i = 1; $i <= 31; $i++)
										<td align="center">{!! $row->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->sum('jumlah_rit') ?: '' !!}</td>
									@endfor
									<td align="center">{!! $row->whereMonth('tanggal', $bulan)->sum('jumlah_rit') !!}</td>
								</tr>
							</tfoot>
						</table>