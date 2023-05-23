
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة عرض</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ العروض</span>
            </div>
        </div>

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


                        @inject('model', 'App\Models\Offer')

                        @include('inc.errors')
                        {!! Form::model($model,[
                            'route' => 'admin.offers.store',
                            'files' =>true,
                            ])
                        !!}

                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!!Form::label('name', 'إسم العرض باللغة العربية')!!}  <span class="text-danger font-weight-bolder">*</span>
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
                                 {!!Form::label('name', 'وصف العرض باللغة العربية')!!}  <span class="text-danger font-weight-bolder">*</span>
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
                                     {!!Form::label('name', 'تاريخ بداية العرض')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!!Form::date('from_date', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' تاريخ بداية العرض '
                                    ])!!}
                                </div>

                                <div class="form-group col-md-6">
                                     {!!Form::label('name', 'تاريخ نهاية العرض')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!!Form::date('to_date', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'تاريخ نهاية العرض'
                                    ])!!}
                                </div>
                                
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">
                                     {!!Form::label('name', 'السعر الأصلي')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!!Form::number('price', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'السعر الأصلي ',
                                        'min' => 0 ,
                                         'step'=>'any',
                                    ])!!}
                                </div>

                                <div class="form-group col-md-4">
                                     {!!Form::label('name', 'سعر العرض ')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!!Form::number('discount_price', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'سعر العرض ',
                                         'min' =>0 ,
                                          'step'=>'any',
                                    ])!!}
                                </div>

                                <div class="form-group col-md-4">
                                     {!!Form::label('name', 'نسبة الخصم')!!}  <span class="text-danger font-weight-bolder">*</span>
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
                                            {!!Form::label('name', 'إختر الفرع ')!!} <span class="text-danger font-weight-bolder">*</span>
                                            {!! Form::select('branch_id', $branches, null ,
                                                ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'إختر الفرع',
                                                ])
                                            !!}
                                        </div>
                                    @else
                                    {{-- {{ dd(Auth::user()->branch->id)}} --}}
                                        <div class="form-group">
                                               {!!Form::label('name', 'إختر الفرع ')!!} <span class="text-danger font-weight-bolder">*</span>
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
                                    </label>
                                </div>
          

                            </div>


                                </div>
                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('حفظ',[
                                        'class' =>'btn btn-primary btn-flat'
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

