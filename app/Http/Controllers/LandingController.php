<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing'); // ini akan membuka resources/views/landing.blade.php
    }
}