<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $guarded = ['id', 'create_at', 'updated_at'];


    //    protected $casts = [
    //     'phone' => 'array',
    // ];

}
