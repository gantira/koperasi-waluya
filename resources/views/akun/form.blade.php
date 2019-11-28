<div class="row">
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
			<label>Kode</label>
			{!! Form::text('kode', null, ['class'=>'form-control border-input', 'placeholder'=>'Kode']) !!}
			<span class="help-block {{ $errors->has('kode') ? 'has-error' : '' }}">
				<small>{{ $errors->first('kode') }}</small>
			</span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('kategori') ? 'has-error' : '' }}">
			<label>Kategori <a href="{{ url('akun/kategori') }}"><b>+</b></a></label>
			{!! Form::select('kategori_id', App\Kategori::pluck('nama', 'id'), null, ['class'=>'form-control border-input', 'placeholder'=>'']) !!}
			<span class="help-block {{ $errors->has('kategori') ? 'has-error' : '' }}">
				<small>{{ $errors->first('kategori') }}</small>
			</span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
			<label>Nama</label>
			{!! Form::text('nama', null, ['class'=>'form-control border-input', 'placeholder'=>'Nama']) !!}
			<span class="help-block {{ $errors->has('nama') ? 'has-error' : '' }}">
				<small>{{ $errors->first('nama') }}</small>
			</span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
			<label>Keterangan</label>
			{!! Form::select('keterangan', ['masuk'=>'Penerimaan', 'keluar'=>'Pengeluaran'], null, ['class'=>'form-control border-input']) !!}
			<span class="help-block {{ $errors->has('keterangan') ? 'has-error' : '' }}">
				<small>{{ $errors->first('keterangan') }}</small>
			</span>
		</div>
	</div>
</div>

<div class="text-center">
	{!! Form::submit($button, ['class'=>'btn btn-info btn-fill btn-wd']) !!}
</div>
<div class="clearfix"></div>