<?php

namespace App\Http\Controllers\DoctorApp;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {

        // dd(date('h:i A', strtotime('now')));
        $appointments = Appointment::where('doctor_id', Auth::user()->details->id)->where('date', date('Y-m-d', strtotime('now')))->get()->sortBy('slot');
        // $app = Appointment::find(3);
        // dd($app->perscriptions);
        $medicines = Medicine::all();
        $app = Appointment::find(3);
        // dd(!$app->report);
        return view('DoctorApp.index', compact('appointments', 'medicines'));
    }

    public function conclude(Appointment $appointment)
    {
        $appointment->status = 'complete';
        $appointment->save();

        return redirect()->back()->with(['message' => 'Appointment Complete']);
    }
}
