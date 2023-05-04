@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">وصف العرض</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة العروض   </span>
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
                     
								<div class="col-md-4">
									<img src="{{ url('uploads/offers'."/" . $offer->image) }}">
								</div>
                                <div class="details col-xl-8 col-lg-8 col-md-8 mt-4 mt-xl-0">
                                    <h5 class="product-title mb-1 text-muted">{{ $offer->title_ar }}</h5>
									
                                    <h6 class="product-title mb-1 mt-2 mb-4">{{ $offer->description_ar }}</h6>

									<h6 class="price">السعر الحالي : <span class="h4 ml-2">{{ $offer->price }} جنيه</span></h6>

									<h6 class="price">سعر العرض  : <span class="h4 ml-2">{{ $offer->discount_price }} جنيه</span></h6>
									<p>العرض ساري بفرع {{ $offer->branch->name_ar }}</p>
									<p>العرض ساري من تاريخ  {{ $offer->from_date }} حتي {{ $offer->to_date }}</p>

                                    {{-- <p class="product-description">{{ $branch->description_ar }}</p> --}}
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
