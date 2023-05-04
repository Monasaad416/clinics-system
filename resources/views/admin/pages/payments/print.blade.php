
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
                            <h1 class="invoice-title">سند صرف</h1>
                            <div class="billed-from">
                                
                                   @if($payment->salariable_type  == 'App\Models\Doctor')
                                    <h4>بيانات الطبيب</h4>
                                    <h6>الأسم: {{ App\Models\Doctor::where('id',$payment->salariable_id)->first()->name_ar}}</h6>
                                    <p>المهنة : طبيب<p>
                                    <p>التخصص : {{ App\Models\Doctor::where('id',$payment->salariable_id)->first()->specialist->name_ar}}</p>
                                    <p>الهاتف : {{ App\Models\Doctor::where('id',$payment->salariable_id)->first()->phone}}</p>
                                    <p> البريد الإلكتروني{{ App\Models\Doctor::where('id',$payment->salariable_id)->first()->email}}</p>
                                    <p> الفرع : {{ App\Models\Doctor::where('id',$payment->salariable_id)->first()->branch->name_ar}}</p>
                    
                                @else
                                <h4>بيانات الموظف</h4>
                                   <h6>الإسم: {{ App\Models\User::where('id',$payment->salariable_id)->first()->name}}</h6>
                                   <p>المهنة : موظف</p>
                                   <p>الهاتف: {{ App\Models\User::where('id',$payment->salariable_id)->first()->phone}}</p>
                                   <p> البريد الإلكتروني: {{ App\Models\User::where('id',$payment->salariable_id)->first()->email}}</p>
                                   <p>الفرع : {{ App\Models\User::where('id',$payment->salariable_id)->first()->branch->name_ar}}</p>
                                   <p> القسم : {{ App\Models\User::where('id',$payment->salariable_id)->first()->department->name_ar}}</p>
                                
                                @endif
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600">معلومات سند الصرف</label>
          
                                <p class="invoice-info-row"><span>تاريخ السند</span>
                                    <span>{{Carbon\Carbon::parse($payment->created_at)->format('d M ,Y')}}</span></p>

                                 <p class="invoice-info-row"><span>تفاصيل السند</span>
                                    <span>{{$payment->details}}</span></p>

                                    <p class="invoice-info-row"><span>المبلغ </span>
                                    <span>{{$payment->amount}} جنيه</span></p>
                               
                            </div>
                        </div>
                        {{-- <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">المنتج</th>
                                        <th class="wd-40p">العدد</th>
                                        <th class="wd-40p">الوحدة</th>
                                        <th class="tx-center">سعر الوحدة</th>
                                        <th class="tx-center">الإجمالي</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $invoiceItems = DB::table('client_invoice_product')->where('client_invoice_id', $invoice->id)->get();
                                    @endphp
                                    @foreach ( $invoiceItems as $item)
                                                 <tr>
                                        <td>1</td>

                                        <td class="tx-12">{{ App\Models\Product::where('id',$item->product_id)->first()->product_name;}}</td>
                                        <td class="tx-12">{{ $item->qty }}</td>
                                          <td class="tx-12">{{ App\Models\Product::where('id',$item->product_id)->first()->unit;}}</td>
                                        <td class="tx-center">{{ number_format($item->product_price, 2) }}</td>
                                        {{-- <td class="tx-right">{{ number_format($invoice->commission_amount, 2) }}</td> --}}
{{-- 
                                        <td class="tx-center">{{ number_format($item->qty * $item->product_price, 2) }}</td>

                                    </tr>

                                    @endforeach --}}


                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">#</label>

                                            </div><!-- invoice-notes -->
                                                {{-- <tr>
                                        <td class="tx-right"> قيمة الضريبة</td>
                                        <td class="tx-right" colspan="2">{{ $invoice->total_inc_vat*0.14 }}</td>
                                    </tr> --}}

                                    {{-- <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">الإجمالي شامل الضريبة</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format($invoice->total_inc_vat, 2) }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">المبلغ المدفوع  </td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format($invoice->part_paid_inc_vat, 2) }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">المبلغ المتبقي  </td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ number_format($invoice->total_inc_vat - $invoice->part_paid_inc_vat, 2) }}</h4>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> --}} 
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

