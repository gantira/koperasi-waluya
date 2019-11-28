<div class="row">
    <div class="col-md-12">
        {!! Form::hidden('user_id', null, ['id'=>'user_id']) !!}
        {{-- {!! Form::hidden('no_perahu', null, ['id'=>'no_perahu']) !!} --}}
        {!! Form::hidden('user_input', Auth::user()->id, ['id'=>'user_input']) !!}
        {!! Form::hidden('kf', $kf, ['id'=>'kf']) !!}

        {{-- <div class="form-group">
            <label>Nomor Anggota</label>
            <div class="input-group border-input">
                {!! Form::text(null, null, ['class'=>'form-control border-input', 'placeholder'=>'Input nomor Anggota', 'aria-label'=>'Input group example', 'aria-describedby'=>'btnGroupAddon', 'onkeyup'=>'show(this.value)', 'maxlength'=>7]) !!}
                <span class="input-group-addon" id="btnGroupAddon"><i id="loading"></i></span>
            </div>
            <span class="help-block {{ $errors->has('user_id') ? 'has-error' : '' }}">
                <small>{{ $errors->first('user_id') }}</small>
            </span>
        </div> --}}

        <div class="form-group">
            <label>Nomor Perahu</label>
            <div class="input-group border-input">
                {!! Form::text(null, null, ['class'=>'form-control border-input', 'placeholder'=>'Input nomor perahu', 'aria-label'=>'Input group example', 'aria-describedby'=>'btnGroupAddon', 'onkeyup'=>'show_perahu(this.value)', 'maxlength'=>7]) !!}
                <span class="input-group-addon" id="btnGroupAddon"><i id="loading2"></i></span>
            </div>
            <span class="help-block {{ $errors->has('user_id') ? 'has-error' : '' }}">
                <small>{{ $errors->first('user_id') }}</small>
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
            <label>Banyak Rit</label>
            {!! Form::number('jumlah_rit', null, ['class'=>'form-control border-input', 'placeholder'=>'Input jumlah rit', 'max'=>99]) !!}
            <span class="help-block {{ $errors->has('jumlah_rit') ? 'has-error' : '' }}">
                <small>{{ $errors->first('jumlah_rit') }}</small>
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

    // function show(nomor) {
    //     var url = '{{ url('rit') }}/'+nomor;
    //     $('#loading').addClass('fa fa-spinner fa-spin');
    //     $.ajax({
    //         url: url,
    //         type: "GET",
    //         success: function(data){
    //             console.log(data);

    //             if (data) {
    //                 document.getElementById("detail").innerHTML = "No Anggota : "+String(data.no_anggota).bold()+"<br>"+
    //                 "Nama : "+String(data.nama_depan).bold()+"<br>"+
    //                 "JK : "+String(data.jk).bold()+"<br>"+
    //                 "Alamat : "+String(data.alamat).bold()+"<br>";
    //                 document.getElementById('user_id').value = data.id;
    //                 // document.getElementById("submit").disabled = false;
    //                 $('#loading').removeClass('fa fa-spinner fa-spin');
    //             }else {
    //                 document.getElementById("submit").disabled = true;
    //                 document.getElementById('user_id').value = "";
    //                 $('#loading').removeClass('fa fa-spinner fa-spin');
    //             }
    //         }
    //     }); 
    // }

    function show_perahu(nomor) {
        var url = '{{ url('rit/perahu') }}/'+nomor;
        $('#loading2').addClass('fa fa-spinner fa-spin');
        $.ajax({
            url: url,
            type: "GET",
            success: function(data){
                console.log(data);

                if (data) {
                    document.getElementById("saldo").innerHTML = data.nama_depan;
                    document.getElementById('user_id').value = data.id;
                    document.getElementById("submit").disabled = false;
                    $('#loading2').removeClass('fa fa-spinner fa-spin');
                }else {
                    document.getElementById("saldo").innerHTML = data;
                    document.getElementById('user_id').value = "";
                    document.getElementById("submit").disabled = true;
                    $('#loading2').removeClass('fa fa-spinner fa-spin');
                }
            }
        }); 
    }
</script>
@endpush
