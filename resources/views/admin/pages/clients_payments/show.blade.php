@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">وصف الفرع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الأفرع   </span>
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

                <!-- row -->
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body h-100">
                            <div class="row row-sm ">
                                <div class=" col-xl-5 col-lg-12 col-md-12">
                                    <div class="preview-pic tab-content">
                                        <div class="tab-pane active" id="pic-1"><img src="{{asset('uploads/branchs'.'/'.$branch->image)}}" alt="image"/></div>
                                    </div>

                                </div>
                                <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                                    <h4 class="product-title mb-1">{{ $branch->name_ar }}</h4>
                                    <h6 class="product-title mb-1 mt-2 mb-4">{{ $branch->address_ar }}</h6>

                                    <p class="product-description">{{ $branch->description_ar }}</p>

                                



                                    </ul>


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
