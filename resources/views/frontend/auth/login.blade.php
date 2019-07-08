<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{!! asset('css/blue.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/ionicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/AdminLTE.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/_all-skins.min.css') !!}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>SYSTEM MANAGER</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Chào mừng bạn đến với hệ thống !</p>

        {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
            <div class="form-group has-feedback">
                {!! Form::email('email', old('email'),  array('class' => 'form-control', 'placeholder' => 'Email', 'required')) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'required')) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<script src="{!! asset('js/jquery.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
</body>
</html>
