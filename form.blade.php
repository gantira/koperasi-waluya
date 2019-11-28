<div class="row">
    <div class="col-md-7">
        <div class="form-group {{ $errors->has('no_identitas') ? 'has-error' : '' }}">
            <label>No Identitas</label>
            {!! Form::text('no_identitas', null, ['class'=>'form-control border-input', 'placeholder'=>'Kode']) !!}
            <span class="help-block {{ $errors->has('no_identitas') ? 'has-error' : '' }}">
                <small>{{ $errors->first('no_identitas') }}</small>
            </span>
            {!! Form::hidden('no_anggota', 'anggota', []) !!}
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group {{ $errors->has('jk') ? 'has-error' : '' }}">
            <label>Jenis Kelamin</label>
            {!! Form::select('jk', [''=>'','Laki-Laki'=>'Laki-Laki', 'Perempuan'=>'Perempuan'], null, ['class'=>'form-control border-input']) !!}
            <span class="help-block {{ $errors->has('jk') ? 'has-error' : '' }}">
                <small>{{ $errors->first('jk') }}</small>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nama_depan') ? 'has-error' : '' }}">
            <label>Nama Depan</label>
            {!! Form::text('nama_depan', null, ['class'=>'form-control border-input', 'placeholder'=>'Nama Depan']) !!}
            <span class="help-block {{ $errors->has('nama_depan') ? 'has-error' : '' }}">
                <small>{{ $errors->first('nama_depan') }}</small>
            </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('nama_belakang') ? 'has-error' : '' }}">
            <label>Nama Belakang</label>
            {!! Form::text('nama_belakang', null, ['class'=>'form-control border-input', 'placeholder'=>'Nama Belakang']) !!}
            <span class="help-block {{ $errors->has('nama_belakang') ? 'has-error' : '' }}">
                <small>{{ $errors->first('nama_belakang') }}</small>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
            <label>Alamat</label>
            {!! Form::text('alamat', null, ['class'=>'form-control border-input', 'placeholder'=>'Alamat']) !!}
            <span class="help-block {{ $errors->has('alamat') ? 'has-error' : '' }}">
                <small>{{ $errors->first('alamat') }}</small>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('kota') ? 'has-error' : '' }}">
            <label>Kota</label>
            {!! Form::text('kota', null, ['class'=>'form-control border-input', 'placeholder'=>'Kota']) !!}
            <span class="help-block {{ $errors->has('kota') ? 'has-error' : '' }}">
                <small>{{ $errors->first('kota') }}</small>
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('provinsi') ? 'has-error' : '' }}">
            <label>Provinsi</label>
            {!! Form::text('provinsi', null, ['class'=>'form-control border-input', 'placeholder'=>'Provinsi']) !!}
            <span class="help-block {{ $errors->has('provinsi') ? 'has-error' : '' }}">
                <small>{{ $errors->first('provinsi') }}</small>
            </span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('kode_pos') ? 'has-error' : '' }}">
            <label>Kode Pos</label>
            {!! Form::number('kode_pos', null, ['class'=>'form-control border-input', 'placeholder'=>'Kode Pos']) !!}
            <span class="help-block {{ $errors->has('kode_pos') ? 'has-error' : '' }}">
                <small>{{ $errors->first('kode_pos') }}</small>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('biodata') ? 'has-error' : '' }}">
            <label>Biodata</label>
            {!! Form::textarea('biodata', null, ['class'=>'form-control border-input', 'placeholder'=>'Ini deskripsi anda']) !!}
            <span class="help-block {{ $errors->has('biodata') ? 'has-error' : '' }}">
                <small>{{ $errors->first('biodata') }}</small>
            </span>
        </div>

    </div>
</div>
<div class="text-center">
    {!! Form::submit($button, ['class'=>'btn btn-info btn-fill btn-wd']) !!}
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-3">
    <div class="card">
        <div class="content">
            <div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                <label>Tempat Lahir</label>
                {!! Form::text('tempat_lahir', null, ['class'=>'form-control border-input', 'placeholder'=>'Tempat Lahir']) !!}
                <span class="help-block {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                    <small>{{ $errors->first('tempat_lahir') }}</small>
                </span>
            </div>
            <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                <label>Tanggal Lahir</label>
                {!! Form::text('tanggal_lahir', null, ['class'=>'form-control border-input', 'id'=>'datepicker']) !!}
                <span class="help-block {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                    <small>{{ $errors->first('tanggal_lahir') }}</small>
                </span>
            </div>
            <div class="form-group {{ $errors->has('hp') ? 'has-error' : '' }}">
                <label>HP</label>
                {!! Form::number('hp', null, ['class'=>'form-control border-input', 'placeholder'=>'HP']) !!}
                <span class="help-block {{ $errors->has('hp') ? 'has-error' : '' }}">
                    <small>{{ $errors->first('hp') }}</small>
                </span>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label>Email</label>
                {!! Form::email('email', null, ['class'=>'form-control border-input', 'placeholder'=>'Email']) !!}
                <span class="help-block {{ $errors->has('email') ? 'has-error' : '' }}">
                    <small>{{ $errors->first('email') }}</small>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-3">
    <div class="card">
        <div class="content">
            <div class="form-group {{ $errors->has('password') ? 'has-error' : 'has-warning' }}">
                {!! Form::password('password', ['class'=>'form-control border-input' ,'placeholder'=>'Password']) !!}
                <span class="help-block {{ $errors->has('password') ? 'has-error' : '' }}">
                    <small>{{ $errors->first('password') }}</small>
                </span>
            </div>
            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : 'has-warning' }}">
                {!! Form::password('password_confirmation', ['class'=>'form-control border-input' ,'placeholder'=>'Confirmasi Password']) !!}
                <span class="help-block {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <small>{{ $errors->first('password_confirmation') }}</small>
                </span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#datepicker').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
        });
    </script>
@endpush