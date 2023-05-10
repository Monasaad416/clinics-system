@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الخدمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الخدمات الرئيسية </span>
						</div>
					</div>
			
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
									<h4 class="card-title mg-b-0">قائمة الخدمات </h4>
                                    @can('services-create')
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.services.create")}}">إضافة خدمة</a></button>
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
												<th>الخدمة</th>
                                                @can('services-show')
                                                <th>تفاصيل الخدمة</th>
                                                @endcan
                                                <th>التخصص </th>
                                                @can('services-edit')
                                                <th>تحديث</th>
                                                @endcan
                                                @can('services-delete')
                                                <th>حذف</th>
                                                @endcan
											</tr>
										</thead>
										<tbody>
                                            @foreach ($services as $service )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $service->name_ar }}</td>
                                                    @can('services-show')
                                                        <td>
                                                            {{ $service->description_ar }}
                                                        </td>
                                                    @endcan


                                                    <td>
                                                        {{ $service->specialist->name_ar }}
                                                    </td>
                                            
                                     
                                                    @can('services-edit')
                                                    <td>
                                                        <a href="{{route('admin.services.edit',$service->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث الخدمة"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>
                                                    @endcan

                                                    @can('services-delete')
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_service{{ $service->id }}" title="حذف الخدمة"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('admin.services.destroy',$service)}}" method="POST">
                                                            <div class="modal fade" id="delete_service{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف الخدمة من قائمة الخدمات</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف الخدمة الرئيسية   {{$service->name_ar}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$service->id}}" name="id">
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
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
