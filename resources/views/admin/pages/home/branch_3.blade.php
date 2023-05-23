@extends('admin.layout.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
{{-- @section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<div>
				<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا {{ Auth::user()->name }}</h2>
				<p class="mg-b-0">لوحة تحكم الأدمن</p>
			</div>
		</div>
		<div class="main-dashboard-header-right">
			<div>
				<label class="tx-13">Customer Ratings</label>
				<div class="main-star">
					<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
				</div>
			</div>
			<div>
				<label class="tx-13">Online Sales</label>
				<h5>563,275</h5>
			</div>
			<div>
				<label class="tx-13">Offline Sales</label>
				<h5>783,675</h5>
			</div>
		</div>
	</div>
	<!-- /breadcrumb -->
@endsection --}}
@section('content')
				<!-- row -->
				<div class="row row-sm mt-5 mb-2">
                    <div class="col-lg-2 col-xl-2"></div>
						<div class="col-xl-8 col-lg-8 col-md-12 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">كشوفات اليوم </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $branch->reservations()->where('date', now()->format('Y-m-d'))->where('status','completed')->sum('final_price') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">فرع {{ $branch->name_ar }}</p>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="col-lg-2 col-xl-2"></div>

				</div>


				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
			    <div class="col-lg-2 col-xl-2"></div>
				<div class="col-md-12 col-lg-8 col-xl-8">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">عدد حجوزات الشهر السابق لفرع <span class ="text-danger">{{ $branch->name_ar }}</span></h6><span class="d-block mg-b-10 text-muted tx-12">تتبع حالة الحجوزات وإتمام المريض للزيارة</span>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i class=""></i>
									<p> حجز موعد</p><span>{{ $branch->reservations->where('status','pending')->where('created_at',">=",  Carbon\Carbon::now()->firstOfMonth()->toDateTimeString())->count() }} مريض </span>
								</div>
								<div class="list-group-item">
									<i class=""></i>
									<p>إتمام الزيارة</p><span>{{ $branch->reservations->where('status','completed')->where('created_at',">=",  Carbon\Carbon::now()->firstOfMonth()->toDateTimeString())->count() }}  مريض </span>
								</div>
								<div class="list-group-item">
									<i class=""></i>
									<p>إلغاء الموعد </p><span>{{ $branch->reservations->where('status','canceled')->where('created_at',">=",  Carbon\Carbon::now()->firstOfMonth()->toDateTimeString())->count() }} مريض </span>
								</div>

								<div class="list-group-item">
									<i class=""></i>
									<p>لم يحضر</p><span>{{ $branch->reservations->where('status','absent')->where('created_at',">=",  Carbon\Carbon::now()->firstOfMonth()->toDateTimeString())->count() }} مريض </span>
								</div>

							</div>
						</div>


                        <div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">عدد الخدمات المقدمة الشهر السابق لفرع <span class ="text-danger">{{ $branch->name_ar }}</span></h6><span class="d-block mg-b-10 text-muted tx-12">     </span>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i class=""></i>
									 <p> {{ $branch->servicesBookings->where('created_at',">=",  Carbon\Carbon::now()->firstOfMonth()->toDateTimeString())->count() }}</p><span> خدمة </span>
								</div>
						
							</div>
						</div>
					</div>

			    <div class="col-lg-2 col-xl-2"></div>

					{{-- <div class="col-lg-12 col-xl-5">
						<div class="card card-dashboard-map-one">
							<label class="main-content-label">Sales Revenue by Customers in USA</label>
							<span class="d-block mg-b-20 text-muted tx-12">Sales Performance of all states in the United States</span>
							<div class="">
								<div class="vmap-wrapper ht-180" id="vmap2"></div>
							</div>
						</div>
					</div> --}}
				</div>
				<!-- row closed -->

				<div class="row row-sm">
					<div class="col-lg-2 col-xl-2"></div>
					<div class="col-md-12 col-lg-8 col-xl-8">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">عدد الأطباء بفرع <span class ="text-danger">{{ $branch->name_ar }}</span></h6><span class="d-block mg-b-10 text-muted tx-12"> </span>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i class=""></i>
									<p> {{ $branch->doctors->count() }}</p><span> طبيب </span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-xl-2"></div>

				</div>

				<!-- row opened -->

								<!-- row closed -->

				<div class="row row-sm">
			      <div class="col-lg-2 col-xl-2"></div>
				  <div class="col-md-12 col-lg-8 col-xl-8">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">عدد العروض بفرع <span class ="text-danger">{{ $branch->name_ar }}</span></h6><span class="d-block mg-b-10 text-muted tx-12"> </span>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i class=""></i>
									<p> {{ $branch->offers->count() }}</p><span> عرض </span>
								</div>
							</div>
						</div>
					</div>
				    <div class="col-lg-2 col-xl-2"></div>

				</div>
       {{-- {{ dd(auth()->user()->can('reservations-list')) }} --}}

                <div class="row row-sm">
			      <div class="col-lg-2 col-xl-2"></div>
				  <div class="col-md-12 col-lg-8 col-xl-8">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">عدد العملاء بفرع <span class ="text-danger">{{ $branch->name_ar }}</span></h6><span class="d-block mg-b-10 text-muted tx-12"> </span>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i class=""></i>
									<p> {{ $branch->clients->count() }}</p><span> عرض </span>
								</div>
							</div>
						</div>
					</div>
				    <div class="col-lg-2 col-xl-2"></div>

				</div>

				<!-- row opened -->
				{{-- <div class="row row-sm">
					<div class="col-xl-4 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">Recent Customers</h3>
								<p class="tx-12 mb-0 text-muted">A customer is an individual or business that purchases the goods service has evolved to include real-time</p>
							</div>
							<div class="card-body p-0 customers mt-1">
								<div class="list-group list-lg-group list-group-flush">
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/3.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-0">
														<h5 class="mb-1 tx-15">Samantha Melon</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234 <span class="text-success ml-2">Paid</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark1" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/11.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Jimmy Changa</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234 <span class="text-danger ml-2">Pending</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark2" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/17.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Gabe Lackmen</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234<span class="text-danger ml-2">Pending</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark3" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/15.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Manuel Labor</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234<span class="text-success ml-2">Paid</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark4" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="list-group-item list-group-item-action br-br-7 br-bl-7" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/6.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-1">
														<h5 class="mb-1 tx-15">Sharon Needles</h5>
														<p class="b-0 tx-13 text-muted mb-0">User ID: #1234<span class="text-success ml-2">Paid</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark5" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">Sales Activity</h3>
								<p class="tx-12 mb-0 text-muted">Sales activities are the tactics that salespeople use to achieve their goals and objective</p>
							</div>
							<div class="product-timeline card-body pt-2 mt-1">
								<ul class="timeline-1 mb-0">
									<li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Total Products</span> <a href="#" class="float-left tx-11 text-muted">3 days ago</a>
										<p class="mb-0 text-muted tx-12">1.3k New Products</p>
									</li>
									<li class="mt-0"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Total Sales</span> <a href="#" class="float-left tx-11 text-muted">35 mins ago</a>
										<p class="mb-0 text-muted tx-12">1k New Sales</p>
									</li>
									<li class="mt-0"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Toatal Revenue</span> <a href="#" class="float-left tx-11 text-muted">50 mins ago</a>
										<p class="mb-0 text-muted tx-12">23.5K New Revenue</p>
									</li>
									<li class="mt-0"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Toatal Profit</span> <a href="#" class="float-left tx-11 text-muted">1 hour ago</a>
										<p class="mb-0 text-muted tx-12">3k New profit</p>
									</li>
									<li class="mt-0"> <i class="si si-eye bg-purple-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Customer Visits</span> <a href="#" class="float-left tx-11 text-muted">1 day ago</a>
										<p class="mb-0 text-muted tx-12">15% increased</p>
									</li>
									<li class="mt-0 mb-0"> <i class="icon-note icons bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">Customer Reviews</span> <a href="#" class="float-left tx-11 text-muted">1 day ago</a>
										<p class="mb-0 text-muted tx-12">1.5k reviews</p>
									</li>
								</ul>
							</div>
						</div>
					</div>

				</div> --}}
				<!-- row close -->


				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
