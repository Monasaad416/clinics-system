<div>
    			<!-- row opened -->
				<div>
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة سندات الصرف</h4>
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.payments.create")}}">إضافة سند صرف</a></button>
                                        <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button>
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
                                            <label for="">بحث بالفرع</label>
                                            <select wire:model="branch_id" class="form-control" name="branch_id" value="{{ old('branch_id') }}" >
                                                <option value="">-- إختار الفرع--</option>
                                                @foreach($branches as $branch)
                                                    <option value ="{{$branch->id}}">{{$branch->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="">بحث بالتخصص الرئيسي </label>
                                            <select wire:model="specialist_id" class="form-control" name="specialist_id" value="{{ old('specialist_id') }}" >
                                                <option value="">-- إختار التخصص--</option>
                                                @foreach($specialists as $specialist)
                                                    <option value ="{{$specialist->id}}">{{$specialist->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        
                                            <div class="col">
                                                <label for="">بحث بالطبيب   </label>
                                                <select wire:model="doctor_id" class="form-control" name="doctor_id" value="{{ old("doctor_id") }}" >
                                                    <option value="">-- إختار الطبيب--</option>
                                                    @if (!is_null($branch_id) || !is_null($specialist_id))
                                                        @foreach($doctors as $doctor)
                                                            <option value ="{{$doctor->id}}">{{$doctor->name_ar}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        


                                        @if (!is_null($branch_id) || !is_null($specialist_id))
                                            <div class="col">
                                                <label for="">بحث بالموظف </label>
                                                <select wire:model="employee_id" class="form-control" name="employee_id" value="{{ old("employee_id") }}" >
                                                    <option value="">-- إختار الموظف--</option>
                                                        @foreach($employees as $user)
                                                        <option value ="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        @endif

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
												<th>#</th>
												<th>الموظف / الطبيب</th>
												<th>المهنة </th>
												<th>البند</th>
                                                <th>المبلغ</th>
												@can('dashboard')
													<th>الفرع</th>
												@endcan
                                                <th>تحديث</th>
                                                <th>حذف</th>
												<th>طباعة</th>
											</tr>
										</thead>
										<tbody>
											{{-- @php
												$payments = App\Models\salary::latest()->paginate(20);
											@endphp --}}
                                            @foreach ($payments as $payment )
											{{-- {{ dd($payment) }} --}}
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
                                                   
													@can('dashboard')
                                                        <th>{{ $payment->branch->name_ar }}</th>
													@endcan

                                                    <td>
                                                        <a href="{{route('admin.payments.edit',$payment->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث الفرع"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_payment{{ $payment->id }}" title="حذف الفرع"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('admin.payments.destroy',$payment)}}" method="POST">
                                                            <div class="modal fade" id="delete_payment{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف سند الصرف من قائمة السندات</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
																				@if($payment->salariable_type == 'App\Models\Doctor')
																					 <p>هل انت متأكد من حذف سند الصرف الخاص ب  {{App\Models\Doctor::where('id',$payment->salariable_id)->first()->name_ar }} </p>
																				@else
																					 <p>هل انت متأكد من حذف سند الصرف الخاص ب  {{App\Models\User::where('id',$payment->salariable_id)->first()->name }} </p>
																				@endif


                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$payment->id}}" name="id">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                                <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
													<td>
														<a href="{{route('admin.payments.print',$payment->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="تحديث الفرع"><i class="fa fa-print" aria-hidden="true"></i></a>
														</td>
                                                </tr>
                                            @endforeach


										</tbody>
									</table>
								</div>


							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
                    <div class="d-flex justify-content-center align-items-center my-5">
                        {{ $payments-> links() }}
                    </div>
			</div>
</div>
