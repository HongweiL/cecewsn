<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CECEWSN</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/animate.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <style type="text/css">
        .btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
        .btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
        .btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
        .btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
        .btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
        .btn-primary.active { color: rgba(255, 255, 255, 0.75); }
        .btn-primary { background-color: #4a77d4; background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4); background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4)); background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4); background-image: -o-linear-gradient(top, #6eb6de, #4a77d4); background-image: linear-gradient(top, #6eb6de, #4a77d4); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);  border: 1px solid #3762bc; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
        .btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #4a77d4; }
        .btn-block { width: 100%; display:block; }

        * { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

        html { width: 100%; height:100%; overflow:hidden; }

        body {
            width: 100%;
            height:100%;
            font-family: 'Open Sans', sans-serif;
            background:#2c3f52;
            margin:0;
        }
        .dajiba {
            display: flex;
            flex-direction: column;
            width: 60%;
            background:#e5e9f2;
            margin: 0;
            height: 100vh;

        }
        .full-name{
            height: 80vh;
            margin-left: 10%;
            padding-left:60%;
            background-image: url("img/login.jpeg");
            background-repeat: no-repeat;
            background-size: 60% 60%;
            background-position: center left;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .full-name p {
            font-size: 2vh;
            padding-top: none;
        }

        .full-name p:first-letter {
            color:#2c3f52;
            font-size: 4vh;
            font-weight: bold;
        }

        .dajiba>p {
            text-align: center;
        }

        .login-logo {
            position: relative;
            width:200px;
            height:200px;
            display: block;
            margin: auto;
        }
        .login {
            position: absolute;
            top: 30%;
            left: 80%;
            margin: -150px 0 0 -150px;
            width:300px;
            height:300px;
        }
        .login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }

        input {
            width: 100%;
            margin-bottom: 10px;
            background: rgba(0,0,0,0.3);
            border: none;
            outline: none;
            padding: 10px;
            font-size: 13px;
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
            border: 1px solid rgba(0,0,0,0.3);
            border-radius: 4px;
            box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
            -webkit-transition: box-shadow .5s ease;
            -moz-transition: box-shadow .5s ease;
            -o-transition: box-shadow .5s ease;
            -ms-transition: box-shadow .5s ease;
            transition: box-shadow .5s ease;
        }
        input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }
    </style>
</head>

<body>
<section class="dajiba">
    <div class="full-name">
        <p>Chemicals of</p>
        <p>Emerging</p>
        <p>Concern</p>
        <p>Early</p>
        <p>Warning</p>
        <p>Social</p>
        <p>Network</p>
    </div>
    <p>Designed by Team Anonymous</p>
</section>
<div class="login">
    <img class="login-logo" src="img/logo-w.gif" alt="Logo">
    <h1>Welcome back</h1>
    <form id="login_box" method="post" action="{{ route('login') }}">
        @csrf
        @if ($errors->has('email'))
            <span name="logSec" class="invalid-feedback" role="alert">
                                        <strong id="email_error" value="yes" style="color: lightpink;">{{ $errors->first('email') }}</strong>
                    </span>
        @endif
        @if ($errors->has('password'))
            <span name="logSec" class="invalid-feedback" role="alert">
                                        <strong id="password_error" value="yes" style="color: lightpink;">{{ $errors->first('password') }}</strong>
                                    </span>
        @endif
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus/>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-primary btn-block btn-large">Login</button>
    </form>
    <form id="signup_box" method="POST" action="{{ route('register') }}" style="display: none;">
        @csrf
        <div class="form-group row">
            <div class="col-md-6">
                <input id="fname" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" placeholder="First name" style="float: left; margin-right: 4%; width: 48%;" required autofocus>
                @if ($errors->has('fname'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
                <input id="lname" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" placeholder="Surname" style="width: 48%" required autofocus>
                @if ($errors->has('lname'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input id="affiliation" type="text" name="affiliation" value="{{ old('affiliation') }}" placeholder="Affiliation" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span name="regSec" class="invalid-feedback" role="alert">
                                        <strong id="email_error" value="yes" style="color: lightpink;">{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                @if ($errors->has('password'))
                    <span name="regSec" class="invalid-feedback" role="alert">
                                        <strong id="password_error" value="yes" style="color: lightpink;">{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary btn-block btn-large">
                    {{ __('Sign up') }}
                </button>
            </div>
        </div>
    </form>
    <button id="switch" class="btn btn-primary btn-block btn-large" onclick="t()">Go Register</button>
</div>
</body>
<script>
    var register = 0;
    function t () {
        if (register == 0) {
            $("form#login_box").attr('class', 'animated fadeOutRight 1s');
            $("button#switch").text("Let's Login");
            setTimeout(function(){
                $("form#login_box").attr('style', 'display:none');
                $("form#signup_box").attr('style', '');
                $("form#signup_box").attr('class', 'animated fadeInRight 1s');
                register = 1;
            }, 1000);
        } else {
            $("form#signup_box").attr('class', 'animated fadeOutRight 1s');
            $("button#switch").text("Go Register");
            setTimeout(function(){
                $("form#signup_box").attr('style', 'display:none');
                $("form#login_box").attr('style', '');
                $("form#login_box").attr('class', 'animated fadeInRight 1s');
                register = 0;
            }, 1000);
        }
    }
    check_error();
    function check_error() {
        if ($('strong#email_error').attr("value") == "yes") {
            if ($('strong#email_error').html() == 'The email has already been taken.') {
                $("form#login_box").attr('style', 'display:none');
                $("form#signup_box").attr('style', '');
                $("span[name='logSec']").attr('style', 'display:none');
                $("button#switch").text("Let's Login");
                register = 1;
            } else if ($('strong#email_error').html() == "These credentials do not match our records.") {
                $("span[name='regSec']").attr('style', 'display:none');
            }
        } else if ($('strong#password_error').attr("value") == "yes") {
            if ($('strong#password_error').html() == "The password confirmation does not match." || $('strong#password_error').html() == "The password must be at least 6 characters.") {
                $("form#login_box").attr('style', 'display:none');
                $("form#signup_box").attr('style', '');
                $("span[name='logSec']").attr('style', 'display:none');
                $("button#switch").text("Let's Login");
                register = 1;
            } else if ($('strong#email_error').html() == "These credentials do not match our records.") {
                $("span[name='regSec']").attr('style', 'display:none');
            }
        }
    }
</script>
</html>
