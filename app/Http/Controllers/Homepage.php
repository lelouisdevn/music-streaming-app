<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class Homepage extends Controller
{
    public function welcome(){
        if (Session::get('UserId')){
            return redirect::to('/play');
        }else {
            return view('welcome');
        }
    }
}
