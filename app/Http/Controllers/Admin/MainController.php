<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class MainController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
