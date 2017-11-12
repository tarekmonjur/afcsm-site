
<div class="masthead">

    <div class="d-flex justify-content-between">
        <div class="text-success p-3"><h3>{{$appName}}</h3></div>
        <div class="text-success p-1">
            <strong>Phone : </strong>0123456789
            <br>
            <strong>HotLine :</strong> 98765
        </div>
    </div>

    <nav class="navbar navbar-primary navbar-expand-md navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav text-md-center nav-justified w-100">
                <li class="nav-item @if($segment == '') active @endif">
                    <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if($segment == 'mr-lists') active @endif">
                    <a class="nav-link" href="{{url('/mr-lists')}}">MR Lists</a>
                </li>
                @if(!empty($auth))
                <li class="nav-item @if($segment == 'my-mr') active @endif">
                    <a class="nav-link" href="{{url('/my-mr')}}">My MR</a>
                </li>
                @endif
                <li class="nav-item @if($segment == 'services') active @endif">
                    <a class="nav-link" href="{{url('/services')}}">Services</a>
                </li>
                <li class="nav-item @if($segment == 'download') active @endif">
                    <a class="nav-link" href="{{url('/download')}}">Downloads</a>
                </li>
                <li class="nav-item @if($segment == 'about') active @endif">
                    <a class="nav-link" href="{{url('/about')}}">About</a>
                </li>
                <li class="nav-item @if($segment == 'contact') active @endif">
                    <a class="nav-link" href="{{url('/contact')}}">Contact</a>
                </li>
                @if(empty($auth))
                <li class="nav-item @if($segment == 'register') active @endif">
                    <a class="nav-link" href="{{url('/register')}}">Register</a>
                </li>
                <li class="nav-item @if($segment == 'login') active @endif">
                    <a class="nav-link" href="{{url('/login')}}">Login</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$auth->full_name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    {{--@if(!empty($auth))--}}
    {{--<nav class="navbar navbar-secondary navbar-expand-lg navbar-light bg-light p-0">--}}
        {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
            {{--<span class="navbar-toggler-icon"></span>--}}
        {{--</button>--}}
        {{--<div class="collapse navbar-collapse justify-content-center" id="navbarNav">--}}
            {{--<ul class="navbar-nav text-md-center nav-justified" style="width: 50%!important;">--}}
                {{--<li class="nav-item @if($segment == 'dashboard') active @endif">--}}
                    {{--<a class="nav-link" href="{{url('/dashboard')}}">Dashboard <span class="sr-only">(current)</span></a>--}}
                {{--</li>--}}
                {{--<li class="nav-item @if($segment == 'my-mr') active @endif">--}}
                    {{--<a class="nav-link" href="{{url('/my-mr')}}">My MR</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item @if($segment == 'my-doctor') active @endif">--}}
                    {{--<a class="nav-link" href="{{url('/my-doctor')}}">My Doctor</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item @if($segment == 'doctor-visit-history') active @endif">--}}
                    {{--<a class="nav-link" href="{{url('/doctor-visit-history')}}">Doctor Visit History</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item @if($segment == 'doctor-visit-history') active @endif">--}}
                    {{--<a class="nav-link" href="{{url('/coupons-details')}}">Coupons Details</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</nav>--}}
    {{--@endif--}}

</div>



