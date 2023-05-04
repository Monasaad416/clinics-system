<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = ['title_en','title_ar', 'description_en','description_ar', 'from_date', 'to_date', 'price', 'discount_price', 'discount_percentage','slug','branch_id','image'];

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imagable');
    }

    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }



}
