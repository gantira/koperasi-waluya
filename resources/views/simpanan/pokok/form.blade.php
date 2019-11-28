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
            <label>Jenis Transaksi</label>
            {!! Form::select('jenis', [''=>'-Pilih-', 'simpan'=>'Menyimpan', 'keluar'=>'Mengambil'], null, ['class'=>'form-control border-input']) !!}
            <span class="help-block {{ $errors->has('jenis') ? 'has-error' : '' }}">
                <small>{{ $errors->first('jenis') }}</small>
            </span>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            {!! Form::text('jumlah', null, ['class'=>'form-control border-input', 'placeholder'=>'Jumlah']) !!}
            <span class="help-block {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                <small>{{ $errors->first('jumlah') }}</small>
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

    function show(nomor) {
        var url = '{{ url('pokok') }}/'+nomor;
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
                    document.getElementById('user_id').value= data.id;
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