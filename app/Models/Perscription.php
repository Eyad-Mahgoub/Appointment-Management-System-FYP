<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perscription extends Model
{
    use HasFactory;

    protected $table = 'perscriptions';

    protected $fillable = [
        'appointment_id',
        'medicine_id',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'id', 'appointment_id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }


}
