<?php

namespace App\Exports;

use App\Models\ServiceBooking;
use App\Exports\ClientServicePaymentsExport;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientServPaymentBranchExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ServiceBooking::all();
    }
}
