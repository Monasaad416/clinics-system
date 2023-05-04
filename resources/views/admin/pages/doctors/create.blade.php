
@extends('admin.layout.master')
@section('css')
    @push('css')

    @endpush
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة طبيب</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأطباء</span>
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

                        @inject('model', 'App\Models\Doctor')

                        @include('inc.errors')
                        @php
                            $departments = App\Models\Department::pluck('name_ar', 'id');
                            $branches = App\Models\Branch::pluck('name_ar', 'id');
                            $doctorTitles = App\Models\DoctorTitle::pluck('name_ar', 'id');
                            $professionalTitles = App\Models\ProfessionalTitle::pluck('name_ar', 'id');
                            $specialists = App\Models\Specialist::pluck('name_ar', 'id');
                            $sub_specialists = [];
                            $days = App\Models\Day::all();
                        @endphp

                        {!! Form::model($model,[
                            'route' => 'admin.doctors.store',
                            'files' =>true,
                            ])
                        !!}
                            <div class="">
                                <h3>البيانات الأساسية للطبيب</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!Form::label('name_en', ' الأسم باللغة الإنجليزية:')!!}   
                                            {!!Form::text('name_en', null,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'أدخل الأسم  بالإنجليزية'
                                            ])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!Form::label('name_ar', ' الإسم  باللغة العربية:')!!} <span class="text-danger font-weight-bolder">*</span>
                                            {!!Form::text('name_ar', null,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'أدخل الإسم  بالعربية'
                                            ])!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        {!!Form::label('about_en', ' نبذة عن الطبيب باللغة الإنجليزية:')!!}
                                            {!!Form::text('about_en', null,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'أدخل  نبذة عن الطبيب باللغة الإنجليزية'
                                            ])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!Form::label('about_ar', 'نبذة عن الطبيب باللغة العربية:')!!}<span class="text-danger font-weight-bolder">*</span>
                                            {!!Form::text('about_ar', null,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => ' نبذة عن الطبيب باللغة العربية'
                                            ])!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!Form::label('name', 'البريد الإلكتروني:')!!}
                                            {!!Form::text('email', null,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'أدخل البريد الإلكتروني'
                                            ])!!}
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <div class="form-group">
                                            {!!Form::label('name', 'الهاتف:')!!}<span class="text-danger font-weight-bolder">*</span>
                                            {!!Form::text('phone', null,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'أدخل رقم الهاتف '
                                            ])!!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!Form::label('name', 'الجنس:')!!}<span class="text-danger font-weight-bolder">*</span>
                                            <select name='gender' class ='form-control  mt-1 mb-3'>
                                                <option value="1" >ذكر</option>
                                                <option value="2" >أنثي</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="my-3">
                                <h3>التخصص</h3>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!Form::label('name', 'المسمي الوظيفي ')!!}
                                            {!! Form::select('doctor_title_id', $doctorTitles, null ,
                                                ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => ' إختار المسمي الوظيفي ',
                                                ])
                                            !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                             {!!Form::label('name', 'اللقب المهني')!!}
                                            {!! Form::select('professional_title_id', $professionalTitles, null ,
                                                ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => ' إختار اللقب المهني ',
                                                ])
                                            !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                        {!!Form::label('name', 'إختار التخصص الرئيسي')!!}<span class="text-danger font-weight-bolder">*</span>
                                        {!! Form::select('specialist_id', $specialists, null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => ' إختار التخصص الرئيسي',
                                            ])
                                        !!}
                                    </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>إختار التخصص الفرعي</label>
                                        <select style="border-color: gray" class="js-example-basic-multiple form-control" name="sub_specialist_ids[]" multiple="multiple">
                                        <option value="">إختارالتخصص الفرعي  </option>


                                        </select>
                                    </div>

                                    </div>
                                </div>

                                <div class="row my-4">
                                    <div class="col-md-4">
                                        <input type="file" class="my-2" name="professional_image"><br> <span class="text-muted"> صورةإثبات بطاقة مزاولة المهنة </span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="my-2" name="title_image"><br> <span class="text-muted">صورةإثبات اللقب المهني </span>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="file" class="my-2" name="image"><br> <span class="text-muted">الصورة الشخصية</span>
                                    </div>
                                </div>


                            </div>


                            <div class="">
                                <h3>المنشأة</h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if(Auth::user()->roles_name == ["superadmin"])
                                            <div class="form-group">
                                                {!!Form::label('name', 'إختار الفرع ')!!} <span class="text-danger font-weight-bolder">*</span>
                                                {!! Form::select('branch_id', $branches, null ,
                                                    ['class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => 'إختار الفرع',
                                                    ])
                                                !!}
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <select name='branch_id' class="form-control">
                                                    <option value="{{(Auth::user()->branch->id)}}" >{{(Auth::user()->branch->name_ar)}}</option>
                                                </select>
                                            </div>
                                        @endif

                                    </div>


                                <div class="col-md-3">
                                    <label>أدخل راتب الطبيب</label>
                                    <input  type="number" min="0" name="amount" class='form-control  mt-1 mb-3' placeholder= 'أدخل راتب الطبيب'>

                                </div>


                                <div class="col-md-3">
                                    <label>أدخل رسوم الكشف </label>
                                    <input  type="number" min="0" name="fees" class='form-control  mt-1 mb-3' placeholder= 'أدخل  رسوم الكشف '>
                                </div>


                                <div class="col-md-3">
                                    <label>أدخل رسوم الكشف في حالة وجودخصم </label>
                                    <input  type="number" min="0" name="discount_fees" class='form-control  mt-1 mb-3' placeholder= ' أدخل  رسوم الكشف في حالة وجود خصم '>
                                </div>

                            </div>

                            <div class="form-group">
                                <option>إختار الأيام المتاحة للعمل</option>
                                    @foreach ( App\Models\Day::all() as $day)
                                        <input type="checkbox" name="day_ids[]" class="mycheckbox" value="{{$day->id}}" />{{$day->day_ar}}
                                        <div style="display:none">
                                            <label>من</label>
                                            <input type="time" name="from1[]" class="col-3">
                                            <label >إلي</label>
                                            <input type="time" name="to1[]" class="col-3">
                                            <label >عدد الكشوفات</label>
                                            <input type="number" name="no_of_reservations1[]" class="col-3">

                                            <input type="checkbox" class="sec" >إضافة موعد أخر
                                            <br>
                                            <div style="display:none" class="secDiv">
                                                <label>من</label>
                                                <input type="time" name="from2[]" class="col-3">
                                                <label >إلي</label>
                                                <input type="time" name="to2[]" class="col-3">
                                                <label >عدد الكشوفات</label>
                                                <input type="number" name="no_of_reservations2[]" class="col-3">
                                            </div>
                                        </div>
{{-- 
                                        <input type ="hidden" name="id" value={{ $day->id }}> --}}
                                    <br>
                                    @endforeach

                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">الحجز بأولوية الحضور</label><span class="text-danger font-weight-bolder">*</span>
                                        <select name='first_come' class ='form-control  mt-1 mb-3'>
                                            <option value="0" >--إختار--</option>
                                            <option value="yes" >نعم</option>
                                            <option value="no" >لا</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="">توقف الحجز بعد أول كشف  </label><span class="text-danger font-weight-bolder">*</span>
                                        <select name='stop_reservations' class ='form-control  mt-1 mb-3'>
                                            <option value="0" >--إختار--</option>
                                            <option value="yes" >نعم</option>
                                            <option value="no" >لا</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            </div>

                            </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                {!!Form::submit('حفظ',[
                                    'class' =>'btn btn-primary btn-flat'
                                ])!!}
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

<script>
  $(document).ready(function () {
        $('select[name="specialist_id"]').on('change', function () {
            var specialist_id = $(this).val();
            console.log(specialist_id);
            if (specialist_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getSubSpecialistsBySpecialist") }}/" + specialist_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="sub_specialist_ids[]"]').empty();
                        $('select[name="sub_specialist_ids[]"]').append('<option value="selected disabled">إختار التخصص الفرعي</option>');
                        $.each(data, function (key, value) {

                            $('select[name="sub_specialist_ids[]"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    </script>


<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>


<script>
    $('.mycheckbox').change(function(){
        if(this.checked) {
            $(this).next().show();
        } else {
            $(this).next().hide();
        }
    });

    $('.sec').change(function(){
        if(this.checked) {
            $('.secDiv').show();
        } else {
            $('.secDiv').hide();
        }
    });


    $('.third').change(function(){
        if(this.checked) {
            $('.thirdDiv').show();
        } else {
            $('.thirdDiv').hide();
        }
    });


</script>


@endsection

