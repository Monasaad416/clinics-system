
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">أذونات القبض من العملاء لفرع  <span class="text-danger"><span class="text-danger"> {{ App\Models\Branch::where('id',auth()->user()->branch_id)->first()->name_ar }}</span> </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الحسابات</span>
            </div>
        </div>
  
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            @livewire('client-payment-branch')
      
    </div>
@endsection
@section('js')
@endsection




