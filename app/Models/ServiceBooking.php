<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

        protected $guarded = ['id','created_at', 'updated_at'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }


    public function clientServicePayment()
    {
        return $this->belongsTo('App\Models\ClientServicePayment');
    }


    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

        public function service()
    {
        return $this->belongsTo('App\Models\Service');
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


    public function user()
    {
        return $this->belongsTo('App\Models\User');
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


    public function payment()
    {
        return $this->morphOne('App\Models\ClientPayment', 'paymentable');
    }
}
