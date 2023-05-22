<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('Bookings.index');
    }

    public function myapps()
    {
        return view('Bookings.mybookings');
    }
}
