<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPre extends Model
{
    protected $table = 'order_pre';

    public function user(){
        return $this->hasOne(User::class , 'id', 'user_id');
    }

    public function manager(){
        return $this->hasOne(User::class , 'id', 'manager_id');
    }

    public function service(){
        return $this->hasOne(Services::class , 'id', 'service_id');
    }

    public function status(){
        return $this->hasOne(Statuses::class , 'type', 'status_id')->where('section', 'pre');
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
