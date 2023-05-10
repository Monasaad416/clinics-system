@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأطباء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الكشوفات الفعليه  للطبيب {{$doctor->name_ar}} </span>
						</div>
					</div>
			
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
	            @livewire('doctor-reservation' ,['doctor' => $doctor])
				<!-- /row -->

      
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
