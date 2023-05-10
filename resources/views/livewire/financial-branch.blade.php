	<div >

        @php
            $branch_id = auth()->user()->branch_id;
        @endphp

        <div class="row row-sm">
            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> إجمالي الكشوفات بعد خصم التأمين</h6>

                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="total">{{ number_format($fees) }}جنيه</h4>
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
                            <h6 class="mb-3 tx-12 text-white">عدد الكشوفات</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="insurance">{{ $reservations->count() }}كشف</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
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
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="insurance">{{ number_format($totalInsurance) }}جنيه</h4>

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
                            <h6 class="mb-3 tx-12 text-white">سندات الصرف </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="payments">{{ number_format($paymentsAmount) }}جنيه</h4>
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
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white" id="net">{{ number_format($net) }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
		<div class="card">
			<div class="card-header pb-0">
		
			<div class="card-body">
				<div>

						<div class="row muy-5">

							<div class="col">
								<label for="">بحث بالتخصص الرئيسي </label>
								<select wire:model="specialist_id" class="form-control" id="specialist_id" value="{{ old('specialist_id') }}" >
									<option value="">-- إختار التخصص--</option>
									@foreach($specialists as $specialist)
										<option value ="{{$specialist->id}}">{{$specialist->name_ar}}</option>
									@endforeach
								</select>
							</div>

                            @if ( !is_null($specialist_id))
                                <div class="col">
                                    <label for="">بحث بالطبيب   </label>
                                    <select wire:model="doctor_id" class="form-control" id="doctor_id" value="{{ old("doctor_id") }}" >
                                        <option value="">-- إختار الطبيب--</option>
                                            @foreach($doctors as $doctor)
                                            <option value ="{{$doctor->id}}">{{$doctor->name_ar}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            @endif

                                <div class="col">
                                    <label for="">بحث بالموظف   </label>
                                    <select wire:model="employee_id" class="form-control" id="employee_id" value="{{ old("employee_id") }}" >
                                        <option value="">-- إختار الموظف--</option>
                                            @foreach(App\Models\User::where('branch_id',$branch_id)->get() as $user)
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
                <div class="d-flex justify-content-between ">
					<h4 class="card-title my-2">قائمة الايرادات  بناءا علي الكشوفات الفعلية لفرع <span class="text-danger">{{ App\Models\Branch::where('id',$branch_id)->first()->name_ar }}</span> </h4>
			    </div>
				<div class="table-responsive">
					<table class="table table-hover mb-0 text-md-nowrap">
						<thead>
							<tr>
								<th>#</th>
								<th>الفرع</th>
								<th>المعاملة</th>
								<th>دخل / مصروف</th>
								{{-- <th>العميل</th>
								<th>الطبيب</th>
								<th>مبلغ الكشف</th>
								<th>مبلغ الكشف بعد التخفيض</th>
								<th>نسبة تحمل التأمين</th>
								<th>مستحقات التأمين</th> --}}
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
									<td>كشف</td>
									<td>دخل</td>

									<td>{{ $reservation->final_price}}</td>

								</tr>
							@endforeach


						</tbody>
					</table>
				</div>
			</div>


            {{-- <div class="row my-5">
                <div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">قائمة المصروفات  لفرع <span class="text-danger">{{ App\Models\Branch::where('id',$branch_id)->first()->name_ar }}</span> </h4>
			    </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الموظف / الطبيب</th>
                                <th>المهنة </th>
                                <th>البند</th>
                                <th>المبلغ</th>>
                            </tr>
                        </thead>
                        <tbody>
                 
                            @foreach ($payments as $payment )
      
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    @if($payment->salariable_type == 'App\Models\Doctor')
                                        <td>
                                            {{App\Models\Doctor::where('id',$payment->salariable_id)->first()->name_ar }}
                                        </td>
                                        <td>
                                            <span class="text-success">طبيب</span>
                                        </td>
                                    @else
                                        <td>{{App\Models\User::where('id',$payment->salariable_id)->first()->name}}</td>
                                        <td><span class="text-info">موظف</span></td>
                                    @endif
                                        <td>{{ $payment->details }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    
                           
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
			</div> --}}




			</div>
		</div>


	</div>

