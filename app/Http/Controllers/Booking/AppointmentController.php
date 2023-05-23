<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Speciality;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $specs = Speciality::all();
        return view('Bookings.index', compact('specs'));
    }

    public function getSpecDoctors(Request $request)
    {
        return Speciality::find($request->id)->doctors;
    }

    public function getDocAppointments(Request $request)
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

    public function create(Request $request)
    {
        Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => 1,
            'date' => $request->date,
            'slot' => $request->slot,
        ]);

        return $request;
    }

    public function myapps()
    {
        return view('Bookings.mybookings');
    }
}
