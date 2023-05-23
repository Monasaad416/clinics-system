@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تفاصيل حجز خدمة رقم {{ $serviceBooking->number }} </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الحجوزات  </span>
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
                                                    <td> رقم حجز الخدمة</td>
                                                    <td>{{ $serviceBooking->number }}</td>
                                                </tr>

                                                    <td>العميل</td>
													<td>{{ $serviceBooking->client->name }}</td>
                                                </tr>

                                                </tr>
                                                    <td>الهاتف</td>
													<td>{{ $serviceBooking->client->phone }}</td>
                                                </tr>
                                                <tr>
                                                     <td>تاريخ الميلاد</td>
                                                    <td>{{ Carbon\Carbon::parse($serviceBooking->client->date_of_birth)->format('d M ,Y')}}</td>
                                                </tr>

													<tr>
                                                         <td>العمر</td>
                                                        <td>{{ Carbon\Carbon::parse($serviceBooking->client->date_of_birth)->age}}سنة</td></tr>
                                                    <tr>

													<tr>
                                                        <td>إسم القائم بالخدمة</td>
                                                        
                                                        <td>{{$serviceBooking->doctor ? $serviceBooking->doctor->name_ar : $serviceBooking->user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>التخصص الرئيسي  </td>
                                                        <td>{{ $serviceBooking->specialist->name_ar }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>التخصص الفرعي </td>
                                                        <td>
                                                            @if ($serviceBooking->subSpecialist)
                                                                {{ $serviceBooking->subSpecialist->name_ar }}
                                                            @else
                                                                <p>لا يوجد</p>
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>سعر الخدمة  </td>
                                                        <td>{{ $serviceBooking->service_price }}</td>
                                                    </tr>

                                                     <tr>
                                                        <td>سعر الخدمة بعد الخصومات   </td>
                                                        <td>{{ $serviceBooking->final_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>توقيت الحجز</td>
                                                        <td>{{ $serviceBooking->time }}</td>
                                                    </tr>

                                                             <tr>
                                                        <td>يوم الحجز</td>
                                                        <td>{{ $serviceBooking->date}}</td>
                                                    </tr>

                      
                                                    <tr>
                                                        <td>الشركة التي تم الحجز بواسطتها </td>
                                                        @if($serviceBooking->company_id)
                                                        <td>
                                                            {{ $serviceBooking->company->name }}
                                                        </td>
                                                        @else
														<td>لا يوجد</td>
													@endif
                                                    </tr>
                                                    <tr>
                                                        <td>ملاحظات </td>
                                                        @if($serviceBooking->notes)
                                                            <td>{{ $serviceBooking->notes }}</td>
                                                        @else
                                                            <td>لايوجد</td>
                                                        @endif
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <td>طريقة الدفع </td>
                                                        @if($serviceBooking->payment_method_id)
                                                            <td>{{ $serviceBooking->paymentMethod->name_ar }}</td>
                                                        @else
                                                            <td>لايوجد</td>
                                                        @endif
                                                    </tr>
                                      













										</tbody>
									</table>
								</div>
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
