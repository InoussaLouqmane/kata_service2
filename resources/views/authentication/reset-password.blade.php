@php use Illuminate\Support\Facades\Auth;
 $user = Auth::user();
 @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preskool - Connexion</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

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
                @auth
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Bienvenu, {{$user->lastName}}</h1>
                            @if($errors->has('passwordDiff'))
                                <span class="text-danger">{{ $errors->first('passwordDiff') }}</span>
                            @endif
                            <p class="account-subtitle">Réinitialisez votre mot de passe !</p>


                            <form action="{{route('resetPassword.web')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nouveau mot de passe <span
                                            class="login-danger">*</span></label>
                                    <input class="form-control" name="password" type="text">
                                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirmer mot de passe <span
                                            class="login-danger">*</span></label>
                                    <input class="form-control" name="confirm-password" type="text">
                                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input class="form-control" type="hidden" name="userId" value="{{$user->id}}">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Continuer</button>
                                </div>
                            </form>

                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>


<script src="{{asset('/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/js/feather.min.js')}}"></script>
<script src="{{asset('/js/script.js')}}"></script>
<script src="{{asset('/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"></script>
</body>

</html>
