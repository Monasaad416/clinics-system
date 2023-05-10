
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
                            <h1 class="invoice-title">فاتورة عميل</h1>
                            <div class="billed-from">
                                <h6>{{ $reservation->client->name }}</h6>
                                <p>{{ $reservation->client->address }}<br>
                                    {{ $reservation->client->phone }}<br>
                                   {{ $reservation->client->email }}</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600">معلومات الفاتورة</label>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>{{ $reservation->number }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الفاتورة</span>
                                    <span>{{Carbon\Carbon::parse($reservation->date)->format('d M ,Y')}}</span></p>
                                <p class="invoice-info-row"><span>الفرع</span>
                                    <span>{{ $reservation->branch->name_ar }}</span></p>
                                <p class="invoice-info-row"><span>الطبيب</span>
                                    <span>{{ $reservation->doctor->name_ar }}</span></p>
                                <p class="invoice-info-row"><span>التخصص الرئيسي</span>
                                    <span>{{ $reservation->doctor->specialist->name_ar }}</span></p>
                                 <p class="invoice-info-row"><span>التخصص الفرعي</span>
                                    <span>{{ $reservation->subSpecialist->name_ar }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0 ">
                                <thead>
                                    <tr>
                                    <th class="wd-40p">سعر الكشف</th>
                                        @if($reservation->type == 'first_visi')
                                            <th class="wd-40p">{{ number_format($reservation->doctor->fees) }}</th>
                                        @else
                                            <th class="wd-40p">{{ number_format(0.00) }}</th>
                                        @endif
                                    </tr>
                                    <tr>   
                                        <th class="wd-40p">سعر الكشف بعد الخصم</th>
                                        @if($reservation->doctor->discount_fees > 0)
                                                @if($reservation->type == 'first_visi')
                                            <th class="wd-40p">{{ number_format($reservation->doctor->fees) }}</th>
                                        @else
                                            <th class="wd-40p">{{ number_format(0.00) }}</th>
                                        @endif>  
                                         @endif
                                    </tr> 
                                    <tr>
                                        <th class="wd-40p">شركة التأمين</th>
                                        @if($reservation->insurance)
                                                <th class="wd-40p">{{ $reservation->insurance }}</th>
                                            @else
                                                <th class="wd-40p">لا يوجد</th>
                                        @endif
                                    </tr>

                                    <tr>
                                        <th class="wd-20p">نسبة تحمل التأمين </th>
                                        @if($reservation->insurance_percentage > 0)
                                            <th class="wd-40p">{{ number_format($reservation->insurance_percentage) }}%</th>
                                            @else
                                            <th class="wd-40p">{{ number_format(0) }}%</th>
                                        @endif
                                    </tr>   
                                    <tr>
                                        <th class="wd-20p">خصم التأمين علي الكشف</th>
                                        @if($reservation->insurance_discount > 0)
                                            <th class="wd-40p">{{ number_format($reservation->insurance_discount) }}</th>
                                        @else
                                            <th class="wd-40p">{{ number_format(0) }}</th>
                                        @endif
                                    </tr> 
                                    @php
                                        $servicePrice = 0;
                                        foreach ($reservation->services as $service){
                                            $price = $service->price;
                                            $servicePrice += $price;
                                        }
                                    @endphp
                                    @foreach ($reservation->services as $service)
                                        <tr>
                                            <th class="wd-20p">{{ $service->name_ar}}</th>
                                            <th class="wd-40p">{{ $service->price }}</th>
                                        </tr> 
                                    @endforeach

                                    <tr>
                                        <th class="wd-20p">خصم التأمين علي الخدمات الإضافية</th>
                                        @if($reservation->insurance_discount > 0)
                                            <th class="wd-40p">{{ number_format($servicePrice - ($servicePrice*$reservation->insurance_discount/100)) }}</th>
                                        @else
                                            <th class="wd-40p">{{ number_format(0) }}</th>    
                                        @endif
                                    </tr> 

                                    <tr>

                                    <th class="wd-20p">الإجمالي </th>
                                        <th class="wd-40p">{{ number_format($reservation->final_price) }}</th>
                                    </tr> 

                                    <th class="wd-20p "  style="background: rgb(218, 215, 215)">الإجمالي شامل الضريبة </th>
                                        <th class="wd-40p" style="background: rgb(218, 215, 215)">{{ number_format($reservation->final_price * 1.14) }}</th>
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

