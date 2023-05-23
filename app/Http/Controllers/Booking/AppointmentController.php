<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Speciality;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return '/book';
    }

    public function myapps()
    {
        $appointments = Appointment::where('patient_id', Auth::user()->details->id)->get();
        // dd($appointments);

        return view('Bookings.mybookings', compact('appointments'));
    }

    public function cancelApp(Appointment $app)
    {
        if (!$app) redirect()->back()->with(['fail' => 'Invalid Appointment']);

        $nowtime = new DateTime(date('H:s'));
        $apptime = null;
        switch ($app->slot) {
            case 1:
                $apptime = new DateTime($app->date . ' 08:00');
                break;
            case 2:
                $apptime = new DateTime($app->date . ' 10:00');
                break;
            case 3:
                $apptime = new DateTime($app->date . ' 12:00');
                break;
            case 4:
                $apptime = new DateTime($app->date . ' 14:00');
                break;
            default:
                break;
        }

        $difference = $nowtime->diff($apptime);

        // dd($nowtime, $apptime, $difference, $difference->format("%d"));
        if ($difference->format("%H") > 12 || $difference->format("%d") > 0)
        {
            $app->update([
                'status' => 'cancelled',
            ]);
            return redirect()->back()->with(['success' => 'boleh la']);
        }
        else
        {
            return redirect()->back()->with(['fail' => 'Cannot Cancel Appointment 12 Hours beforehand']);
        }
    }
}
