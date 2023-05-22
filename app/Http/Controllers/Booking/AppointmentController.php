<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $specs = Speciality::all();
        return view('Bookings.index', compact('specs'));
    }

    public function myapps()
    {
        return view('Bookings.mybookings');
    }
}
