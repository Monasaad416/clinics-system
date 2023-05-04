<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model
{
    use HasFactory;

    protected $fillable = ['paymentable_type','paymentable_id', 'amount','notes','branch_id','payment_method_id','remaining_amount','doctor_id','specialist_id','sub_specialist_id','reservation_id'];

    public function paymentable()
    {
        return $this->morphTo('paymentable', 'paymentable_type', 'paymentable_id','reservation_id');
    }

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

}




