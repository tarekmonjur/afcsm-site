<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;


class CommonController extends Controller
{
    protected  $client;


    public function __construct()
    {
        $this->client = new Client(['cookies' => true]);

        if(env('API_MODE') == 0) {
            // test api
            $this->baseUrl = "http://localhost/afcsm_api/public/mrapi/v0.0.1/";
//            $this->baseUrl = "http://103.23.41.189:81/mrapi/v0.0.1/";
        }
        elseif(env('API_MODE') == 1)
        {
            // live api
            $this->baseUrl = "http://35.160.205.158/mrapi/v0.0.1/";
        }
    }


    public function sendRequest($method, $url, $query=[], $auth_token2=null)
    {
        if(app('session')->has('api-token')){
            $auth_token = app('session')->get('api-token');
        }else if(!empty($auth_token2) && $auth_token2 !=null){
            $auth_token = $auth_token2;
        }else{
            $auth_token = '';
        }

        $result = $this->client->request($method, $this->baseUrl.$url, [
            'form_params' => $query,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json',
                'api-token'  => $auth_token
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);

//        dd($result, $content, $data);
//        dd($data);

        if($data->code == 401 || $data->code == '401'){
            header("Location: ".env('APP_URL')."/logout", true);
            exit;
        }
        return $data;
    }



    public function sendAuthRequest($method, $url, $query=[])
    {
        if(app('session')->has('api-token')){
            $auth_token = app('session')->get('api-token');
        }else{
            $auth_token = '';
        }

        $result = $this->client->request($method, $this->baseUrl.$url, [
            'form_params' => $query,
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json',
                'api-token'  => $auth_token
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);
//        dd($data);
        return $data;
    }



    public function sendRequestOther($method, $url, $query=[], $auth_token=null)
    {
        $result = $this->client->request($method, $url, [
            'form_params' => $query,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json',
                'api-token'  => $auth_token
            ]
        ]);

        $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $data = json_decode($body);

//        dd($result, $content, $data);

        return $data;
    }



}
