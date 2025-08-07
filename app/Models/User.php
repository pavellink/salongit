<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function bonus_lvl(){
        return $this->hasOne(BonusLvl::class, 'id', 'bonus_lvl_id');
    }

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'full_name',
        'name2',
        'vk_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
