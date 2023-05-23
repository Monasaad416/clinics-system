<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{

    protected $table = 'salaries';
    public $timestamps = true;
    protected $fillable = ['salariable', 'amount','details','branch_id'];

    public function salariable()
    {
        return $this->morphTo();
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

}
