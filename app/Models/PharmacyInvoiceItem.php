<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyInvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'pharmacy_invoice_items';

    protected $fillable = [
        'invoice_id',
        'medicine_id',
        'price'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(PharmacyInvoice::class, 'invoice_id', 'id');
    }
}
