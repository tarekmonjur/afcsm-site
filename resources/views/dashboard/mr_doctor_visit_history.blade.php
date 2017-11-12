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
        <div class="list-group col col-md-11">
            <div class="list-group-item list-group-item-action flex-column align-items-start bg-success">
                <div class="d-flex w-100 justify-content-between" style="color:#fff">
                    <h5 class="mb-1">MR DOCTOR VISIT HISTORY ( MR ID - {{$mr_mobile_no}} )</h5>
                    <small>Total {{count($doctor_visits->data)}}</small>
                </div>
            </div>

            <form class="list-group-item" method="get" action="{{url('mr-doctor-visit-history-search')}}">
                <input type="hidden" name="mr_mobile_no" value="{{$mr_mobile_no}}">
                <input type="hidden" name="token" value="{{$mr_api_token}}">
                <div class="row justify-content-md-center align-items-center">
                    <div class="col-sm-4">
                        <select name="doctor_mobile_no" class="form-control">
                            <option value="">--- All Visit History ---</option>
                            @foreach($doctor_list->data as $dinfo)
                                <option value="{{$dinfo->userid}}" @if($doctor_mobile_no == $dinfo->userid) selected @endif>{{$dinfo->doctor_name}} - ( {{$dinfo->userid}} )</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="datepicker" name="date" value="{{$old['date'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="Date...">
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-hover" style="font-size: 12px!important;">
                <thead style="background-color: #effff0;">
                <tr>
                    <th>SL</th>
                    <th>MR Mobile No</th>
                    <th>Doctor Mobile No</th>
                    <th>Doctor Name</th>
                    <th>Doctor Designation</th>
                    <th>Doctor Education</th>
                    <th>Chamber Name</th>
                    <th>Chamber Address</th>
                    <th>Visit Start</th>
                    <th>Visit End</th>
                    <th>Total Visit Time</th>
                    <th>Remarks</th>
                </tr>
                </thead>
                <tbody>
                @forelse($doctor_visits->data as $info)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$info->smMobileNo}}</td>
                        <td>{{$info->doctorMobileNo}}</td>
                        <td>{{$info->doctorFullname}}</td>
                        <td>{{$info->doctorDesignation}}</td>
                        <td>{{$info->doctorEducation}}</td>
                        <td>{{$info->doctorChamberName}}</td>
                        <td>{{$info->doctorChamberAddress}}</td>
                        <td>{{$info->smVisitStart}}</td>
                        <td>{{$info->smVisitEnd}}</td>
                        <td>{{$info->totalVisitTime}}</td>
                        <td>{{$info->remarks}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12"><h3 class="h5">No data available...</h3></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection