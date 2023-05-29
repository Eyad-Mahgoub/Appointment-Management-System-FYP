<?php

namespace App\Http\Controllers\DoctorApp;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {

        // dd(date('h:i A', strtotime('now')));
        $appointments = Appointment::where('doctor_id', Auth::user()->details->id)->where('date', date('Y-m-d', strtotime('now')))->get()->sortBy('slot');
        // dd($appointments);
        return view('DoctorApp.index', compact('appointments'));
    }
}
