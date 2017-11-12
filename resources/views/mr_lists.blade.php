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
    <div class="list-group col col-md-10">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start bg-success">
            <div class="d-flex w-100 justify-content-between" style="color:#fff">
                <h5 class="mb-1">{{$appName}} MR LISTS.</h5>
                <small>Total {{count($mr_lists->data)}}</small>
            </div>
        </a>

        <form  class="list-group-item" method="get" action="">
            <div class="form-row align-items-center">
                <div class="col-sm-3 pl-0">
                    <label class="sr-only" for="company_id">Username</label>
                    <div class="input-group mb-2 mb-sm-0">
                        <select class="form-control" name="company_id" id="company_id">
                            <option value="">--- Select Company ---</option>
                            @foreach($company as $com)
                                <option @if(isset($old['company_id']) && $old['company_id'] == $com->id) selected @endif value="{{$com->id}}">{{$com->company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3 pl-0">
                    <input type="text" name="full_name" value="{{$old['full_name'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="MR Full Name...">
                </div>
                <div class="col-sm-3 pl-0">
                    <input type="text" name="product" value="{{$old['product'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="Product...">
                </div>
                <div class="col-sm-2 pl-0">
                    <input type="text" name="city" value="{{$old['city'] or ''}}" class="form-control mb-2 mb-sm-0" placeholder="City...">
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        @forelse($mr_lists->data as $info)
                <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-2">
                            <div class="d-flex justify-content-between">
                                @if($info->photo)
                                <img src="{{$info->photo}}" alt="..." class="rounded-circle" style="width: 120px!important; height: 120px!important;">
                                @else
                                <img src="{{url('/images/placeholder.png')}}" alt="..." class="rounded-circle" style="width: 120px!important; height: 120px!important;">
                                @endif
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">{{$info->full_name}} @if($info->position_name) ( {{$info->position_name}} ) @endif</h5>
                                @if($info->company_verify == 'verified')
                                    <small class="text-success">Verified</small>
                                @else
                                    @if($auth && $info->company_id == $auth->company_id)
                                        <a href="#" onclick="checkVerify('Are you sure verify this MR?', '{{url('mr-verify/'.$info->experience_id.'/'.$info->mobile_no)}}')"><small class="text-danger">Unverified</small></a>
                                    @else
                                    <small class="text-danger">Unverified</small>
                                    @endif
                                @endif
                            </div>
                            <p class="mb-1">Company Name : {{$info->company_name or '---'}}</p>
                            <p class="mb-1">Mobile : {{$info->mobile_no}}</p>
                            <p class="mb-1">Email : {{$info->email}}</p>
                            <p class="mb-1"></p>
                            <small class="text-muted">Address : {{$info->city}}, {{$info->area}}, {{$info->present_address}}</small>
                        </div>
                    </div>
                </div>
        @empty
            <div href="#" class="list-group-item">
            <h3 class="h5">No data available...</h3>
            </div>
        @endforelse
    </div>
</div>

@endsection

@section('script')
    <script>
        function checkVerify(message, url){
            swal({
                title: message,
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#218838',
                cancelButtonColor: '#c82333',
                confirmButtonText: 'Yes, verify it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                console.log(url);
                window.location.href=url;
                // swal(
                //   'Deleted!',
                //   'Your file has been deleted.',
                //   'success'
                // )
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'your stuff is safe.',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection