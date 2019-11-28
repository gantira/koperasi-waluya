<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::hidden('user_id', null, ['id'=>'user_id']) !!}
            {!! Form::hidden('kf', $kf, []) !!}
            <label>Nomor Anggota</label>
            <div class="input-group border-input">
                {!! Form::text(null, null, ['class'=>'form-control border-input', 'placeholder'=>'No Anggota', 'aria-label'=>'Input group example', 'aria-describedby'=>'btnGroupAddon', 'onkeyup'=>'show(this.value)', 'maxlength'=>7]) !!}
                <span class="input-group-addon" id="btnGroupAddon"><i id="loading"></i></span>
            </div>
            <span class="help-block {{ $errors->has('no_anggota') ? 'has-error' : '' }}">
                <small>{{ $errors->first('no_anggota') }}</small>
            </span>
        </div>

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
            <label>Cicilan</label>
            {!! Form::number('cicilan', null, ['class'=>'form-control border-input', 'placeholder'=>'Lama Pinjaman (bulan)', 'max'=>99]) !!}
            <span class="help-block {{ $errors->has('cicilan') ? 'has-error' : '' }}">
                <small>{{ $errors->first('cicilan') }}</small>
            </span>
        </div>

        <div class="form-group">
            <label>Jumlah Pinjam</label>
            {!! Form::text('pinjam', null, ['class'=>'form-control border-input', 'placeholder'=>'Jumlah Pinjam', 'id'=>'jumlah', 'onkeyup'=>'hitung(this.value)']) !!}
            <span class="help-block {{ $errors->has('pinjam') ? 'has-error' : '' }}">
                <small>{{ $errors->first('pinjam') }}</small>
            </span>
        </div>

        <div class="form-group">
            <label>Provisi</label>
            {!! Form::text('provisi', null, ['class'=>'form-control border-input', 'placeholder'=>'Provisi', 'id'=>'provisi']) !!}
            <span class="help-block {{ $errors->has('provisi') ? 'has-error' : '' }}">
                <small>{{ $errors->first('provisi') }}</small>
            </span>
        </div>

        <div class="form-group">
            <label>Administrasi</label>
            {!! Form::text('administrasi', null, ['class'=>'form-control border-input', 'placeholder'=>'Administrasi', 'id'=>'administrasi']) !!}
            <span class="help-block {{ $errors->has('administrasi_angsuran') ? 'has-error' : '' }}">
                <small>{{ $errors->first('administrasi') }}</small>
            </span>
        </div>

        <div class="form-group">
            <label>Pemupukan</label>
            {!! Form::text('pemupukan', null, ['class'=>'form-control border-input', 'placeholder'=>'Pemupukan', 'id'=>'pemupukan']) !!}
            <span class="help-block {{ $errors->has('pemupukan') ? 'has-error' : '' }}">
                <small>{{ $errors->first('pemupukan') }}</small>
            </span>
        </div>

        <div class="form-group text-center">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header" id="detail"></div>
                <div class="card-body">
                    <h4 class="card-title" id="saldo"></h4>
                    <p class="card-text" ></p>
                </div>
            </div>
        </div>     

        {!! Form::hidden('jasa', null, ['id'=>'jasa']) !!} 

        <div class="form-group text-center">
            {!! Form::submit($button, ['class'=>'btn btn-primary', 'id'=>'submit', 'disabled']) !!}
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

    function hitung(jumlah) {
        document.getElementById('administrasi').value = {{ $setting->administrasi_angsuran }};
        document.getElementById('provisi').value = (jumlah * {{ $setting->provisi_angsuran/100 }}).toFixed(0);
        document.getElementById('pemupukan').value = (jumlah * {{ $setting->pemupukan_angsuran/100 }}).toFixed(0);
        document.getElementById('jasa').value = {{ $setting->jasa_angsuran }};
    }

    function show(nomor) {
        var url = '{{ url('angsuran') }}/'+nomor;
        $('#loading').addClass('fa fa-spinner fa-spin');
        $.ajax({
            url: url,
            type: "GET",
            success: function(data){
                console.log(data);

                if (data) {
                    document.getElementById("detail").innerHTML = "No Anggota : "+String(data.no_anggota).bold()+"<br>"+
                    "Nama : "+String(data.nama_depan).bold()+"<br>"+
                    "JK : "+String(data.jk).bold()+"<br>"+
                    "Alamat : "+String(data.alamat).bold()+"<br>";

                    document.getElementById("saldo").innerHTML = "Saldo Simpanan Rp "+Number(data.saldo).toLocaleString();
                    document.getElementById('user_id').value = data.id;
                    document.getElementById("submit").disabled = false;
                    $('#loading').removeClass('fa fa-spinner fa-spin');
                }else {
                    document.getElementById("detail").innerHTML = "";
                    document.getElementById("saldo").innerHTML = "No Data";
                    document.getElementById("submit").disabled = true;
                    $('#loading').removeClass('fa fa-spinner fa-spin');
                }
            }
        }); 
    }
</script>
@endpush