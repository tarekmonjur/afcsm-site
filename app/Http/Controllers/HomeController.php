<?php
/**
 * Created by PhpStorm.
 * User: Tarek
 * Date: 10/3/2017
 * Time: 1:41 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
        View::share('segment', $request->segment(1));
    }


    public function index(){
        return view('home');
    }


    public function mrLists(Request $request)
    {
        $request->session()->flash('old', $request->all());
        $data['mr_lists'] = $this->httpClient->sendRequest('POST','search-mr', [
            'full_name' => $request->input('full_name'),
            'company_id' => $request->input('company_id'),
            'product' => $request->input('product'),
            'city' => $request->input('city'),
        ]);
//        dd($data['mr_lists']);
        $data['company'] = $this->companyList();
        return view('mr_lists')->with($data);
    }


    public function services(){
        return view('services');
    }


    public function download(){
        return view('download');
    }


    public function about(){
        return view('about');
    }


    public function contact(){
        return view('contact');
    }


}