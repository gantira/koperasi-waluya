@extends('layouts.master', ['rit'=>'active'])

@section('title', $title)

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
						<div class="clearfix">
                            
                        </div>
					</div>
					<div class="content table-responsive">
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
									@if (Auth::user()->role == 'admin')
										@for ($i = 1; $i <= 31; $i++)
											<td align="center"><a href="#" onclick="edit('{!! $row->whereUserId($row->user_id)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->value('tanggal') !!}', '{!! $row->user->nama_depan !!}', '{!! $row->whereUserId($row->user_id)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->value('id') !!}')">{!! $row->whereUserId($row->user_id)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->value('jumlah_rit') ?: '' !!}</a></td>
										@endfor
									@else
										@for ($i = 1; $i <= 31; $i++)
											<td align="center">{!! $row->whereUserId($row->user_id)->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->value('jumlah_rit') ?: '' !!}</td>
										@endfor
									@endif
									<td align="center">{!! $row->whereUserId($row->user_id)->whereMonth('tanggal', $bulan)->sum('jumlah_rit') !!}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr align="center">
									<td colspan="4">Jumlah</td>
									@for ($i = 1; $i <= 31; $i++)
										<td>{!! $row->whereDay('tanggal', $i)->whereMonth('tanggal', $bulan)->sum('jumlah_rit') ?: '' !!}</td>
									@endfor
									<td>{!! $row->whereMonth('tanggal', $bulan)->sum('jumlah_rit') !!}</td>
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

<!-- Button trigger modal -->
<button type="button" onclick="edit()">
  Launch demo modal
</button>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        Jumlah {!! Form::text('jumlah_rit', null, ['id'=>'jumlah_rit', 'size'=>'3']) !!}
        {!! Form::hidden('noId', null, ['id'=>'noId']) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update()">Save changes</button>
        <button type="button" class="btn btn-danger" onclick="hapus()">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		function edit(tgl, nama, id) {
			var r = confirm('Edit transaksi '+nama+' tanggal '+tgl+' ?');

			if (r) {
				$.ajax({
		            url: '{{ url('rit/cek') }}/'+id,
		            type: "GET",
		            success: function(data){
		                console.log(data);

		                document.getElementById("myModalLabel").innerHTML = nama+' '+tgl;
						document.getElementById("jumlah_rit").value = data.jumlah_rit ;
						document.getElementById("noId").value = id ;
						$('#myModal').modal('show');
		            }
		        }); 
					
			}
		}

		function update() {
			var noId =  $('#noId').val();

			var dataString = { 
                jumlah_rit : $('#jumlah_rit').val(),
                noid : noId,
                _token : '{{ csrf_token() }}'
            };

			$.ajax({
	            url: '{{ url('rit') }}/'+noId,
	            data: dataString,
	            type: "PATCH",
	            success: function(data){
	                console.log(data);

	                window.location.reload();
	            }
	        }); 
		}

		function hapus() {
			var noId =  $('#noId').val();

			var dataString = { 
                noid : noId,
                _token : '{{ csrf_token() }}'
            };

			$.ajax({
	            url: '{{ url('rit') }}/'+noId,
	            data: dataString,
	            type: "DELETE",
	            success: function(data){
	                console.log(data);

	                window.location.reload();
	            }
	        }); 
		}
	</script>
@endpush