<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function welcome(){
        return view('welcome');
    }
}
