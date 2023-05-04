@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">وصف الخدمة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الخدمات الرئيسية </span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                <!-- row -->
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body h-100">
                            <div class="row row-sm ">
                                <div class=" col-xl-5 col-lg-12 col-md-12">
                                    <div class="preview-pic tab-content">
                                        <div class="tab-pane active" id="pic-1"><img src="{{asset('uploads/services'.'/'.$service->image)}}" alt="image"/></div>
                                    </div>

                                </div>
                                <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                                    <h4 class="product-title mb-1">{{ $service->name_ar }}</h4>

                                    <p class="product-description">{{ $service->description_ar }}</p>

									<h6 class="text-danger">السعر : {{ $service->price }}  جنيه </h6>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->


        </div>
        <!-- Container closed -->
    </div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
