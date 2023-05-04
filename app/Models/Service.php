<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $table = 'services';
    public $timestamps = true;
    protected $fillable = ['name_en', 'name_ar','description_ar','description_en','image','slug','price','branch_id'];

    // public function subServices()
    // {
    //     return $this->hasMany('App\Models\SubService');
    // }
    public function branch()
    {
        return $this->belongsTo(App\Models\Branch::class);
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
