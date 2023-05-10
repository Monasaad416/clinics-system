<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{

    protected $table = 'specialists';
    public $timestamps = true;
    protected $fillable = ['name_en', 'name_ar','slug','image'];

    public function subSpecialists()
    {
        return $this->hasMany('App\Models\SubSpecialist');
    }

        public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }


        public function services()
    {
        return $this->hasMany('App\Models\Service');
    }


}
