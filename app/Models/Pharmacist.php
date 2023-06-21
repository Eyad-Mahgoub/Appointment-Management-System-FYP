<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    use HasFactory;

    protected $table = 'pharmacists';

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function account()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
