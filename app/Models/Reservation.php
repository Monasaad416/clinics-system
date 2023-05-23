<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $table = 'reservations';
    public $timestamps = true;
    protected $guarded = ['id','created_at', 'updated_at'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }


    public function clientReservationPayment()
    {
        return $this->belongsTo('App\Models\ClientReservationPayment');
    }


    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }


    public function invoice()
    {
        return $this->hasOne('App\Models\Invoice');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }


    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }


    public function subSpecialist()
    {
        return $this->belongsTo('App\Models\SubSpecialist');
    }

  public function specialist()
    {
        return $this->belongsTo('App\Models\Specialist');
    }



    // public function services()
    // {
    //     return $this->belongsToMany('App\Models\Service')->withTimestamps();
    // }

    public function payment()
    {
        return $this->morphOne('App\Models\ClientPayment', 'paymentable');
    }

}
