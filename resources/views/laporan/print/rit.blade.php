<td colspan="3"><h2>{!! $title !!}</h2></td>
<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No Urut</th>
									<th>No Perahu</th>
									<th>No Anggota</th>
									<th>Nama Perahu</th>
									@for ($i = 1; $i <= 12; $i++)
										<th><a href="{!! url()->full().'&bulan='.Carbon\Carbon::now()->startOfMonth()->month($i)->format('m') !!}">{!! Carbon\Carbon::now()->startOfMonth()->subMonth()->month($i)->format('F') !!}</a></th>
									@endfor
									<th>Jumlah</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($rit as $key => $row)
								<tr align="center">
									<td>{!! $key+1 !!}</td>
									<td>{!! $row->user->no_perahu !!}</td>
									<td>{!! $row->user->no_anggota !!}</td>
									<td>{!! $row->user->nama_depan. ' ' .$row->user->belakang !!}</td>
									@for ($i = 1; $i <= 12; $i++)
										<td align="center">{!! $row->whereUserId($row->user_id)->whereMonth('tanggal', $i)->sum('jumlah_rit')  ?: ''  !!}</td>
									@endfor
									<td align="center">{!! $row->whereUserId($row->user_id)->sum('jumlah_rit') !!}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4"  align="center">Jumlah</td>
									@for ($i = 1; $i <= 12; $i++)
										<td  align="center">{!! $row->whereMonth('tanggal', $i)->sum('jumlah_rit') ?: ''  !!}</td>
									@endfor
									<td  align="center">{!! $row->sum('jumlah_rit') !!}</td>
								</tr>
							</tfoot>
						</table>