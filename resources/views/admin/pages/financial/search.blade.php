@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
		<!-- row -->
       <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> إجمالي الكشوفات</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ $fees }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">مستحقات التأمين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="insurance">{{ $insurance }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">سندات الصرف </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="payments">{{ $payments }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">صافي الدخل </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="net">{{ $net }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- row closed -->

@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
                     
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    
									@if($doctor && $from && $to)
									    <h4 class="card-title mg-b-0">قائمة الكشوفات الفعلية للطبيب <span class="text-primary">  {{  $doctor->name_ar }}</span> عن الفترة من <span class="text-primary">{{ $from }} الي <span class="text-primary">{{ $to }}</h4>
                                    @elseif( $doctor )  
                                     <h4 class="card-title mg-b-0">قائمة الكشوفات الفعلية للطبيب <span class="text-primary">  {{  $doctor->name_ar }}</span> </h4>
                                    @elseif($branch)
                                      <h4 class="card-title mg-b-0">قائمة الكشوفات الفعلية لفرع <span class="text-primary">  {{  $branch->name_ar }}</span> </h4>
                                    @elseif($branch && $from && $to)
									    <h4 class="card-title mg-b-0">قائمة الكشوفات الفعلية لفرع <span class="text-primary">  {{  $branch->name_ar }}</span> عن الفترة من <span class="text-primary">{{ $from }} الي <span class="text-primary">{{ $to }}</h4>
                                    @elseif($specialist)  
                                     <h4 class="card-title mg-b-0">قائمة الكشوفات الفعلية للتخصص <span class="text-primary">  {{  $specialist->name_ar }}</span> </h4>
                            
                                    @else
                                        <h4 class="card-title mg-b-0">قائمة الكشوفات الفعلية لكل الأفرع عن الفترة من <span class="text-primary">{{ $from }} الي <span class="text-primary">{{ $to }}</h4>
                                    @endif

								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
					

							<div class="row my-5">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الفرع</th>
                                                <th>العميل</th>
                                                <th>الطبيب</th>
                                                <th>التخصص</th>
                                                <th>مبلغ الكشف</th>
												<th>مبلغ الكشف بعد التخفيض</th>
												<th>نسبة تحمل التأمين %</th>
												<th>مستحقات التأمين للكشف</th>
                                                <th>الخدمات الإضافية</th>
                                                
												<th>صافي مبلغ الكشف</th>
												{{-- <th>طباعة</th> --}}
											</tr>
										</thead>
										<tbody>
                                            @foreach ($reservations as $reservation )
                                                <tr>
													@php
														$status = $reservation->status;
														if($status == 'pending') {
															$status = 'حجز موعد';
														} elseif ($status == "completed") {
															$status = 'اتم الزيازة';
														} elseif ($status == 'canceled') {
															$status = 'إلغاء الموعد' ;
														} elseif($status == 'absent') {
															$status = 'لم يحضر ';
														}

													   $type = $reservation->type;
														if($type == 'first_visit') {
															$type = "كشف جديد";
														} elseif ($type == 'sec_visit') {
															$type = "إستشارة";
														}
													@endphp
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $reservation->branch->name_ar }}</td>
													<td>{{ $reservation->client->name }}</td>
													<td>{{ $reservation->doctor->name_ar}}</td>
                                                    <td>{{ $reservation->specialist->name_ar}}</td>
													<td>{{ $reservation->doctor->fees }}</td>
													<td>{{ $reservation->doctor->discount_fees }}</td>
													<td>{{ $reservation->insurance_percentage }}</td>
													<td>{{ $reservation->insurance_discount}}</td>
                                                    @if($reservation->services)
                                                    <td>
                                                        @foreach ($reservation->services as $service )
                                                            <tr>{{ $service->name_ar }}</tr>
                                                        @endforeach
                                                    </td>
                                                    @else
                                                    <td>لايوجد</td>
                                                    @endif
                                                    
													@if($reservation->doctor->discount_fees > 0 )
													<td>{{ $reservation->doctor->discount_fees - $reservation->insurance_discount}}</td>
													@else
													<td>{{ $reservation->doctor->fees - $reservation->insurance_discount}}</td>
													@endif


                                        
                                                </tr>
                                            @endforeach


										</tbody>
									</table>
								</div>
						    </div>



							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <script>
        function myFunction() {
            var Amount_Commission = parseFloat(document.getElementById("commission_amount").value);
            var Discount = parseFloat(document.getElementById("discount").value);
            // var Rate_VAT = parseFloat(document.getElementById("rate_vat").value);
            var Value_VAT = parseFloat(document.getElementById("value_vat").value);
            var Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('Please enter commission amount');
            } else {
                var intResults = Amount_Commission2 * 14 / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("value_vat").value = sumq;
                document.getElementById("total").value = sumt;
            }
        }
    </script>



{{-- 
<script type="text/javascript">
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $(".btn-submit").click(function(e){
    
        e.preventDefault();
     
        var brach_id = $("#branch_id").val();
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
     
        $.ajax({
           type:'GET',
           url:"{{ route('admin.finantial.reservations-income') }}",
           data:"json",
           success:function(data){
                if($.isEmptyObject(data.error)){
                    alert(data.success);
                    location.reload();
                }else{
                    printErrorMsg(data.error);
                }
           }
        });
    });
  
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
  
</script> --}}
@endsection

