@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">أذونات الصرف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
						</div>
					</div>
					{{-- <div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div> --}}
				</div>
				<!-- breadcrumb -->
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
									<h4 class="card-title mg-b-0">قائمة أذونات الصرف</h4>
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.payments.create")}}">إضافة سند صرف</a></button>
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("payments_vouchers.excel")}}">تصدير إلي إكسيل</a></button>
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
							    <div>
                                    @php
                                        $specialists = App\Models\Specialist::all();
                                        $branches = App\Models\Branch::all();
                                    @endphp
                                    <form method="get" action="{{route('admin.search.payments')}}">
                                    <div class="row my-5">
                                        
                                            @csrf

                                            <div class="col">
                                                <label for="">بحث بالفرع</label>
                                                <select name="branch_id" class="form-control" id="branch_id" value="{{ old('branch_id') }}">
                                                    <option value="">-- إختر الفرع--</option>
                                                    @foreach($branches as $branch)
                                                        <option value ="{{$branch->id}}">{{$branch->name_ar}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="">بحث بالتخصص الرئيسي </label>
                                                <select name="specialist_id" class="form-control" id="specialist_id" value="{{ old('specialist_id') }}">
                                                    <option value="">-- إختر التخصص--</option>
                                                    @foreach($specialists as $specialist)
                                                        <option value ="{{$specialist->id}}">{{$specialist->name_ar}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col">
                                                <label for="">بحث بالطبيب   </label>
                                                <select name="doctor_id" class="form-control" id="doctor_id" value="{{ old("doctor_id") }}">
                                                    <option value="">-- إختر الطبيب--</option>

                                                </select>
                                            </div>



                                            <div class="col">
                                                <label for="">بحث بالموظف </label>
                                                <select name="employee_id" class="form-control" id="employee_id" value="{{ old("employee_id") }}">
                                                    <option value="">-- إختر الموظف--</option>
                                                        @php
                                                            $employees = App\Models\User::all();
                                                        @endphp
                                                        @foreach($employees as $user)
                                                        <option value ="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>


                                            <div class="col">
                                                <label for="">بحث من تاريخ</label>
                                                <input type="date" name="from_date" class="form-control" id="from" >
                                            </div>
                                            <div class="col">
                                                <label for="">بحث إلي تاريخ</label>
                                                <input type="date" name="to_date" class="form-control" id="to">
                                            </div>

                                            <div class="col my-3">
                                                <button type="submit" class="btn btn-primary">بحث</button>
                                            </div>


                                            


                                    </div>
                                    </form>
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
                                                    <td>{{ $payment->amount }}</td>
                                                    <td>{{ $payment->details }}</td>
													@can('dashboard')
                                                        <th>{{ $payment->branch->name_ar }}</th>
													@endcan

                                                    <td>
                                                        <a href="{{route('admin.payments.edit',$payment->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث السند"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_payment{{ $payment->id }}" title="حذف السند"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('admin.payments.destroy',$payment)}}" method="POST">
                                                            <div class="modal fade" id="delete_payment{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف سند الصرف من قائمة الأذونات</h5>
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
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

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
