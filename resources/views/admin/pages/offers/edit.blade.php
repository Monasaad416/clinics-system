
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تحديث العرض</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ العروض</span>
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
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <div class="col-xs-12">
                        <div class="col-md-12">
                        <br>
                        @php
                            $branches = App\Models\Branch::pluck('name_ar','id');
                        @endphp



                        @include('inc.errors')
                        {!! Form::model($offer,[
                            'route' => ['admin.offers.update',$offer],
                            'files' =>true,
                            ])
                        !!}
                        {{ method_field('PATCH')}}
        

                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!!Form::label('name', 'إسم العرض باللغة العربية')!!}
                                    {!!Form::text('title_ar', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إسم العرض باللغة العربية'
                                    ])!!}
                                </div>

                                <div class="form-group col-md-6">
                                     {!!Form::label('name', 'إسم العرض باللغة الإنجليزية')!!}
                                    {!!Form::text('title_en', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إسم العرض باللغة الإنجليزية  '
                                    ])!!}
                                </div>
                            </div>  
                            <div class="row">
                                <div class="form-group col-md-6">
                                 {!!Form::label('name', 'وصف العرض باللغة العربية')!!}
                                    {!!Form::text('description_ar', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'وصف العرض باللغة العربية'
                                    ])!!}
                                </div>

                                <div class="form-group col-md-6">
                                     {!!Form::label('name', 'وصف العرض باللغة الأنجليزية')!!}
                                    {!!Form::text('description_en', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'وصف العرض  باللغة الإنجليزية  '
                                    ])!!}
                                </div>
                            </div>  

       
                            <div class="row">
                                <div class="form-group col-md-6">
                                     {!!Form::label('name', 'تاريخ بداية العرض')!!}
                                    {!!Form::date('from_date', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' تاريخ بداية العرض '
                                    ])!!}
                                </div>

                                <div class="form-group col-md-6">
                                     {!!Form::label('name', 'تاريخ نهاية العرض')!!}
                                    {!!Form::date('to_date', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'تاريخ نهاية العرض'
                                    ])!!}
                                </div>
                                
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">
                                     {!!Form::label('name', 'السعر الأصلي')!!}
                                    {!!Form::number('price', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'السعر الأصلي ',
                                        'min' => 0 ,
                                        'step'=>'any',
                                    ])!!}
                                </div>

                                <div class="form-group col-md-4">
                                     {!!Form::label('name', 'سعر العرض ')!!}
                                    {!!Form::number('discount_price', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'سعر العرض ',
                                        'min' =>0 ,
                                        'step'=>'any',
                                    ])!!}
                                </div>

                                <div class="form-group col-md-4">
                                     {!!Form::label('name', 'نسبة الخصم')!!}
                                    {!!Form::number('discount_percentage', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'نسبة الخصم ',
                                        'min' =>0 ,
                                        'step'=>'any',
                                    ])!!}
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    @if(Auth::user()->roles_name == ["superadmin"])
                                        <div class="form-group">
                                            {!! Form::select('branch_id', $branches, null ,
                                                ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'إختار الفرع',
                                                ])
                                            !!}
                                        </div>
                                    @else
                                    {{-- {{ dd(Auth::user()->branch->id)}} --}}
                                        <div class="form-group">
                                            <select name='branch_id' class="form-control">
                                                <option value="{{(Auth::user()->branch->id)}}" >{{(Auth::user()->branch->name_ar)}}</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>

                                   <div class="form-group col-md-6">
                                    <label>
                                        {!!Form::file('image')!!}
                                        <span class="text-muted">تحميل صورة العرض   </span>
                                        <img src="{{ url('uploads/offers'."/".$offer->image) }}" width="70px" alt="offer"/>
                                    </label>
                                </div>
          

                            </div>

                               {!! Form::hidden('offer_id', $offer->id )!!}
                                </div>
                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('تحديث',[
                                        'class' =>'btn btn-secondary btn-flat'
                                    ])!!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection

