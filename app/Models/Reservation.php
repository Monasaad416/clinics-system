<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $table = 'reservations';
    public $timestamps = true;
    protected $fillable = ['branch_id','client_id', 'time', 'date', 'doctor_id',
     'status', 'type', 'insurance', 'insurance_percentage','insurance_discount',
     'notes', 'payment_method_id' ,'final_price' 
     ,'appointment_notes','sub_specialist_id','specialist_id','number'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
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




    public function services()
    {
        return $this->belongsToMany('App\Models\Service')->withTimestamps();
    }

    public function payment()
    {
        return $this->morphOne('App\Models\ClientPayment', 'paymentable');
    }

}
