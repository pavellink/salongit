<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sets extends Model
{
    protected $table = 'sets';

    public function items(){
        return $this->hasMany(SetItems::class, 'set_id', 'id');
    }

    public function service(){
        return $this->hasOne(Services::class, 'id', 'service_id');
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
