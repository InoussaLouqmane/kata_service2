<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Login | KATA </title>
    <link rel="shortcut icon" href="{{asset('/img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/icons/flags/flags.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>

<body>

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="{{asset('/img/login.png')}}" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Bienvenu sur KATA</h1>
                        <p class="account-subtitle">Pas de compte? <a href="{{route('main.authentication.register')}}">S'inscrire</a></p>
                        <h2>Sign in</h2>

                        <form method="POST" action="">
                            @csrf
                            <div class="form-group">
                                <label>Email<span class="login-danger">*</span></label>
                                <input class="form-control" type="email">
                                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <div class="form-group">
                                <label>Password <span class="login-danger">*</span></label>
                                <input class="form-control pass-input" type="text">
                                <span class="profile-views feather-eye toggle-password"></span>
                            </div>
                            <div class="forgotpass">
                                <div class="remember-me">
                                    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Se souvenir de moi
                                        <input type="checkbox" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <a href="{{--{{route('main.authentication.forgot-password')}}--}}">Mot de passe oublié?</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
                            </div>
                        </form>

                        {{--<div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">or</span>
                        </div>

                        <div class="social-login">
                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/js/feather.min.js')}}"></script>
<script src="{{asset('/js/script.js')}}"></script>
<script src="{{asset('/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" defer></script>

</body>


</html>
