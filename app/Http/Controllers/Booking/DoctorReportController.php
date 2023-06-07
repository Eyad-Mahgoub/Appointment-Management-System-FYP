<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DoctorReport;
use Exception;
use Illuminate\Http\Request;
use PDF;

class DoctorReportController extends Controller
{
    public function downloadReport(Appointment $app)
    {
        $pdf = PDF::loadView('Layouts.pdf.report', compact('app'));
        return $pdf->download('report.pdf');
    }

    public function create(Request $request)
    {
        try {
            $data = $request->validate([
                'appt_id' => ['required'],
                'diagnosis' => ['required'],
            ]);

            $report = DoctorReport::create([
                'diagnosis' => $data['diagnosis'],
            ]);

            $apt = Appointment::find($data['appt_id'])->report()->associate($report);
            $apt->save();

            return redirect()->back()->with(['message' => 'Report Registered Successfully']);
        }
        catch (Exception $e)
        {
            return redirect()->back()->with(['error_message' => 'Something went wrong. Please try again later']);
        }
    }

    public function edit(Appointment $appointment)
    {
        return ['diagnosis' => $appointment->report->diagnosis];
    }

    public function store(Request $request)
    {

    }
}
