<?php

namespace App\Http\Controllers\Pharmacy;

use App\Enums\AppointmentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\PharmacyInvoice;
use App\Models\PharmacyInvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();
        return view('Pharmacy.Medicine.index', compact('medicines'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
        ]);

        Medicine::create($data);

        return redirect()->back()->with(['message' => 'Quantity Added Successfully']);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'medicine_id' => ['required', 'exists:medicines,id'],
            'qty' => ['required', 'numeric'],
        ]);

        $med = Medicine::find($data['medicine_id']);
        $med->quantity += $data['qty'];
        $med->save();

        return redirect()->back()->with(['message' => 'Quantity Added Successfully']);
    }

    public function delete(Medicine $medicine)
    {
        if (!$medicine) return redirect()->back()->with(['error_message' => 'Medicine with this ID doesnt exist']);
        $medicine->delete();
        return redirect()->back()->with(['message' => 'Medicine Deleted Successfully']);
    }
}
