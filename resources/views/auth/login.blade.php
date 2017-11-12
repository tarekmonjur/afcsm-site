<?php
if(app('session')->has('allData')){
    $all_data = app('session')->get('allData');
    $data = $all_data->data;
    $code = $all_data->code;
    $title = $all_data->title;
    $message = $all_data->message;
}else{
    $data = '';
    $code = '';
    $title = '';
    $message = '';
}

if(app('session')->has('old')){
    $old = app('session')->get('old');
}else{
    $old = [];
}

?>

@extends('layouts.layout')
@section('content')

<div class="row justify-content-md-center mt-5">
    <div class="col col-md-6">
        @if($code == 200 && $message)
            <div class="p-3 mb-2 bg-success text-white">{{$message}}</div>
        @endif

        @if($code != 200 && $message)
            <div class="p-3 mb-2 bg-danger text-white">{{$message}}</div>
        @endif
        <h1 class="text-center">{{$appName}}</h1>
        <form method="post" action="{{url('/login')}}">
            <fieldset class="border border-success border-success p-4" style="box-shadow: 0px 1px 0px #28a745e6">
                <legend class="col-form-legend col-sm-2">Login!</legend>
            <div class="form-group">
                <label for="mobile_no">Mobile No</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{$old['mobile_no'] or ''}}" placeholder="Enter Your Mobile No..">
                <small class="form-text text-danger">{{$data->mobile_no[0] or ''}}</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password..">
                <small class="form-text text-danger">{{$data->password[0] or ''}}</small>
            </div>
            <button type="submit" class="btn btn-success">Log In</button>
            </fieldset>
        </form>
    </div>
</div>

<div class="progress mt-5 mb-5">
    <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 1px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<div class="row">
    <div class="col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-success" href="#" role="button">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-success" href="#" role="button">View details &raquo;</a></p>
    </div>
    <div class="col-lg-4">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
        <p><a class="btn btn-success" href="#" role="button">View details &raquo;</a></p>
    </div>
</div>

@endsection