<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>Koperasi Waluya</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body>

    <div id="boxForm">
        <h2 id="title">Login Koperasi Waluya</h2>
        
        {!! Form::open(['url'=>'login', 'method'=>'post']) !!}
        @include('layouts.alert')
            <input class='text' name='no_anggota' placeholder='Nomor' required>
            <br>
            <input class='text' name='password'  type='password' placeholder='Password' required>
            <br>
            <input id='rememberMe' name='rememberMe' type='checkbox'> <label>Remember me</label>
            <br>
            <input class='button' type='submit' value='Connection'>
        {!! Form::close() !!}
        <center>
            <a href="{{ url('formreset') }}" style="cursor:pointer"><label>Lupa Kata Sandi?</label></a>
        </center>
        <br>
    </div>

    <script src="{{ asset('js/index.js') }}"></script>


</body>

</html>
