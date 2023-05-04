<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSpecialist extends Model
{

    protected $table = 'sub_specialists';
    public $timestamps = true;
    protected $fillable = ['name_en','name_ar','slug', 'specialist_id', 'image'];

    public function specialist()
    {
        return $this->belongsTo('App\Models\Specialist');
    }

    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor');
    }


       public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

}
