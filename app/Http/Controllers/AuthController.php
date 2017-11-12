<?php
/**
 * Created by PhpStorm.
 * User: Tarek
 * Date: 9/26/2017
 * Time: 1:25 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct();
        View::share('segment', $request->segment(1));
    }


    public function showRegister()
    {

        $data['company'] = $this->companyList();
        return view('auth.register')->with($data);
    }


    public function register(Request $request)
    {
        $attempt = $this->httpClient->sendAuthRequest('POST','company', $request->all());

        if($attempt->code == 200){
            $request->session()->flash('allData', $attempt);
            return redirect('/login');
        }else{
            $request->session()->flash('allData', $attempt);
            $request->session()->flash('old', $request->all());
            return redirect('/register');
        }
    }


    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $attempt = $this->httpClient->sendAuthRequest('POST','login', [
            'mobile_no' => $request->mobile_no,
            'password'  => $request->password,
            'user_type' => 'company'
        ]);

        if($attempt->code == 200){
            app('session')->put('api-token', $attempt->data->{'api-token'});
            app('session')->put('auth', $attempt->data);
            return redirect('/');
        }else{
            $request->session()->flash('allData', $attempt);
            $request->session()->flash('old', $request->all());
            return redirect('/login');
        }
    }


    public function logout(Request $request)
    {
        $logout = $this->httpClient->sendAuthRequest('GET','logout');
        if(isset($logout->code) && ($logout->code == 200 || $logout->code == 401)){
            $request->session()->flush();
        }
        return redirect('/');

    }


}