<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'speciality_id',
    ];

    public function account()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'id', 'speciality_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }
}
