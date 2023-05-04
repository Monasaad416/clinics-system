<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{


    const FACEBOOK = 1;
    const INSTAGRAM = 2;
    const TWITTER = 3;
    const OTHER = 4;

    public function label()
    {
        return match($this->gender)
        {
            self::FACEBOOK => 'فيس بوك',
            self::INSTAGRAM => 'أنستاجرام',
            self::TWITTER => 'تويتر',
            self::OTHER => 'اخري',
            default => 'unknown',
        };
    }

    public static function getMethod(){
        return [
            self::FACEBOOK,
            self::INSTAGRAM,
            self::TWITTER ,
            self::OTHER ,
            ];
    }

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = ['name', 'phone', 'email',  'date_of_birth','address', 'how_know_us', 'file_no','branch_id'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
