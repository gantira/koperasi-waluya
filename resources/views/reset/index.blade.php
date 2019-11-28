<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Koperasi Waluya | Reset Password</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {!! Html::style('jquery-ui-1.12.1/jquery-ui.min.css') !!}

</head>

<body>

    <div id="boxForm">
        <h2 id="title">Form Reset Password</h2>
        
        {!! Form::open(['url'=>'reset', 'method'=>'post']) !!}
        @include('layouts.alert')
            <input class='text' name='no_anggota' placeholder='Nomor' required>
            <input id="datepicker" class='text' name='tanggal_lahir' placeholder='Tanggal Lahir' required>
            <br>
            <input class='button' type='submit' value='Reset'>
        {!! Form::close() !!}
    </div>

    <!--   Core JS Files   -->
    {!! Html::script('assets/js/jquery-1.10.2.js') !!}
    {!! Html::script('jquery-ui-1.12.1/jquery-ui.min.js') !!}

    <script type="text/javascript">
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
        });
    </script>

</body>

</html>
