
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تحديث بيانات الطبيب</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  الاطباء</span>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                        <br>



                        @include('inc.errors')
                        @php
                            $departments = App\Models\Department::pluck('name_ar', 'id');
                            $sections = App\Models\Section::pluck('name_ar', 'id');
                            $doctorTitles = App\Models\DoctorTitle::pluck('name_ar', 'id');
                            $professionalTitles = App\Models\ProfessionalTitle::pluck('name_ar', 'id');
                        @endphp
                        {!! Form::model($doctor,[
                                      'route' => ['admin.doctors.update',$doctor->id ],
                            'files' =>true,
                            ])
                        !!}

                        {{ method_field('PUT')}}

                            <div class="card-body">
                                <div class="form-group">
                                   {!!Form::label('first_name_en', ' الأسم الأول باللغة الإنجليزية:')!!}
                                    {!!Form::text('first_name_en', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل الأسم الاول بالإنجليزية'
                                    ])!!}
                                </div>
                                <div class="form-group">
                                   {!!Form::label('first_name_ar', ' الإسم الأول باللغة العربية:')!!}
                                    {!!Form::text('first_name_ar', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل الإسم الأول بالعربية'
                                    ])!!}
                                </div>
                                <div class="form-group">
                                   {!!Form::label('last_name_en', ' الأسم الأخير باللغة الإنجليزية:')!!}
                                    {!!Form::text('last_name_en', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل الأسم الاول بالإنجليزية'
                                    ])!!}
                                </div>
                                <div class="form-group">
                                    {!!Form::label('last_name_ar', ' الإسم الأخير باللغة العربية:')!!} 
                                    {!!Form::text('last_name_ar', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل الإسم الأول بالعربية'
                                    ])!!}
                                </div>
                                <div class="form-group">
                                    {!!Form::label('about_en', ' نبذة عن الطبيب باللغة الإنجليزية:')!!} 
                                    {!!Form::text('about_en', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل  نبذة عن الطبيب باللغة الإنجليزية'
                                    ])!!}
                                </div>
                                <div class="form-group">
                                    {!!Form::label('about_ar', 'نبذة عن الطبيب باللغة العربية:')!!} 
                                    {!!Form::text('about_ar', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' نبذة عن الطبيب باللغة العربية'
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name', 'البريد الإلكتروني:')!!} 
                                    {!!Form::text('email', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل البريد الإلكتروني'
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name', 'الهاتف:')!!} 
                                    {!!Form::text('phone', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل رقم الهاتف '
                                    ])!!}
                                </div>

                                <div class="form-group">
                                {!!Form::select('gender', ['1' => 'Male', '2' => 'Female'],[
                                        'class' => 'form-control  mt-1 mb-3',
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    <label>
                                    {!!Form::file('image')!!}
                                    تحميل الصورة الشخصية
                                </label>
                                </div>

                                <div class="form-group">
                                    {!!Form::label('department', 'القسم')!!}
                                    {!! Form::select('department_id', $departments, null ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إختر القسم',
                                        ])
                                    !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::select('section_id', $sections, null ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إختر الفرع',
                                        ])
                                    !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::select('doctor_title_id', $doctorTitles, null ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' إختر المسمي الوظيفي ',
                                        ])
                                    !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::select('professional_title_id', $professionalTitles, null ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' إختر اللقب المهني ',
                                        ])
                                    !!}
                                </div>

                                <div class="form-group">
                                    {{-- {!!Form::label('name', 'الراتب :')!!} --}}
                                    {!!Form::number('salary', $doctor->salary->amount,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل الراتب ',
                                        'min' => 0,
                                        'step' => 'any',
                                    ])!!}
                                </div>

                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('تحديث',[
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

