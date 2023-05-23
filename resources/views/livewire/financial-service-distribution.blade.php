	<div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> إجمالي الخدمات بعد خصم التامين واي خصم إضافي </h6>

                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ number_format($serviceBookings->sum('final_price'),2) }} جنيه</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">عدد الخدمات المحجوزه</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="insurance">{{ $serviceBookings->count() }}  كشف</h4>
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
                            <h6 class="mb-3 tx-12 text-white">ارباح الاطباء </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ number_format($doctorsProfits,2) }}جنيه</h4>
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
                            <h6 class="mb-3 tx-12 text-white">ارباح الموظفين </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ number_format($employeesProfits,2) }}جنيه</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-secondary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">ارباح الشركات </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ number_format($companiesProfits,2) }}جنيه</h4>
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
                            <h6 class="mb-3 tx-12 text-white">ارباح العيادة </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ number_format($clinicsProfits,2) }}جنيه</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>



   
      
        </div>


		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">قائمة الايرادات  بناءا علي الخدمات الفعليه </h4>

				{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
			</div>
			<div class="card-body">
				<div>
                    <div class="row my-5">

                        <div class="col">
                            <label for="">بحث بالفرع</label>
                            <select wire:model="branch_id" class="form-control" id="branch_id" value="{{ old('branch_id') }}" >
                                <option value="">-- إختر الفرع--</option>
                                @foreach($branches as $branch)
                                    <option value ="{{$branch->id}}">{{$branch->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="">بحث بالتخصص الرئيسي </label>
                            <select wire:model="specialist_id" class="form-control" id="specialist_id" value="{{ old('specialist_id') }}" >
                                <option value="">-- إختر التخصص--</option>
                                @foreach($specialists as $specialist)
                                    <option value ="{{$specialist->id}}">{{$specialist->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>


                            <div class="col">
                                <label for="">بحث بالطبيب   </label>
                                <select wire:model="doctor_id" class="form-control" id="doctor_id" value="{{ old("doctor_id") }}" >
                                    <option value="">-- إختر الطبيب--</option>
                                        @if (!is_null($branch_id) || !is_null($specialist_id))
                                            @foreach($doctors as $doctor)
                                            <option value ="{{$doctor->id}}">{{$doctor->name_ar}}</option>
                                            @endforeach
                                        @endif


                                </select>
                            </div>

                            
                            <div class="col">
                                <label for="">بحث بالموظف   </label>
                                <select wire:model="employee_id" class="form-control" id="doctor_id" value="{{ old("doctor_id") }}" >
                                    <option value="">-- إختر الموظف--</option>
                                    @if (!is_null($branch_id))
                                        @foreach($employees as $user)
                                        <option value ="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>


                        <div class="col">
                            <label for="">بحث من تاريخ</label>
                            <input type="date" wire:model="from_date" class="form-control" id="from">
                        </div>
                        <div class="col">
                            <label for="">بحث إلي تاريخ</label>
                            <input type="date" wire:model="to_date" class="form-control" id="to" >
                        </div>


                    </div>
				</div>

			<div class="row my-5">
				<div class="table-responsive">
					<table class="table table-hover mb-0 text-md-nowrap">
						<thead>
							<tr>
								<th>#</th>
								<th>رقم الخدمة</th>
                                <th>إجمالي المبلغ</th>
                                <th>ارباح الطبيب</th>
                                <th>ارباح الموظف</th>
                                <th>ارباح الشركة</th>
                                <th>ارباح العيادة</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($serviceBookings as $serviceBooking )
								<tr>
									@php

									@endphp
									<th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="{{ route('admin.services_bookings.show',$serviceBooking->id) }}">{{ $serviceBooking->number }}</a></td>
                                    <td>{{ $serviceBooking->branch->name_ar }}</td>
                                    <td>{{ $serviceBooking->final_price}}</td>
                                    <td>{{App\Models\DoctorProfit::where('doctor_id',$serviceBooking->doctor_id)->where('service_booking_id',$serviceBooking->id)->first() ?
                                     App\Models\DoctorProfit::where('doctor_id',$serviceBooking->doctor_id)->where('service_booking_id',$serviceBooking->id)->first()->amount : 0}}</td>
                                    <td>{{App\Models\CompanyProfit::where('company_id',$serviceBooking->company_id)->where('service_booking_id',$serviceBooking->id)->first() ?
                                     App\Models\CompanyProfit::where('company_id',$serviceBooking->company_id)->where('service_booking_id',$serviceBooking->id)->first()->amount :0}}</td>
                                    <td>{{App\Models\ClinicProfit::where('branch_id',$serviceBooking->branch_id)->where('service_booking_id',$serviceBooking->id)->first() 
                                    ? App\Models\ClinicProfit::where('branch_id',$serviceBooking->branch_id)->where('service_booking_id',$serviceBooking->id)->first()->amount : 0}}</td>
								</tr>
							@endforeach


						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>




