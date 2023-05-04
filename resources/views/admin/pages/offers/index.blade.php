@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العروض</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة العروض </span>
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
									<h4 class="card-title mg-b-0">قائمة العروض</h4>
									@can('offers-create')
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.offers.create")}}">إضافة عرض</a></button>
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
												<th>العنوان</th>
                                                <th>من تاريخ</th>
                                                <th>إلي تاريخ</th>
                                                <th>السعر الأصلي </th>
                                                <th> سعر العرض</th>
                                                <th>نسبة الخصم</th>
                                                <th>الفرع</th>
												@can('offers-show')
													<th>التفاصيل</th>
												@endcan
												@can('offers-edit')
													<th>تحديث</th>
												@endcan
												@can('offers-delete')
													<th>حذف</th>
												@endcan
											</tr>
										</thead>
										<tbody>
                                            @foreach ($offers as $offer )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $offer->title_ar }}</td>
                                                    <td>{{ $offer->from_date }}</td>
                                                    <td>{{ $offer->to_date }}</td>
                                                    <td>{{ $offer->price }}</td>
                                                    <td>{{ $offer->discount_price }}</td>
                                                    <td>{{ $offer->discount_percentage }}</td>
                                                    <td>{{ $offer->branch->name_ar}}</td>
                                                    <td>
                                                        <a href="{{route('admin.offers.show',$offer->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="تفاصيل العرض "><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
                                                    </td>

													@can('offers-edit')
                                                    <td>
                                                        <a href="{{route('admin.offers.edit',$offer->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث العرض"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>
													@endcan
													@can('offers-delete')
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_offer{{ $offer->id }}" title="حذف العرض"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('admin.offers.destroy',$offer)}}" method="POST">
                                                            <div class="modal fade" id="delete_offer{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف العرض من قائمة العروض</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف العرض   {{$offer->title_ar}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$offer->id}}" name="id">
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
					{{ $offers->links() }}
				</div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
