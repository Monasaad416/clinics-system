<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $table = 'appointments';
    public $timestamps = true;
    protected $fillable = ['doctor_id', 'from', 'to', 'day_id','no_of_reservations'];

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
    // public function day()
    // {
    //     return $this->belongsTo('App\Models\Doctor');
    // }


}
