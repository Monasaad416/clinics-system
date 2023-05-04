<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'images';
    public $timestamps = true;
    protected $fillable =['imagable', 'uploads'];

    public function imagable()
    {
        return $this->morphTo()->withTimestamps();
    }

}
