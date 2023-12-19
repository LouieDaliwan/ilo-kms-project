<?php

namespace App\Http\Controllers;

class ShowAppPage extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
