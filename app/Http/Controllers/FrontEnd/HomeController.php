<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("FrontEnd.home");
    }

    public function doctors()
    {
        return view('FrontEnd.doctors');
    }

    public function services()
    {
        return view('FrontEnd.services');
    }

    public function aboutus()
    {
        return view('FrontEnd.about-us');
    }
}
