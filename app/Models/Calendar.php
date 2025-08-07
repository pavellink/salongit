<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    public function shifts()
    {
        return $this->hasMany(Shifts::class , 'day_id', 'id');
    }

    protected $fillable = [
        'day',
        'month',
        'year',
        'day_of_week',
    ];
}
