<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllPostController extends Controller
{
    public function index(Request $req){

    	return $req->all();
    	///return view('all-post');
    }
}
