<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="content">
                <p class="lead">Pinjaman <b>Angsuran</b></p>
                <hr>
                <div class="form-group">
                    <label>Max Besar Pinjaman <i class="ti-info-alt fa-sm" data-toggle="tooltip" data-placement="top" title="Max * (Simpanan Pokok+Simpanan Wajib)"></i></label>
                    {!! Form::text('besar_angsuran', null, ['class'=>'form-control max text-center', 'data-prefix'=>'', 'autocomplete'=>'off']) !!}

                </div>

                <div class="form-group">
                    <label>Jasa</label>
                    {!! Form::text('jasa_angsuran', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Provisi</label>
                    {!! Form::text('provisi_angsuran', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Pemupukan</label>
                    {!! Form::text('pemupukan_angsuran', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Administrasi</label>
                    {!! Form::text('administrasi_angsuran', null, ['class'=>'form-control border-input', 'autocomplete'=>'off']) !!}
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="content">
                <p class="lead">Pinjaman <b>Kilat</b></p>
                <hr>
                <div class="form-group">
                    <label>Max Besar Pinjaman <i class="ti-info-alt fa-sm" data-toggle="tooltip" data-placement="top" title="Max * (Simpanan Pokok+Simpanan Wajib)"></i></label>
                    {!! Form::text('besar_kilat', null, ['class'=>'form-control max text-center', 'data-prefix'=>'', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Jasa</label>
                    {!! Form::text('jasa_kilat', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Provisi</label>
                    {!! Form::text('provisi_kilat', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Pemupukan</label>
                    {!! Form::text('pemupukan_kilat', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Administrasi</label>
                    {!! Form::text('administrasi_kilat', null, ['class'=>'form-control border-input', 'autocomplete'=>'off']) !!}
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="content">
                <p class="lead">Pembagian <b>SHU</b></p>
                <hr>
                <div class="form-group">
                    <label>Pengurus</label>
                    {!! Form::text('jasa_pengurus', null, ['class'=>'form-control decimal text-center', 'data-prefix'=>'', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Pengawas</label>
                    {!! Form::text('jasa_pengawas', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Sosial</label>
                    {!! Form::text('shu_sosial', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Cadangan</label>
                    {!! Form::text('shu_cadangan', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Jasa Simpanan</label>
                    {!! Form::text('jasa_simpanan', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>

                <div class="form-group">
                    <label>Jasa Pinjaman</label>
                    {!! Form::text('jasa_pinjaman', null, ['class'=>'form-control decimal text-center', 'touchspin', 'autocomplete'=>'off']) !!}
                </div>


            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="content">
                <p class="lead">RIT <b>Perahu</b></p>
                <hr>
                <div class="form-group">
                    <label>Besar Simpanan Wajib</label>
                    {!! Form::text('rit_simpanan_wajib', null, ['class'=>'form-control border-input', 'autocomplete'=>'off']) !!}
                </div>
                <div class="form-group">
                    <label>Besar Simpanan Manasuka</label>
                    {!! Form::text('rit_simpanan_manasuka', null, ['class'=>'form-control border-input', 'autocomplete'=>'off']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="content">
                <p class="lead">Pinjaman <b>Ketentuan</b> <i class="ti-info-alt" data-toggle="tooltip" data-placement="top" title="Pengecekan pelunasan sebelum meminjam."></i></p>
                <hr>
                <div class="form-group">
                    <div class="checkbox">
                        {!! Form::hidden('cek_pinjaman', false) !!}
                        {!! Form::checkbox('cek_pinjaman', true, null, ['id'=>'cek_pinjaman']) !!}
                        @if ($setting->cek_pinjaman)
                            <label class="text-success">Cek Pinjaman</label>
                        @else
                            <label><strike>Cek Pinjaman</strike></label>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group text-center">
                    {!! Form::submit($button, ['class'=>'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script type="text/javascript">
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })

        $('.decimal').TouchSpin({
            min: 0,
            max: 100,
            step: 0.5,
            decimals: 1,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });

        $('.max').TouchSpin({
            verticalbuttons: false,
            max: 10,
            verticalupclass: 'fa fa-plus',
            verticaldownclass: 'fa fa-minus',
            postfix: 'x'
        });
    </script>
@endpush