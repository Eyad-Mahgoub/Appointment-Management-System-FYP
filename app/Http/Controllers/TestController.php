<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Perscription;
use App\Models\Speciality;
use App\Models\User;
use Database\Factories\DoctorFactory;
use DateTime;
use PDf;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', AppointmentStatusEnum::COMPLETE)->where('is_administered', 0)->get();
        return view('Pharmacy.index', compact('appointments'));
    }

    public function test(Request $request)
    {
        return Speciality::find($request->id)->doctors;
    }

    public function testdoc(Request $request)
    {

    }

    public function testapp(Request $request)
    {

    }
}
