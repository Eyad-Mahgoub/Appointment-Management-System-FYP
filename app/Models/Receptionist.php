<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    use HasFactory;

    protected $table = 'receptionists';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function account()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
