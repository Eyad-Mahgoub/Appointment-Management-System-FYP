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
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function report()
    {
        return $this->belongsTo(DoctorReport::class, 'report_id', 'id');
    }
    public function perscriptions()
    {
        return $this->hasMany(Perscription::class);
    }

    public function getDayAttribute()
    {
        $appDate = date('m-d-Y', strtotime($this->date));
        $appDatestr = strtotime($this->date);
        $today = date('m-d-Y', strtotime('now'));
        $tomorrow = date('m-d-Y', strtotime('tomorrow'));

        if ($today == $appDate) return 'Today';
        else if ($tomorrow == $appDate) return 'Tomorrow';
        else if ( $today != $appDate && $tomorrow != $appDate) return date('jS M, Y', $appDatestr);
        else return 'error';
    }

    public function getTimeAttribute()
    {
        switch ($this->slot) {
            case 1:
                return '08:00 AM to 10:00 AM';
                break;
            case 2:
                return '10:00 AM to 12:00 PM';
                break;
            case 3:
                return '12:00 PM to 2:00 PM';
                break;
            case 4:
                return '02:00 PM to 05:00 PM';
                break;
            default:
                return 'error';
                break;
        }
    }
}
