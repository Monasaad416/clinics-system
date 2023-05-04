<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorTitle extends Model
{

    protected $table = 'doctor_titles';
    public $timestamps = true;
    protected $fillable = ['name_en','name_ar','slug'];

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }

}
