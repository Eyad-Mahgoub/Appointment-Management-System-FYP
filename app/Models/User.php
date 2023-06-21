<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_as' => UserRoleEnum::class,
    ];

    public function details()
    {
        if ($this->role_as == UserRoleEnum::DOCTOR) return $this->hasOne(Doctor::class, 'user_id', 'id');
        if ($this->role_as == UserRoleEnum::PHARMACIST) return $this->hasOne(Pharmacist::class, 'user_id', 'id');
        if ($this->role_as == UserRoleEnum::RECEPTIONIST) return $this->hasOne(Receptionist::class, 'user_id', 'id');
        else return $this->hasOne(Patient::class, 'user_id');
    }
}
