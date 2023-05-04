@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأطباء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الأطباء</span>
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
									<h4 class="card-title mg-b-0">قائمة الأطباء</h4>
                                    @can('doctors.create')
                                    <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.doctors.create")}}">إضافة طبيب</a></button>
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
												<th>اللقب الوظيفي</th>
												<th>اللقب المهني</th>
                                                <th>الصورة الشخصية</th>
                                                @can('doctors-edit')
                                                    <th>تحديث</th>
                                                @endcan
                                                @can('doctors-delete')
                                                    <th>حذف</th>
                                                @endcan
                                                
                                                
											</tr>
										</thead>
										<tbody>
                                            @foreach ($doctors as $doctor )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $doctor->first_name_ar ." " . $doctor->first_name_en }}</td>
                                                    <td>{{ $doctor->doctorTitle->name_ar}}</td>
                                                    <td>{{ $doctor->professionalTitle->name_ar}}</td>

                                                    <td>
                                                        @if($doctor->image  )
                                                            <img src="{{ asset('uploads/doctors').'/' . $doctor->image}}" width="50px" alt ="{{ $doctor->name }}">
                                                        @else
                                                            <p>لا يوجد</p>
                                                        @endif
                                                    </td>
                                                     @can('doctors-edit')
                                                    <td>
                                                        <a href="{{route('admin.doctors.edit',$doctor->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث بيانات الطبيب"><i class="fa fa-pencil text-white" aria-hidden="true"></i></a>
                                                    </td>
                                                    @endcan
                                                    @can('doctors-delete')
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_doctor{{ $doctor->id }}" title="حذف الطبيب"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('admin.doctors.destroy',$doctor)}}" method="POST">
                                                            <div class="modal fade" id="delete_doctor{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف طبيب من قائمة الأطباء</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف الطبيب  {{$doctor->name}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$doctor->id}}" name="id">
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
					{{-- {{ $appointments->links() }} --}}
				</div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
