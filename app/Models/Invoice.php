<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table = 'invoices';
    public $timestamps = true;
    protected $fillable = ['invoice_no', 'reservation_id'];

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }

    public function branch()
    {
        return $this->belongsTo(App\Models\Branch::class);
    }

}
