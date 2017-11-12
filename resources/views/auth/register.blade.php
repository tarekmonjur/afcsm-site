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
        <div class="col col-md-8">
            @if($code == 200 && $message)
                <div class="p-3 mb-2 bg-success text-white">{{$message}}</div>
            @endif

            @if($code != 200 && $message)
                <div class="p-3 mb-2 bg-danger text-white">{{$message}}</div>
            @endif
            <h1 class="text-center">{{$appName}}</h1>
            <form method="post" action="{{url('/register')}}">
                <fieldset class="border border-success border-success p-4" style="box-shadow: 0px 1px 0px #28a745e6">
                    <legend class="col-form-legend col-sm-2">Register!</legend>
                    <div class="row">
                        <div class="form-group col">
                            <label for="company_id">Company Name </label>
                            <select class="form-control" name="company_id" id="company_id">
                                <option value="">--- Select Company ---</option>
                                @foreach($company as $com)
                                    <option value="{{$com->id}}">{{$com->company_name}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-danger">{{$data->company_id[0] or ''}}</small>
                        </div>
                        <div class="form-group col">
                            <label for="company_license_number">Company License Number </label>
                            <input type="text" class="form-control" id="company_license_number" name="company_license_number" value="{{$old['company_license_number'] or ''}}" placeholder="Enter Company License Number..">
                            <small class="form-text text-danger">{{$data->company_license_number[0] or ''}}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="company_address">Company Address </label>
                            <input type="text" class="form-control" id="company_address" name="company_address" value="{{$old['company_address'] or ''}}" placeholder="Enter Company Address..">
                            <small class="form-text text-danger">{{$data->company_address[0] or ''}}</small>
                        </div>
                        <div class="form-group col">
                            <label for="company_details">Company Details </label>
                            <input type="text" class="form-control" id="company_details" name="company_details" value="{{$old['company_details'] or ''}}" placeholder="Enter Company Details..">
                            <small class="form-text text-danger">{{$data->company_details[0] or ''}}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="contact_person_name">Contact Person Name </label>
                            <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" value="{{$old['contact_person_name'] or ''}}" placeholder="Enter Contact Person Name..">
                            <small class="form-text text-danger">{{$data->contact_person_name[0] or ''}}</small>
                        </div>
                        <div class="form-group col">
                            <label for="email">Contact Person Email </label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$old['email'] or ''}}" placeholder="Enter Contact Person Email..">
                            <small class="form-text text-danger">{{$data->email[0] or ''}}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="mobile_no">Contact Person Mobile </label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{$old['mobile_no'] or ''}}" placeholder="Enter Contact Person Mobile..">
                            <small class="form-text text-danger">{{$data->mobile_no[0] or ''}}</small>
                        </div>
                        <div class="form-group col">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password..">
                            <small class="form-text text-danger">{{$data->password[0] or ''}}</small>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-success">Register</button>
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