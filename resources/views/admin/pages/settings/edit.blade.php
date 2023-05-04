
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تحديث إعدادات الموقع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الإعدادات</span>
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
   <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <div class="card">
        @include('inc.errors')
        @include('inc.messages')
        {!! Form::model( $settings ,[
                'route' => ['admin.settings.update'],
                'method' => 'post',
                'files' =>true,
            ])
        !!}

            <div class="card-body">
                <div class="form-group">
                    {{-- {!!Form::hidden('id', $settings->id)!!} --}}
                    <div class="row">
                        <div class="col-md-6">
                            {!!Form::label('name', 'الإسم بالعربية:')!!}
                            {!!Form::text('title_ar', $settings->name_ar,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                        <div class="col-md-6">
                              {!!Form::label('name', 'الإسم بالإنجليزية:')!!}
                            {!!Form::text('title_en', $settings->name_en,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!!Form::label('name', 'العنوان بالعربية:')!!}
                            {!!Form::text('address_ar', $settings->name_ar,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                        <div class="col-md-6">
                              {!!Form::label('name', 'العنوان بالإنجليزية:')!!}
                            {!!Form::text('address_en', $settings->name_en,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                    </div>


                    
                    <div class="row">
                        <div class="col-md-6">
                            {!!Form::label('name', 'الهاتف :')!!}
                            {!!Form::text('phones', $settings->phones,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                        <div class="col-md-6">
                              {!!Form::label('name', 'البريد الإلكتروني :')!!}
                            {!!Form::email('email', $settings->email,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                    </div>

                               
                    <div class="row">
                        <div class="col-md-6">
                            {!!Form::label('name', 'رابط الفيس بوك :')!!}
                            {!!Form::text('facebook', $settings->facebook,[
                                'class' => 'form-control',
                            ])!!}
                            
                        </div>
                        <div class="col-md-6">
                              {!!Form::label('name', 'رابط الانستاجرام :')!!}
                            {!!Form::text('instagram', $settings->instagram,[
                                'class' => 'form-control',
                            ])!!}
                          
                        </div>
                    </div>

                               
                    <div class="row">
                        <div class="col-md-6">
                            {!!Form::label('name', 'رابط لينكد إن :')!!}
                            {!!Form::text('linkedin', $settings->linkedin,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                        <div class="col-md-6">
                              {!!Form::label('name', 'رابط تويتر :')!!}
                            {!!Form::text('twitter', $settings->twitte,[
                                'class' => 'form-control',
                            ])!!}
                        </div>
                    </div>

                               
                    <div class="row">
                        <div class="col-md-6">
                            {!!Form::label('name', 'الايكونة :')!!}
                            {!!Form::file('favicon', null,[
                                'class' => 'form-control',
                            ])!!}
                            <img src="{{ url('uploads/settings' . "/" . $settings->favicon) }}" alt="favicon">
                        </div>
                        <div class="col-md-6">
                              {!!Form::label('name', 'الشعار :')!!}
                            {!!Form::file('logo',null,[
                                'class' => 'form-control',
                            ])!!}
                            <img src="{{ url('uploads/settings' . "/" . $settings->logo) }}"  width="60px "alt="favicon">
                        </div>
                    </div>
       
       

       

                   
        
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center my-4">
                        {!!Form::submit('تحديث الإعدادات',[
                            'class' =>'btn btn-secondary btn-flat'
                        ])!!}
                    </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('js')
@endsection

