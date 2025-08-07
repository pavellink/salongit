<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItems extends Model
{
    protected $table = 'order_items';

    public function service(){
        return $this->hasOne(Services::class, 'id', 'item_id');
    }

    protected $fillable = [
        'order_id',
        'item_id',

        'title',
        'products',
        'price',
        'count',
        'total_services',
        'total',
        'mins',
        'created_by',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
