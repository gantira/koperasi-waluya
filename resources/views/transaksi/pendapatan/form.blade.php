<div class="row">
    <div class="col-md-12">
       <div class="form-group">
            <label>Tanggal</label>
            <div class="input-group border-input">
                {!! Form::text('tanggal', null, ['class'=>'form-control border-input', 'id'=>'datepicker', 'data-language'=>'id']) !!}
                <span class="input-group-addon"><i class="ti-calendar"></i></span>
            </div>
            <span class="help-block {{ $errors->has('tanggal') ? 'has-error' : '' }}">
                <small>{{ $errors->first('tanggal') }}</small>
            </span>
        </div>
        
        <div class="form-group">
            <label>Jenis Transaksi</label>
            {!! Form::select('akun_id', $akun, null, ['class'=>'form-control border-input', 'placeholder'=>'- Pilih -']) !!}
            <span class="help-block {{ $errors->has('akun_id') ? 'has-error' : '' }}">
                <small>{{ $errors->first('akun_id') }}</small>
            </span>
        </div>
     
        <div class="form-group">
            <label>Jumlah</label>
            {!! Form::text('masuk', null, ['class'=>'form-control border-input', 'placeholder'=>'Jumlah', 'id'=>'jumlah']) !!}
            <span class="help-block {{ $errors->has('masuk') ? 'has-error' : '' }}">
                <small>{{ $errors->first('masuk') }}</small>
            </span>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            {!! Form::text('keterangan', null, ['class'=>'form-control border-input', 'placeholder'=>'Keterangan', 'id'=>'keterangan']) !!}
            <span class="help-block {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                <small>{{ $errors->first('keterangan') }}</small>
            </span>
        </div>

        {!! Form::hidden('jenis', 'masuk', []) !!}

        <div class="form-group text-center">
            {!! Form::submit($button, ['class'=>'btn btn-primary', 'id'=>'submit', 'onclick'=>'']) !!}
        </div>

        <div class="form-group text-center lead">
            @if (Session::has('message'))
            {!! Session::get('message') !!}
            @endif
        </div>
        
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });

</script>
@endpush