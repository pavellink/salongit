<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SetServices extends Model
{
    protected $table = 'set_services';

    public function setItems(){
        return $this->hasMany(SetItems::class, 'set_service_id', 'id');
    }

    public function set(){
        return $this->hasOne(Sets::class, 'id', 'set_id');
    }

    protected $fillable = [
        'set_id',
        'service_id',
        'year',
        'day_of_week',
    ];
}
