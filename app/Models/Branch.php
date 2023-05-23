<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $table = 'branches';
    public $timestamps = true;
    protected $fillable = ['name_en', 'name_ar','address_en','address_ar', 'lattitude', 'longitude', 'phones', 'description_en','description_ar','slug'];

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }
    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }
    
    public function employees()
    {
        return $this->hasMany('App\Models\User');
    }

    public function departments()
    {
        return $this->hasMany('App\Models\Department');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }


       public function servicesBookings()
    {
        return $this->hasMany('App\Models\ServiceBooking');
    }

     public function salaries()
    {
        return $this->hasMany('App\Models\Salary');
    }



    
}
