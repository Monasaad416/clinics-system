<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    protected $table = 'doctors';
    public $timestamps = true;
    protected $guarded = ['id','created_at', 'updated_at'];
    const MALE = 1;
    const FEMALE = 2;

    public function label()
    {
        return match($this->gender)
        {
            self::MALE => 'ذكر',
            self::FEMALE => 'أنثي',
            default => 'unknown',
        };
    }

    public static function getGender(){
        return [
                self::MALE,
                self::FEMALE,
            ];
    }

    public function doctorTitle()
    {
        return $this->belongsTo('App\Models\DoctorTitle');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }


    public function professionalTitle()
    {
        return $this->belongsTo('App\Models\ProfessionalTitle');
    }

       public function specialist()
    {
        return $this->belongsTo('App\Models\Specialist');
    }

    // public function appointments()
    // {
    //     return $this->hasMany('App\Models\DoctorAppointment');
    // }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

       public function appoinments()
    {
        return $this->hasMany('App\Models\Appoinment');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imagable');
    }

    public function offers()
    {
        return $this->belongsToMany('App\Models\Offer');
    }

    public function subSpecialists()
    {
        return $this->belongsToMany('App\Models\SubSpecialist')->withTimestamps();
    }

    public function salary()
    {
        return $this->morphOne('App\Models\Salary', 'salariable');
    }


    public function days()
    {
        return $this->belongsToMany('App\Models\Day','doctor_day')->withPivot([
            'from','to','no_of_reservations','id'
        ])->withTimestamps();
    }

}
