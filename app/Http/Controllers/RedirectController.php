<?php

namespace App\Http\Controllers;

class RedirectController extends Controller
{
    public function home()
    {
        return redirect()->route('home');
    }

    public function dashboard()
    {
        return redirect()->route('dashboard');
    }
}
