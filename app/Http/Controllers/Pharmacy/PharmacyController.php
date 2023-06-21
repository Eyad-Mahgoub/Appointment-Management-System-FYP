<?php

namespace App\Http\Controllers\Pharmacy;

use App\Enums\AppointmentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PharmacyInvoice;
use App\Models\PharmacyInvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', AppointmentStatusEnum::COMPLETE)->where('is_administered', 0)->get();
        return view('Pharmacy.index', compact('appointments'));
    }

    public function adminster(Appointment $appointment)
    {
        $total = 0;

        $appointment->is_administered = 1;
        $appointment->save();

        $invoice = PharmacyInvoice::create([
            'appointment_id'    => $appointment->id,
            'pharmacist_id'     => Auth::id(),
            'total_price'       => 0
        ]);

        foreach ($appointment->perscriptions as $item)
        {
            $item->medicine->quantity -= 1;
            $item->medicine->save();

            $total += $item->medicine->price;

            PharmacyInvoiceItem::create([
                'invoice_id'    => $invoice->id,
                'medicine_id'   => $item->medicine->id,
                'price'         => $item->medicine->price,
            ]);
        }

        $invoice->total_price = $total;
        $invoice->save();

        return redirect()->back()->with(['message' => 'Prescription Issued Successfully']);

    }
}
