<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerscriptionResource;
use App\Models\Appointment;
use App\Models\Perscription;
use Illuminate\Http\Request;
use PDF;

class PerscriptionController extends Controller
{
    public function downloadPerscription(Appointment $app)
    {
        $pdf = PDF::loadView('Layouts.pdf.perscription', compact('app'));
        return $pdf->download('perscription.pdf');
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'appt_id' => ['required'],
            'medicine_id' => ['required'],
            'dosage' => ['required'],
        ]);

        $perscription = Perscription::create([
            'appointment_id' => $data['appt_id'],
            'medicine_id' => $data['medicine_id'],
            'dosage' => $data['dosage'],
        ]);


        return redirect()->back()->with(['message' => 'Medicine Registered Successfully']);
    }

    public function get(Appointment $appointment)
    {
        return PerscriptionResource::collection($appointment->perscriptions);
    }

    public function delete(Perscription $perscription)
    {
        try {
            $perscription->delete();
            return redirect()->back()->with(['message' => 'Entry Deleted']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error_message' => 'Invalide ID']);
        }
    }
}
