<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'specialities';

    protected $fillable = [
        'name',
        'short_description',
        'description',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'doctor_id', 'id');
    }
}
