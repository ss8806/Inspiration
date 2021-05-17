<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// トップページについて
class TopController extends Controller
{
    public function top()
    {
        return view('top');
    }
}