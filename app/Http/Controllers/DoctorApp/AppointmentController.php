<?php

namespace App\Http\Controllers\DoctorApp;

use App\Enums\AppointmentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {

        $appointments = Appointment::where('doctor_id', Auth::user()->details->id)->where('date', date('Y-m-d', strtotime('now')))->get()->sortBy('slot');
        $medicines = Medicine::all();

        return view('DoctorApp.index', compact('appointments', 'medicines'));
    }

    public function conclude(Appointment $appointment)
    {
        $appointment->status = AppointmentStatusEnum::COMPLETE;
        $appointment->save();

        return redirect()->back()->with(['message' => 'Appointment Complete']);
    }
}
