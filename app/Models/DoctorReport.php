<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorReport extends Model
{
    use HasFactory;

    protected $table = 'doctor_reports';

    protected $fillable = [
        'diagnosis',
        'icureport_id'
    ];

    public function icureport()
    {
        return $this->belongsTo(ICUReport::class, 'icureport_id', 'id');
    }

}
