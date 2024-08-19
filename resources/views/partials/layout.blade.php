<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{" | KATA"}}</title>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="shortcut icon" href="{{asset('/img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/icons/flags/flags.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/simple-calendar/simple-calendar.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/datatables/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/alertify/alertify.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/dragula/css/dragula.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/toastr/toatr.css')}}">

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">


    @stack('head')
</head>
<body>

<div class="main-wrapper">

    @include('partials.header')
    @include('partials.sideBar')

    <div class="page-wrapper">
        @yield('content')

        <footer>
            <p>COPYRIGHT © 2024 DREAMSTECHNOLOGIES.</p>
        </footer>
    </div>

</div>




<script src="{{asset('/js/jquery-3.7.1.min.js')}}" ></script>
<script src="{{asset('/js/bootstrap.bundle.js')}}" ></script>
<script src="{{asset('/js/feather.min.js')}}" ></script>
<script src="{{asset('/plugins/slimscroll/jquery.slimscroll.min.js')}}" ></script>
<script src="{{asset('/plugins/datatables/datatables.js')}}" ></script>

@stack('scripts')

<script src="{{asset('/plugins/apexchart/apexcharts.min.js')}}" ></script>
<script src="{{asset('/plugins/apexchart/chart-data.js')}}"></script>
<script src="{{asset('/plugins/simple-calendar/jquery.simple-calendar.js')}}"></script>

<script src="{{asset('/js/calander.js')}}"></script>
<script src="{{asset('/js/circle-progress.min.js')}}"></script>
<script src="{{asset('/plugins/alertify/alertify.min.js')}}"></script>
<script src='{{asset('/plugins/fullcalendar/dist/index.global.js')}}'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
{{--<script src="{{asset('/plugins/alertify/custom-alertify.min.js')}}"></script>--}}
<script src="{{asset('/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('/plugins/toastr/toastr.js')}}"></script>
<script src="{{asset('/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('/plugins/moment/moment.min.js')}}" ></script>
<script src="{{asset('/js/bootstrap-datetimepicker.min.js')}}" ></script>
<script src="{{asset('/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('/js/ajax.js')}}"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
<script src="{{asset('/js/script.js')}}" ></script>
<script src="{{asset('/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"></script>


</body>


</html>
