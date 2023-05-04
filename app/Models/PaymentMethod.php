<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    protected $table = 'payment_methods';
    public $timestamps = true;
    protected $fillable = ['name_en','name_ar','slug'];

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

}
