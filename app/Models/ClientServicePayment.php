<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientServicePayment extends Model
{
    use HasFactory;

    protected $guarded = [ 'id','created_at','updated_at'];

        public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
        public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }

        public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

        public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }


        public function subSpecialist()
    {
        return $this->belongsTo(SubXpecialist::class);
    }

            public function service()
    {
        return $this->belongsTo(Service::class);
    }

}