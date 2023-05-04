@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة العملاء</span>
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
									<h4 class="card-title mg-b-0">قائمة العملاء</h4>
									@can('clients-create')
                    					<button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.clients.create")}}">إضافة عميل</a></button>
									@endcan
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
								    @if($clients->count()>0)
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الإسم</th>
												<th>رقم الملف</th>
												<th>البريد الإلكتروني </th>
												<th>الهاتف </th>
                                                <th>تاريخ الميلاد</th>
												<th>العمر</th>
                                                <th>كيف تعرفت علينا</th>
												<td>لهاتف</td>
                                                <th> تاريخ التسجيل</th>
												@can('clients-edit')
                                                	<th>تحديث</th>
												@endcan
												@can('clients-delete')
                                                	<th>حذف</th>
												@endcan
											</tr>
										</thead>
										<tbody>


												@foreach ($clients as $client )
													<tr>
														<th scope="row">{{ $loop->iteration }}</th>
														<td>{{ $client->name }}</td>
														<td>{{ $client->file_no}}</td>
														<td>{{ $client->email}}</td>
														<td>{{ $client->phone}}</td>
														<td>{{ Carbon\Carbon::parse($client->date_of_birth)->format('d M ,Y')}}</td>
														<td>{{ Carbon\Carbon::parse($client->date_of_birth)->age}}سنة</td>
                                                        @php
                                                            $method = $client->how_know_us;
                                                            if($method == 1) {
                                                                $method = 'Facebook ';
                                                            } elseif ($method == 2) {
                                                                $method = ' Instagram';
                                                            } elseif ($method == 3) {
                                                                $method = 'Twitter ' ;
                                                            } elseif($method == 4) {
                                                                $method = 'اخري  ';
                                                            }
                                                        @endphp
														<td>{{ $method}}</td>
														<td>{{ $client->phone}}</td>
														<td>{{Carbon\Carbon::parse($client->created_at)->format('d M ,Y')}}</td>
														<td>
															<a href="{{route('admin.clients.edit',$client->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
														</td>
														<td>
															<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_clientloyee{{ $client->id }}" title="حذف"><i class="fa fa-trash"></i></button></td>
															<!-- Delete Modal -->
															<form action="{{route('admin.clients.destroy',$client)}}" method="POST">
																<div class="modal fade" id="delete_clientloyee{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">حذف عميل من قائمة العملاء</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																		</div>
																		<div class="modal-body">
																			<p>هل انت متأكد من حذف العميل   {{$client->name}}</p>

																				@csrf
																				{{method_field('delete')}}
																				<input type="hidden" value="{{$client->id}}" name="id">
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

									@else 
										<tr>
											<p>لايوجد عملاء مسجلة للعرض</p>
										</tr>
									@endif
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->

                <div class="d-flex justify-content-center align-items-center">
					{{ $clients->links() }}
				</div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
