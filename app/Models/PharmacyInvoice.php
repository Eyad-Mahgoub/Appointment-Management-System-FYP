<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyInvoice extends Model
{
    use HasFactory;

    protected $table = 'pharmacy_invoices';

    protected $fillable = [
        'appointment_id',
        'pharmacist_id',
        'total_price'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }

    public function pharmacist()
    {
        return $this->belongsTo(Pharmacist::class, 'pharmacist_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(PharmacyInvoiceItem::class, 'invoice_id', 'id');
    }
}
