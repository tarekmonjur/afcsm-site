<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $httpClient;

    protected $auth;

    public function __construct()
    {
        $httpClient = new CommonController;
        $this->httpClient = $httpClient;
        View::share('appName', str_replace('-',' ',env('APP_NAME')));
        $this->auth = app('session')->get('auth');
        View::share('auth', $this->auth);

    }


    public function companyList(){
        $result = $this->httpClient->sendRequest('GET','get-company-list');
        return $result->data;
    }


}
