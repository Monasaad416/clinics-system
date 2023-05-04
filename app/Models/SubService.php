<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{

    protected $table = 'sub_service';
    public $timestamps = true;
    protected $fillable = ['service_id', 'name_en','name_ar' ,'slug','price', 'description'];

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

 
}
