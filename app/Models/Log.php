<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';

    public function user()
    {
        return $this->hasOne(User::class , 'id', 'created_by');
    }
}
