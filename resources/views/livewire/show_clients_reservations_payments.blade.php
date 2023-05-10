
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">سندات قبض الكشوفات من العملاء <span class="text-danger"></span> </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الحسابات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col">
            @livewire('client-res-payment-component')

    </div>
@endsection
@section('js')
@endsection




