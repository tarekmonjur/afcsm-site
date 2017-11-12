<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{url('images/logo.png')}}">

    <title>{{$appName}}</title>

    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">--}}
    <link href="{{url('css/bootstrap-datepicker.standalone.min.css')}}" rel="stylesheet">
    <link href="{{url('css/style.css')}}" rel="stylesheet">
    <link href="{{url('css/sweetalert2.css')}}" rel="stylesheet">
    @yield('style')
</head>

<body>
<div class="container">
@include('layouts.header')
@yield('content')
@include('layouts.footer')
@yield('script')
</div>
</body>
</html>