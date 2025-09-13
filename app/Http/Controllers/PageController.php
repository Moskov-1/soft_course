<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function index(){
        return redirect()->route('courses.index');
        // return view("pages.index");
    }
}
