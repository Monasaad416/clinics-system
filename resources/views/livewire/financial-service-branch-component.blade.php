	<div>
        <div class="row row-sm">
            <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
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
            <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">عدد الخدمات المحجوزة</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="insurance">{{ $serviceBookings->count() }}  خدمة</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> الخدمات الإضافية بعد خصم التأمين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ number_format($netServices) }}جنيه</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}
            <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">مستحقات التأمين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="insurance">{{ number_format($serviceBookings->sum('insurance_discount'),2) }} جنيه</h4>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{-- 
            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">أذونات الصرف </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="payments">{{ number_format($payments) }} جنيه</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">صافي الدخل </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="net"> جنيه</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}
        </div>


		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">قائمة الايرادات  بناءا علي الخدمات الفعليه </h4>

				<button class="btn btn-primary"><a class="x-small text-white" wire:click="servicesBranch" >تصدير إلي إكسيل</a></button>
			</div>
			<div class="card-body">
				<div>
                    <div class="row my-5">

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
                                   
                                        @foreach(App\models\User::where('branch_id',auth()->user()->branch_id)->get() as $user)
                                        <option value ="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                               

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
								<th>رقم حجز الخدمة</th>
                       
								<th>صافي مبلغ الخدمة بعد الخصومات     </th>
								{{-- <th>طباعة</th> --}}
							</tr>
						</thead>
						<tbody>
							@foreach ($serviceBookings as $booking )
								<tr>
									<th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="{{ route("admin.services_bookings.show",$booking->id) }}">{{ $booking->number }}</a></td>
 
				

									<td>{{ $booking->final_price}}</td>




								</tr>
							@endforeach


						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>




