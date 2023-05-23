<?php

namespace App\Exports;

use App\Models\ServiceBooking;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientServPaymentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ServiceBooking::all();
    }
}
