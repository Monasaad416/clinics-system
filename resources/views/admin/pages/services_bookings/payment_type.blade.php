@extends('admin.layout.master')
@section('css')
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إختر الغرض من سند القبض</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<style>
						.type {
							text-decoration: none;
							color: #fff !important;
						}
					</style>

			
					<div class="col-xl-12" >
						<div class="card" >
							<div class="card-body" style="height: 50vh">
								<div class="d-flex justify-content-center align-items-center h-100">
									<div>
										<div class="d-flex justify-around">
											<div class="mx-3">
												<button class="btn btn-secondary btn-lg btn-block"><a class="type" href="{{ route('admin.clients_reservations_payments.create',$reservation->id) }}">كشف - إستشارة</a></button>
											</div>
											<div class="mx-3">
												<button class="btn btn-secondary btn-lg btn-block"><a class="type"href="{{ route('admin.clients_services_payments.create',$reservation->id) }}"> خدمات </a></button>
											</div>
								
								        
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
