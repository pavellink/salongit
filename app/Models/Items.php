<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items extends Model
{
    protected $table = 'items';

    public function subs()
    {
        return $this->hasMany(Items::class , 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Items::class , 'id', 'parent_id')->whereNull('parent_id');
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
