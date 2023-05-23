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
                            <h6 class="mb-3 tx-12 text-white"> إجمالي الكشوفات بعد خصم التأمين</h6>
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
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">     الخدمات الإضافية بعد خصم التأمين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ $netServices }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">مستحقات التأمين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="insurance">{{ $totalInsurance }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">أذونات الصرف </h6>
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
            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
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
									<h4 class="card-title mg-b-0">قائمة الكشوفات الفعليه </h4>

								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div>
									<form method="GET" action="{{ route('admin.finantial.reservations-search') }}" id="searchForm" >
                                        @csrf
										<div class="row">

											<div class="form-group">
												<label for="">بحث بالفرع</label>
												<select name="branch_id" class="form-control" id="branch_id" value="{{ old('branch_id') }}" >
													<option value="">-- إختر الفرع--</option>
													@foreach($branches as $branch)
														<option value ="{{$branch->id}}">{{$branch->name_ar}}</option>
													@endforeach
												</select>
											</div>

                                            <div class="form-group">
												<label for="">بحث بالتخصص الرئيسي </label>
												<select name="specialist_id" class="form-control" id="specialist_id" value="{{ old('specialist_id') }}" >
													<option value="">-- إختر التخصص--</option>
													@foreach($specialists as $specialist)
														<option value ="{{$specialist->id}}">{{$specialist->name_ar}}</option>
													@endforeach
												</select>
											</div>


                                            <div class="form-group">
												<label for="">بحث بالطبيب إعتمادا<br> علي الفرع والتخصص  </label>
												<select name="doctor_id" class="form-control" id="doctor_id" value="{{ old("doctor_id") }}" >
													<option value="">-- إختر الطبيب--</option>
											
												</select>
											</div>

											<div class="col">
												<label for="">بحث من تاريخ</label>
												<input type="date" name="from" class="form-control" id="from">
											</div>
											<div class="col">
												<label for="">بحث إلي تاريخ</label>
												<input type="date" name="to" class="form-control" id="to" >
											</div>
											<div class="col mt-4">
												<button type="submit" class="btn-submit btn btn-primary">بحث</button>
											</div>

										</div>
									</form>
								</div>

							<div class="row my-5">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الفرع</th>
                                                <th>العميل</th>
                                                <th>الطبيب</th>
                                                <th>مبلغ الكشف</th>
												<th>مبلغ الكشف بعد التخفيض</th>
												<th>نسبة تحمل التأمين</th>
												<th>مستحقات التأمين</th>
												<th>صافي المبلغ بعد خصم مستحقات التأمين </th>
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
													<td>{{ $reservation->doctor->fees }}</td>
													<td>{{ $reservation->doctor->discount_fees }}</td>
													<td>{{ $reservation->insurance_percentage }}</td>
													<td>{{ $reservation->insurance_discount}}</td>
													@if($reservation->doctor->discount_fees > 0 )
													<td>{{ $reservation->doctor->discount_fees - $reservation->insurance_discount}}</td>
													@else
													<td>{{ $reservation->doctor->fees - $reservation->insurance_discount}}</td>
													@endif


                                                    {{-- <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_reservation{{ $reservation->id }}" title="طباعة الفاتورة "><i class="fas fa-print"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('admin.reservations.destroy',$reservation)}}" method="POST">
                                                            <div class="modal fade" id="delete_reservation{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف الحجز من قائمة الحجوزات</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف الحجز   {{$reservation->name_ar}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$reservation->id}}" name="id">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                                <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td> --}}
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
                <div class="d-flex justify-content-center align-items-center">
					{{ $reservations->links() }}
				</div>
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

    
    <script>
    $(document).ready(function () {
            $('select[name="specialist_id"]').on('change', function () {
                var specialist_id = $(this).val();
                var branch_id = $("#branch_id").val();
                console.log(specialist_id);
                console.log(branch_id);


                if (specialist_id) {
                    console.log(specialist_id);
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("/admin/getDoctorsBySpecialistAndBranch") }}/" + specialist_id + "/" + branch_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            console.log(data);
                            $('select[name="doctor_id"]').empty();
                            $('select[name="doctor_id"]').append('<option value="selected disabled">إختر الطبيب </option>');
                            $.each(data, function (key, value) {

                                $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection

