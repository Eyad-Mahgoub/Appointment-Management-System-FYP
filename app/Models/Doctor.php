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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }
}
