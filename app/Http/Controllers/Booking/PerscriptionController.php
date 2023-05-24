<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use PDF;

class PerscriptionController extends Controller
{
    public function downloadPerscription(Appointment $app)
    {
        $pdf = PDF::loadView('Layouts.pdf.perscription', compact('app'));
        return $pdf->download('perscription.pdf');
    }
}
