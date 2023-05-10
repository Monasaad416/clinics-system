<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'notes'];


      public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

}
