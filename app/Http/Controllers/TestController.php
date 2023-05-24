<?php

namespace App\Http\Controllers;

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
        $app = Appointment::find(2);
        dd($app, $app->perscriptions);
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
