<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $table = 'services';
    public $timestamps = true;
    protected $fillable = ['name_en', 'name_ar','description_ar','description_en','slug','specialist_id'];

    // public function subServices()
    // {
    //     return $this->hasMany('App\Models\SubService');
    // }
    public function specialist()
    {
        return $this->belongsTo('App\Models\Specialist');
    }

    public function reservations()
    {
        return $this->belongsToMany('App\Models\Reservation')->withTimestamps();
    }


    public function payment()
    {
        return $this->morphOne('App\Models\ClientPayment', 'paymentable');
    }
    protected $casts = [
        'phones' => 'array',
    ];

}
