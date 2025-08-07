<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Bonuses extends Model
{
    protected $table = 'bonuses';

    protected $fillable = [
        'user_id',
        'order_id',
        'title',
        'count',
        'status_id',
        'finish_at',
        'created_at',
    ];
}
