<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    protected $table = 'orders';

    public function items()
    {
        return $this->hasMany(OrderItems::class , 'order_id', 'id');
    }

    public function service(){
        return $this->hasOne(Services::class , 'id', 'item_id');
    }

    protected $fillable = [
        'day_id',
        'pre_id',
        'user_id',
        'user_name',
        'user_phone',
        'date',
        'in_progress',
        'created_by',
        'created_at',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
