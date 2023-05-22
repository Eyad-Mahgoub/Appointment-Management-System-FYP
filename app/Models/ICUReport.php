<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICUReport extends Model
{
    use HasFactory;

    protected $table = 'icureports';

    protected $fillable = [
        'start_date',
        'end_date'
    ];
}
