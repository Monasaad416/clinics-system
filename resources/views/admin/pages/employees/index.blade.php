@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الموظفين</span>
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
									<h4 class="card-title mg-b-0">قائمة الموظفين</h4>

                                        @can('employees-create')
										<button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.employees.create")}}">إضافة موظف</a></button>
                                        @endcan
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الإسم</th>
												<th>الوظيفة</th>
												<th>الراتب</th>
                                                <th>الصورة الشخصية</th>
                                                 {{-- <th>تاريخ الإلتحاق </th> --}}
												 @can('dashboard')
												 	<th>الفرع  </th>
												 @can('employees-edit')
												    <th>تحديث</th>
												 @endcan
													@can('employees-delete')
                                                    <th>حذف مؤقت</th>
													<th>أستعادة </th>
													<th>حذف نهائي </th>
													@endcan
												 @endcan

											</tr>
										</thead>
										<tbody>

                                            @foreach ($employees as $emp )
											  <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $emp->name }}</td>
                                                    <td>{{ $emp->department->name_ar}}</td>
													@if( $emp->salary)
                                                    <td>{{ $emp->salary}}</td>
													@else
													<td>0</td>
													@endif

                                                    <td>
                                                        @if($emp->image  )
                                                            <img src="{{ asset('uploads/employees').'/' . $emp->image}}" width="50px" alt ="{{ $emp->name }}">
                                                        @else
                                                            <p>لا يوجد</p>
                                                        @endif
                                                    </td>

                                                    {{-- <td>{{Carbon\Carbon::parse($emp->created_at)->format('d M ,Y')}}</td> --}}

                                                    @can('dashboard')
													 <td>{{ $emp->branch->name_ar}}</td>
                                                    @can('employees-edit')
													    <td>
                                                            <a href="{{route('admin.employees.edit',$emp->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث بينات الموظف"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                        </td>
                                                    @endcan
													@can('employees-delete')

														<td>
															@if(!$emp->trashed())
																<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#delete_employee{{ $emp->id }}" title="حذف مؤقت "><i class="fa fa-trash"></i></button></td>
																			<!-- Delete Modal -->
																<form action="{{route('admin.employees.destroy',$emp)}}" method="POST">
																	<div class="modal fade" id="delete_employee{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">حذف مؤقت لموظف من قائمة الموظفين</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																			</div>
																			<div class="modal-body">
																				<p>هل انت متأكد من الحذف المؤقت للموظف  {{$emp->name}}</p>

																					@csrf
																					{{method_field('delete')}}
																					<input type="hidden" value="{{$emp->id}}" name="id">
																					<div class="modal-footer">
																						<button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
																						<button type="submit" name="submit" class="btn btn-danger">حذف</button>
																					</div>
																			</div>
																		</div>
																		</div>
																	</div>
																</form>
																</div>

															@endif
														</td>

														@if($emp->trashed())
                                                            <td>
																<button type="button" class="btn btn-success btn-sm d-inline" data-toggle="modal" data-target="#restore_employee{{ $emp->id }}" title="إستعادة الموظف"><i class="fa fa-window-restore" aria-hidden="true"></i></button>
																<!-- restore Modal -->
																<form action="{{route('admin.employees.restore',$emp)}}" method="POST">
																	<div class="modal fade" id="restore_employee{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">إستعادة موظف إلي  قائمة الموظفين</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																			</div>
																			<div class="modal-body">
																				<p>هل انت متأكد من إستعادة الموظف  {{$emp->name}}</p>
																					@csrf

																					<input type="hidden" value="{{$emp->id}}" name="id">
																					<div class="modal-footer">
																						<button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
																						<button type="submit" name="submit" class="btn btn-success">إستعادة</button>
																					</div>
																			</div>
																		</div>
																		</div>
																	</div>
																</form>
                                                            </td>
                                                        @else
                                                            <td>---</td>
                                                        @endif
                                                        @if($emp->trashed())
                                                            <td>
																<!-- Parmenent Delete Modal -->
															    <button type="button" class="btn btn-danger btn-sm d-inline" data-toggle="modal" data-target="#destroy_employee{{ $emp->id }}" title="حذف نهائي"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
																			<!-- Delete Modal -->
																<form action="{{route('admin.employees.parmenent_delete',$emp)}}" method="POST">
																	<div class="modal fade" id="destroy_employee{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">حذف موظف نهائيا من قائمة الموظفين</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																			</div>
																			<div class="modal-body">
																				<p>هل انت متأكد من حذف الموظف نهائيا  {{$emp->name}}</p>

																					@csrf

																					<input type="hidden" value="{{$emp->id}}" name="id">
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
                                                        @else
                                                            <td>---</td>

														@endif

												    @endcan

													@endcan

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
                <div class="d-flex justify-content-center align-items-center">
					{{ $employees->links() }}
				</div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
