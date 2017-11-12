<?php
/**
 * Created by PhpStorm.
 * User: Tarek
 * Date: 10/10/2017
 * Time: 12:17 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
        View::share('segment', $request->segment(1));

        if(env('API_MODE') == 0) {
            // test api
            $this->smapi = 'http://103.23.41.190/smapi/v0.0.1/';
            $this->saapi = 'http://103.23.41.190/saapi/v0.0.1/';
        }
        elseif(env('API_MODE') == 1)
        {
            // live api
            $this->smapi = 'http://35.162.97.16/smapi/v0.0.1/';
            $this->saapi = 'http://35.162.97.16/saapi/v0.0.1/';
        }


    }


    public function index(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $data['mr_lists'] = $this->httpClient->sendRequest('POST','my-mr', [
            'full_name' => $request->input('full_name'),
            'company_id' => $this->auth->company_id,
            'product' => $request->input('product'),
            'city' => $request->input('city'),
            'status' => ''
        ]);
//        dd($data);
        return view('dashboard.home')->with($data);
    }


    public function mrVerify(Request $request)
    {
        $verify = $this->httpClient->sendRequest('POST','mr-verify', [
            'experience_id' => $request->segment(2),
            'mr_mobile_no' => $request->segment(3),
            'company_id' => $this->auth->company_id,
        ]);
        $request->session()->flash('allData', $verify);
        return redirect('/dashboard');
    }


    public function myMrList(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $data['mr_lists'] = $this->httpClient->sendRequest('POST','my-mr', [
            'full_name' => $request->input('full_name'),
            'company_id' => $this->auth->company_id,
            'product' => $request->input('product'),
            'city' => $request->input('city'),
            'status' => 'verified'
        ]);

        return view('dashboard.my_mr')->with($data);
    }


    public function mrDoctorList(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $mr_mobile = decrypt($request->segment(2));
        $mr_api_token = $request->segment(3);

        $data['doctor_list'] = $this->httpClient->sendRequestOther('POST',$this->smapi.'get-doctor-details-from-custom-search-for-mr', [
            'mr_mobile_no' => $mr_mobile,
            'api_token' => $mr_api_token,
        ]);
        if(!is_array($data['doctor_list']->data)){
            $data['doctor_list']->data = [];
        }
        $data['mr_mobile_no'] = $mr_mobile;
        $data['mr_api_token'] = $mr_api_token;

        return view('dashboard.mr_doctor')->with($data);
    }


    public function mrAssistantList(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $mr_mobile = decrypt($request->segment(2));
        $mr_api_token = $request->segment(3);

        $data['assistant_list'] = $this->httpClient->sendRequestOther('POST',$this->smapi.'smart-assistant-search-request-from-mr', [
            'mr_mobile_no' => $mr_mobile,
            'api_token' => $mr_api_token,
        ]);
        if(!is_array($data['assistant_list']->data)){
            $data['assistant_list']->data = [];
        }
        $data['mr_mobile_no'] = $mr_mobile;
        $data['mr_api_token'] = $mr_api_token;

        return view('dashboard.mr_assistant')->with($data);
    }


    public function mrDoctorVisitHistory(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $mr_mobile = decrypt($request->segment(2));
        $doctor_mobile = decrypt($request->segment(3));
        $mr_api_token = $request->segment(4);

        $data['doctor_list'] = $this->httpClient->sendRequestOther('POST',$this->smapi.'get-doctor-details-from-custom-search-for-mr', [
            'mr_mobile_no' => $mr_mobile,
            'api_token' => $mr_api_token,
        ]);
        if(!is_array($data['doctor_list']->data)){
            $data['doctor_list']->data = [];
        }

        $data['doctor_visits'] = $this->httpClient->sendRequest('GET','doctor-visits/'.$mr_mobile.'/'.$doctor_mobile);
        if(!is_array($data['doctor_visits']->data)){
            $data['doctor_visits']->data = [];
        }
        $data['mr_mobile_no'] = $mr_mobile;
        $data['doctor_mobile_no'] = $doctor_mobile;
        $data['mr_api_token'] = $mr_api_token;

        return view('dashboard.mr_doctor_visit_history')->with($data);
    }


    public function mrCouponsDetails(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $mr_mobile = decrypt($request->segment(2));
        $mr_api_token = $request->segment(3);

        $data['coupons_details'] = $this->httpClient->sendRequestOther('POST',$this->smapi.'smart-mr-get-all-mapped-doctor-coupon-list', [
            'mr_mobile_no' => $mr_mobile,
            'api_token' => $mr_api_token,
        ]);
        if(!is_array($data['coupons_details']->data)){
            $data['coupons_details']->data = [];
        }
        $data['mr_mobile_no'] = $mr_mobile;
        $data['mr_api_token'] = $mr_api_token;

        return view('dashboard.mr_coupons_details')->with($data);
    }


    public function mrDoctorVisitHistorySearch(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $mr_mobile = $request->input('mr_mobile_no');
        $doctor_mobile = $request->input('doctor_mobile_no');
        $mr_api_token = $request->input('token');
        $date = $request->input('date');

//        dd($mr_mobile, $doctor_mobile, $date);

        $data['doctor_list'] = $this->httpClient->sendRequestOther('POST',$this->smapi.'get-doctor-details-from-custom-search-for-mr', [
            'mr_mobile_no' => $mr_mobile,
            'api_token' => $mr_api_token,
        ]);
        if(!is_array($data['doctor_list']->data)){
            $data['doctor_list']->data = [];
        }

        $data['doctor_visits'] = $this->httpClient->sendRequest('POST','doctor-visits-search',[
            'mr_mobile_no' => $mr_mobile,
            'doctor_mobile_no' => $doctor_mobile,
            'date' => $date
        ]);

        if(!is_array($data['doctor_visits']->data)){
            $data['doctor_visits']->data = [];
        }
        $data['mr_mobile_no'] = $mr_mobile;
        $data['doctor_mobile_no'] = $doctor_mobile;
        $data['mr_api_token'] = $mr_api_token;

        return view('dashboard.mr_doctor_visit_history')->with($data);
    }



}