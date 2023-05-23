<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\User;
use Database\Factories\DoctorFactory;
use DateTime;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // $specs = Speciality::factory()->count(10)->create();
        // $doctors = Doctor::factory()->count(20)->create();

        $a = new DateTime(date('H:s'));
        $b = new DateTime('2023-05-24 08:00');
        $interval = $a->diff($b);

        dd($a, $b, $interval, $interval->format("%H") );
        // dd($specs);
        return view('test.test', compact('specs'));
    }

    public function test(Request $request)
    {
        return Speciality::find($request->id)->doctors;
    }

    public function testdoc(Request $request)
    {
        $todate = date("Y-m-d");
        $apps = Appointment::where('doctor_id', $request->id)->where('status', 'pending')->get();
        $data = [
            date('Y-m-d', strtotime($todate. ' + 1 days')) => [
                1 => ['status' => '', 'times' => '8am - 10am'],
                2 => ['status' => '', 'times' => '10am - 12pm'],
                3 => ['status' => '', 'times' => '12am - 2pm'],
                4 => ['status' => '', 'times' => '2pm - 5pm'],
            ],
            date('Y-m-d', strtotime($todate. ' + 2 days')) => [
                1 => ['status' => '', 'times' => '8am - 10am'],
                2 => ['status' => '', 'times' => '10am - 12pm'],
                3 => ['status' => '', 'times' => '12am - 2pm'],
                4 => ['status' => '', 'times' => '2pm - 5pm'],
            ],
            date('Y-m-d', strtotime($todate. ' + 3 days')) => [
                1 => ['status' => '', 'times' => '8am - 10am'],
                2 => ['status' => '', 'times' => '10am - 12pm'],
                3 => ['status' => '', 'times' => '12am - 2pm'],
                4 => ['status' => '', 'times' => '2pm - 5pm'],
            ],
            date('Y-m-d', strtotime($todate. ' + 4 days')) => [
                1 => ['status' => '', 'times' => '8am - 10am'],
                2 => ['status' => '', 'times' => '10am - 12pm'],
                3 => ['status' => '', 'times' => '12am - 2pm'],
                4 => ['status' => '', 'times' => '2pm - 5pm'],
            ],
        ];

        foreach ($apps as $app)
        {
            if (isset($data[$app->date]))
            {
                $data[$app->date][$app->slot]['status'] = 'booked';
            }
        }

        return $data;
    }

    public function testapp(Request $request)
    {

        Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => 1,
            'date' => $request->date,
            'slot' => $request->slot,
        ]);

        return $request;
        //return Speciality::find($request->id)->doctors;
    }
}
