<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'report_id',
        'date',
        'slot',
        'status'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id', 'doctor_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id', 'patient_id');
    }
    public function report()
    {
        return $this->belongsTo(ICUReport::class, 'id', 'report_id');
    }
    public function prescription()
    {
        return $this->hasMany(Perscription::class, 'id', 'appointment_id');
    }
}
