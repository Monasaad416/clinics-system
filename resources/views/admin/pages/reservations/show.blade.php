@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تفاصيل الحجز رقم {{ $reservation->number }} </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الحجوزات  </span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                <!-- row -->
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body h-100">
                            <div class="row row-sm ">
                                <div class="text-right col">
                                    <h4 class="product-title mb-1">رقم الحجز : {{ $reservation->number }}</h4>

                                    <p class="product-description">اسم العميل: </p>

									<h6 >هاتف العميل :<span class="text-danger">{{ $reservation->client->phone }}</span></h6>
                                    <p class="product-description"> تاريخ الميلاد: {{ Carbon\Carbon::parse($reservation->client->date_of_birth)->format('d M ,Y')}}</p>
                                    <p class="product-description"> العمر: {{ Carbon\Carbon::parse($reservation->client->date_of_birth)->age}}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    		<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>البند</th>
                                                <th>التفاصيل </th>

											</tr>
										</thead>
										<tbody>
                    
                                                <tr>
                                                    <td> رقم الحجز</td>
                                                    <td>{{ $reservation->number }}</td>
                                                </tr>

                                                    <td>العميل</td>
													<td>{{ $reservation->client->name }}</td>
                                                </tr>

                                                </tr>
                                                    <td>الهاتف</td>
													<td>{{ $reservation->client->phone }}</td>
                                                </tr>
                                                <tr>
                                                     <td>تاريخ الميلاد</td>
                                                    <td>{{ Carbon\Carbon::parse($reservation->client->date_of_birth)->format('d M ,Y')}}</td>
                                                </tr>
                                                    
													<tr>
                                                         <td>العمر</td>
                                                        <td>{{ Carbon\Carbon::parse($reservation->client->date_of_birth)->age}}سنة</td></tr>
                                                    <tr>
                            
													<tr>
                                                        <td>إسم الطبيب</td>
                                                        <td>{{ $reservation->doctor->name_ar }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>التخصص الرئيسي  </td>
                                                        <td>{{ $reservation->specialist->name_ar }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>التخصص الفرعي </td>
                                                        <td>
                                                            @if ($reservation->subSpecialist)
                                                                {{ $reservation->subSpecialist->name_ar }}
                                                            @else
                                                                <p>لا يوجد</p>    
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>سعر الكشف </td>
                                                        <td>{{ $reservation->doctor->fees }}</td>
                                                    </tr>

                                                     <tr>
                                                        <td>سعر الكشف في حالة وجود خصم </td>
                                                        <td>{{ $reservation->doctor->fees }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>توقيت الحجز</td>
                                                        <td>{{ $reservation->time }}</td>
                                                    </tr>

                                                             <tr>
                                                        <td>يوم الحجز</td>
                                                        <td>{{ $reservation->date}}</td>
                                                    </tr>
                                        
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

                                                    <tr>
                                                        <td>حالة الحجز </td>
                                                        <td>{{ $status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>كشف / إستشارة </td>
                                                        <td>{{ $type }}</td>
                                                    </tr>
                                                             <tr>
                                                        <td>الشركة التي تم الحجز بواسطتها </td>
                                                        @if($reservation->services)
                                                        <td>
                                                            {{ $reservation->company->name }}
                                                        </td>
                                                        @else
														<td>لا يوجد</td>
													@endif
                                                    </tr>
                                                    <tr>
                                                        <td>ملاحظات </td>
                                                        @if($reservation->notes)
                                                            <td>{{ $reservation->notes }}</td>
                                                        @else
                                                            <td>لايوجد</td>
                                                        @endif
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td>طريقة الدفع </td>
                                                        @if($reservation->payment_method_id)
                                                            <td>{{ $reservation->paymentMethod->name_ar }}</td>
                                                        @else
                                                            <td>لايوجد</td>
                                                        @endif
                                                    </tr>
                            
                                                    <tr>
                                                        <td>إجمالي الكشف </td>
                                                        <td>{{ $reservation->final_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الموعد المقترح من العميل(إن وجد)</td>
                                                        <td>{{ $reservation->appointment_notes }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>طباعة الفاتورة</td>	
                                                        <td>
														    <a href="{{route('admin.reservations.print',$reservation->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="طباعة فاتورة للعميل"><i class="fa fa-print" aria-hidden="true"></i></a>
														</td>
                                                    </tr>


	
											

												
				


                          
                          


										</tbody>
									</table>
								</div>
							</div>
                </div>
            </div>
            <!-- /row -->


        </div>
        <!-- Container closed -->
    </div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
