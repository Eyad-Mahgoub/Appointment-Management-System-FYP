<?php

namespace App\Http\Controllers\Reception;

use App\Enums\AppointmentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentInvoice;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('date', date('Y-m-d', strtotime('now')))->orderBy('slot')->get();
        return view('Reception.Appointment.index', compact('appointments'));
    }

    public function payment(Appointment $appointment)
    {
        $appointment->is_paid = 1;
        $appointment->save();
        AppointmentInvoice::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $appointment->patient->id,
            'amount' => 100
        ]);
        return redirect()->back()->with(['message' => 'Payment Recieved Successfully']);
    }

    public function cancel(Appointment $appointment)
    {
        $appointment->status = AppointmentStatusEnum::CANCELLED;
        $appointment->save();
        redirect()->back()->with(['message' => 'Appointment Cancelled Successfully']);
    }
}
