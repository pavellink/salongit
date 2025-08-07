<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    protected $table = 'services';

    public function parent(){
        return $this->hasOne(Services::class, 'id', 'parent_id');
    }

    public function subs(){
        return $this->hasMany(Services::class, 'parent_id', 'id');
    }

    public function sets(){
        return $this->hasMany(Sets::class, 'service_id', 'id');
    }

    public function setService(){
        return $this->hasMany(SetServices::class, 'service_id', 'id');
    }

    public function setItems(){
        return $this->hasMany(SetItems::class, 'service_id', 'id');
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
