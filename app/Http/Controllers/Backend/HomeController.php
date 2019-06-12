<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BackendController;

class HomeController extends BackendController
{
    public function index()
    {
        return view('home');
    }
}
