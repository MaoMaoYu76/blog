<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ninicontroller extends Controller
{
    function nini($name = null) {
        return view('nini',compact('name'));
    }

    function create(){
        return view('create');
    }

    function store(Request $request){
        return view('store',compact('request'));
    }
}
