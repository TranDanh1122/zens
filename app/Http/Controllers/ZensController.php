<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ZensController extends Controller
{
    public function index()
    {
        return view('frontend');
    }
    public function profile()
    {
        return view('profile');
    }
}
