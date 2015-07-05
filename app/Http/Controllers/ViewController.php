<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    public function home()
    {
        return view('flex.dashboard');
    }
}
