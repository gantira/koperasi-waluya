<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Koperasi Waluya | New Password</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    <div id="boxForm">
        <h2 id="title">New Password</h2>
        
        {!! Form::open(['url'=>'newpassword', 'method'=>'post']) !!}
        @include('layouts.alert')
            {!! Form::hidden('no_anggota', $user->no_anggota, []) !!}
            <input class='text' type="password" name='password' placeholder='Password' minlength="6" required>
            <input class='button' type='submit' value='Submit'>
        {!! Form::close() !!}
    </div>

    <!--   Core JS Files   -->
    {!! Html::script('assets/js/jquery-1.10.2.js') !!}


</body>

</html>
