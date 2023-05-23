@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">حجز الخدمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الحجوزات </span>
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
									<h4 class="card-title mg-b-0">قائمة حجز الخدمات</h4>
									@can('reservations-create')
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.reservations.create")}}">حجز خدمة </a></button>
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
                                                <th>رقم الحجز</th>
												<th>الفرع</th>
                                                <th>العميل</th>
                                                <th>العمر</th>
                                                <th>الهاتف</th>
                                                <th>القائم بالخدمة</th>
                                                <th>التوقيت</th>
												<th>اليوم</th>
												<th>الحالة</th>
												<th>الموعد المقترح من المريض</th>
                                                @can('reservations-edit')
												<th>التفاصيل</th>
												@endcan
												@can('reservations-edit')
												<th>تحديث</th>
												@endcan
												@can('reservations-delete')
												<th>حذف</th>
												@endcan
												<th>المحاسبة </th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($reservations as $reservation )
                                                <tr>
													@php
														$status = $reservation->status;
														if($status == 'pending') {
															$status = 'تم الحجز';
														} elseif ($status == "completed") {
															$status = 'تم تنفيذ الخدمة';
														} elseif ($status == 'canceled') {
															$status = 'إلغاء الخدمة' ;
														} elseif($status == 'absent') {
															$status = 'لم يحضر المريض ';
														}

					
													@endphp
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $reservation->number }}</td>
                                                    <td>{{ $reservation->branch->name_ar }}</td>
													<td>{{ $reservation->client->name }}</td>
													<td>{{ Carbon\Carbon::parse($reservation->client->date_of_birth)->age}}سنة</td>
                                                    <td>{{ $reservation->client->phone }}</td>
													@if($reservation->doc)
													<td>{{ $reservation->doctor->name_ar }}</td>
													<td>{{ $reservation->time }}</td>
													<td>{{ $reservation->date }}</td>
													<td>{{ $status }}</td>



													<td>{{ $reservation->appointment_notes }}</td>

                                                    @can('reservations-edit')
                                                    <td>
                                                        <a href="{{route('admin.reservations.show',$reservation->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="تفاصيل الحجز"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
                                                    </td>
													@endcan
													@can('reservations-edit')
                                                    <td>
                                                        <a href="{{route('admin.reservations.edit',$reservation->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث الحجز"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>
													@endcan
													@can('reservations-delete')

                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_reservation{{ $reservation->id }}" title="حذف الحجز"><i class="fa fa-trash"></i></button></td>
                                                        <!-- Delete Modal -->
                                                        <form action="{{route('admin.reservations.destroy',$reservation)}}" method="POST">
                                                            <div class="modal fade" id="delete_reservation{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف الحجز من قائمة الحجوزات</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف الحجز   {{$reservation->name_ar}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$reservation->id}}" name="id">
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
													@endcan


														{{-- <td>
														<a href="{{route('admin.reservations.print',$reservation->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="طباعة فاتورة للعميل"><i class="fa fa-print" aria-hidden="true"></i></a>
														</td> --}}

                                                        <td>
														   <a href="{{ route('admin.payment_type.select',['reservation_id'=>$reservation->id]) }}" class="btn btn-success btn-sm" role="button" aria-pressed="true" title="المحاسبة المالية للعميل"><i class="fas fa-money-bill-wave"></i></a>
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
                    {{ $reservations-> links() }}
                </div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
