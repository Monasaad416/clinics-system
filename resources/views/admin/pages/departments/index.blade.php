@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الأقسام </span>
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
									<h4 class="card-title mg-b-0">قائمة الأقسام</h4>
                                    @can('departments-list')
										<button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.departments.create")}}">إضافة قسم</a></button>
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
												<th>القسم</th>
												<th>الفرع</th>
												@can('departments-create')
                                                	<th>تحديث</th>
												@endcan
												@can('departments-delete')
                                                	<th>حذف</th>
												@endcan
											</tr>
										</thead>
										<tbody>
                                            @foreach ($departments as $department )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $department->name_ar }}</td>
													<td>{{ $department->branch->name_ar}}</td>
											
													    <td>
															<a href="{{route('admin.department.edit',$department->slug)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث القسم"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
														</td>

												
                                         
														<td>
															<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_department{{ $department->id }}" title="حذف القسم"><i class="fa fa-trash"></i></button></td>
																		<!-- Delete Modal -->
															<form action="{{route('admin.departments.destroy',$department)}}" method="POST">
																<div class="modal fade" id="delete_department{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">حذف القسم من قائمة الأقسام</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																		</div>
																		<div class="modal-body">
																			<p>هل انت متأكد من حذف القسم   {{$department->name_ar}}</p>

																				@csrf
																				{{method_field('delete')}}
																				<input type="hidden" value="{{$department->id}}" name="id">
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
					{{ $departments->links() }}
				</div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
