
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الارباح و الخسائر لفرع {{ App\Models\Branch::where('id',auth()->user()->branch_id)->first()->name_ar }} </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الحسابات</span>
            </div>
        </div>
  
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            @livewire('payment-branch')
        </div>
    </div>
@endsection
@section('js')
@endsection




