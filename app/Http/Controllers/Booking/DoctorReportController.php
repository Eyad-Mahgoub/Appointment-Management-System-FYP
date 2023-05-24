<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use PDF;

class DoctorReportController extends Controller
{
    public function downloadReport(Appointment $app)
    {
        $pdf = PDF::loadView('Layouts.pdf.report', compact('app'));
        return $pdf->download('report.pdf');
    }
}
