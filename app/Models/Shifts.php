<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shifts extends Model
{
    protected $table = 'shifts';

    public function user()
    {
        return $this->hasOne(User::class , 'id', 'master_id');
    }

    // список мастеров на смену
    public function users()
    {
        return $this->hasMany(User::class , 'id', 'master_id');
    }

    public function day()
    {
        return $this->hasOne(Calendar::class , 'id', 'day_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class , 'shift_id', 'id');
    }

    protected $fillable = [
        'day_id',
        'master_id',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
