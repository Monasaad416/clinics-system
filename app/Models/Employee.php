<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $table = 'employees';
    public $timestamps = true;
    protected $fillable = ['name', 'phone', 'email', 'password', 'image', 'salary', 'department_id','roles_name','salary'];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }


      protected $casts = [
        'roles_name' => 'array',
    ];

}
