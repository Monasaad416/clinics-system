<div>
    			<!-- row opened -->
				<div>
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">تقرير مجمع للارباح والخسائر  </h4>
                                       
                                        {{-- <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button> --}}
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
                                <div>

                                    @php
                                        $specialists = App\Models\Specialist::all();
                                    @endphp
                                    <div class="row my-5">

                                        <div class="col">
                                            <label for="">بحث بالتخصص الرئيسي </label>
                                            <select wire:model="specialist_id" class="form-control" name="specialist_id" value="{{ old('specialist_id') }}" >
                                                <option value="">-- إختر التخصص--</option>
                                                @foreach($specialists as $specialist)
                                                    <option value ="{{$specialist->id}}">{{$specialist->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="">بحث بالطبيب   </label>
                                            <select wire:model="doctor_id" class="form-control" name="doctor_id" value="{{ old("doctor_id") }}" >
                                                <option value="">-- إختر الطبيب--</option>
                                                @if ( !is_null($specialist_id))
                                                    @foreach($doctors as $doctor)
                                                        <option value ="{{$doctor->id}}">{{$doctor->name_ar}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="">بحث بالموظف </label>
                                            <select wire:model="employee_id" class="form-control" name="employee_id" value="{{ old("employee_id") }}" >
                                                <option value="">-- إختر الموظف--</option>

                                                    @foreach(App\Models\User::where('branch_id',auth()->user()->branch_id)->get() as $user)
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

								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>

												<th> البند</th>
												<th>إجمالي المبلغ </th>
											</tr>
										</thead>
										<tbody>
                                            <tr>
                                                <td>صافي مبلغ الكشوفات </td>
                                                <td>{{ $reservations }}</td>
                                            </tr>

                                            <tr>
                                                <td>صافي مبلغ الخدمات </td>
                                                <td>{{ $serviceBookings }}</td>
                                            </tr>

                                            <tr>
                                                <td>إجمالي أذونات الصرف</td>
                                                <td>{{ $payments }}</td>
                                            </tr>

                                            <tr>
                                                <td>ارباح الاطباء</td>
                                                <td>{{ $doctorsProfits }}</td>
                                            </tr>

                                            <tr>
                                                <td> اذونات صرف الاطباء </td>
                                                <td>{{ $doctorsPayments }}</td>
                                            </tr>


                                            <tr>
                                                <td> أرباح الموظفين</td>
                                                <td>{{ $employeesProfits }}</td>
                                            </tr>


                                            <tr>
                                                <td> اذونات صرف الموظفين </td>
                                                <td>{{ $employeesPayments }}</td>
                                            </tr>


                                            <tr>
                                                <td> أرباح الشركات</td>
                                                <td>{{ $companiesProfits }}</td>
                                            </tr>



                                            <tr>
                                                <td> أرباح العيادة</td>
                                                <td>{{ $clinicsProfits }}</td>
                                            </tr>


                                            <tr>
                                                <td> اذونات صرف اخري </td>
                                                <td>{{ $otherPayments }}</td>
                                            </tr>

										</tbody>
									</table>
								</div>


							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->

			</div>
</div>
