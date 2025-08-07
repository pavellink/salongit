<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BonusLvl extends Model
{
    protected $table = 'bonus_lvl';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
