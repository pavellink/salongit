<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetItems extends Model
{
    protected $table = 'set_items';

    public function product(){
        return $this->hasOne(Items::class, 'id', 'item_id');
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
