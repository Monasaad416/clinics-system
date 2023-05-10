
@extends('admin.layout.master')
@section('css')
    <style>
        @media print {
            #print_button {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
             <div class="invoice-header">
                            <h1 class="invoice-title" style="color:rgb(136, 174, 240);">
                                <img src="{{asset('web/assets/img/logo_wc.png')}}" width="120px">
                             </h1>
                                     <div class="billed-from">

                                <h1 class="invoice-title">فاتورة عميل</h1>

                  

                            </div>

                               <div class="col-md-2">
                                <label class="tx-gray-600">معلومات المريض</label>
                                <p class="invoice-info-row"><span>الإسم </span>
                                    <span>{{ $payment->reservation->client->name }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الميلاد</span>
                                    <span>{{ Carbon\Carbon::parse($payment->reservation->client->date_of_birth)->format('d M ,Y')}}</span></p>
                                <p class="invoice-info-row"><span>العمر</span>
                                    <span>{{ Carbon\Carbon::parse($payment->reservation->client->date_of_birth)->age}}سنة</span></p>
                                <p class="invoice-info-row"><span>الهاتف</span>
                                    <span>{{$payment->reservation->client->phone }}</span></p>
                                <p class="invoice-info-row"><span>البريد الإلكتروني</span>
                                    <span>{{ $payment->reservation->client->email }}</span></p>

                            </div>
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600">معلومات الفاتورة</label>
                                <p class="invoice-info-row"><span>رقم الحجز</span>
                                    <span>{{ $payment->reservation->number }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الفاتورة</span>
                                    <span>{{Carbon\Carbon::parse($payment->created_at)->format('d M ,Y')}}</span></p>
                                <p class="invoice-info-row"><span>الفرع</span>
                                    <span>{{ $payment->branch->name_ar }}</span></p>
                                <p class="invoice-info-row"><span>الطبيب</span>
                                    <span>{{ $payment->reservation->doctor->name_ar }}</span></p>
                                <p class="invoice-info-row"><span>التخصص </span>
                                    <span>{{ $payment->reservation->specialist->name_ar }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0 ">
                                <thead>
                                    <tr>
                                    <th class="wd-40p">مبلغ الفاتوره</th>
                                        <th class="wd-40p">{{ number_format($payment->amount) }}</th>
                                    </tr>

                                    <tr>
                                        <th class="wd-20p">نسبة تحمل التأمين </th>
                                        @if($payment->reservation->insurance_percentage > 0)
                                            <th class="wd-40p">{{ number_format($payment->reservation->insurance_percentage) }}%</th>
                                            @else
                                            <th class="wd-40p">{{ number_format(0) }}%</th>
                                        @endif
                                    </tr> 
                                    @php 
                                    $insuranceAmount = $payment->amount * $payment->reservation->insurance_percentage /100; 
                                    $total = $payment->amount - $insuranceAmount;
                                    @endphp 

                                    <th class="wd-40p">المبلغ المتبقي للعيادة</th>
                                        <th class="wd-40p">{{ number_format($payment->remaining_amount) }}</th>
                                    </tr>

                                    
                                    <th class="wd-40p">مبلغ الخصم  </th>
                                        <th class="wd-40p">{{ number_format($payment->discount) }}</th>
                                    </tr>

                                    <th class="wd-20p "  style="background: rgb(218, 215, 215)">الإجمالي شامل الضريبة </th>
                                        <th class="wd-40p" style="background: rgb(218, 215, 215)">{{ number_format($payment->amount * 1.14) }}</th>
                                    </tr>
                     
                                </thead>
                  
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_button" onclick="printDiv()"> <i
                                class="fas fa-print ml-1"></i>Print</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->

@endsection
@section('js')
 



    <script>
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            
            location.reload();
        }
    </script>

@endsection

