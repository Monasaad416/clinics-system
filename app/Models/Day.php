<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $fillable = ['day_en', 'day_ar'];

    public function doctors()
    {
          return $this->belongsToMany('App\Models\Doctor','doctor_day')->withPivot([
            'from','to','no_of_reservations','id'
        ])->withTimestamps();
    }}

