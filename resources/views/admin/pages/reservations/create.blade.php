
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة حجز</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الحجوزات</span>
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

                        @inject('model', 'App\Models\Reservation')
                        @php
                            $branches = App\Models\Branch::pluck('name_ar', 'id');
                            $specialists = App\Models\Specialist::pluck('name_ar', 'id');
                            $subSpecialists = [];
                            $doctors = [];
                            $services = [];
                            $paymentMethods = App\Models\PaymentMethod::pluck('name_ar', 'id');
                            $companies = App\Models\Company::pluck('name', 'id');
                        @endphp

                        @include('inc.errors')
                        {!! Form::model($model,[
                            'route' => 'admin.reservations.store',
                            ])
                        !!}
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('name','الفرع ')!!} <span class="text-danger font-weight-bolder">*</span>
                                @if(Auth::user()->roles_name == ["superadmin"])
                                    <div class="form-group">
                                        {!! Form::select('branch_id', $branches, null ,
                                            ['class' => 'form-control mt-1 mb-3',
                                            'id' => 'branch_id',
                                            'placeholder' => 'إختر الفرع',
                                            ])
                                        !!}
                                    </div>
                                @else
                                {{-- {{ dd(Auth::user()->branch->id)}} --}}
                                    <div class="form-group">
                                        <select name='branch_id'  id="branch_id" class="form-control">
                                            <option value="{{(Auth::user()->branch->id)}}" >{{(Auth::user()->branch->name_ar)}}</option>
                                        </select>
                                    </div>
                                @endif
                            </div>

                            @error('branch_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-md-3">
                                 {!! Form::label('name','التخصص الرئيسي ')!!} <span class="text-danger font-weight-bolder">*</span>
                                 {!! Form::select('specialist_id', $specialists, null ,
                                    ['class' => 'form-control mt-1 mb-3',
                                    'placeholder' => 'إختر التخصص الرئيسي',
                                    ])
                                !!}
                            </div>

                            @error('specialist_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-md-3">
                                 {!! Form::label('name','التخصص الفرعي ')!!}
                                 {!! Form::select('sub_specialist_id', $subSpecialists, null ,
                                    ['class' => 'form-control mt-1 mb-3 ',
                                    'placeholder' => 'إختر التخصص الفرعي',
                                    ])
                                !!}
                            </div>

                            @error('sub_specialist_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('name',' الطبيب')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!! Form::select('doctor_id', $doctors, null ,
                                    ['class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => 'إختر الطبيب',
                                    ])
                                    !!}
                                </div>
                            </div>
                            @error('doctor_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="row">


                            <div class="col-md-4">
                                <div class="form-group">
                                {!! Form::label('name','إسم العميل ')!!}
                                    {!!Form::text('name', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إسم العميل '
                                    ])!!}
                                </div>
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('name','هاتف العميل ')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!!Form::text('phone', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'رقم هاتف العميل '
                                    ])!!}
                                </div>
                            </div>
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror



                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('name','تاريخ ميلاد العميل ')!!} 
                                    {!!Form::date('date_of_birth', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' تاريخ ميلاد العميل '
                                    ])!!}
                                </div>
                            </div>
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="row">
                            <div class="col-md-6">
                            {!!Form::label('name', 'إدخل يوم الحجز') !!} <span class="text-danger font-weight-bolder">*</span>
                            {!!Form::date('date', null,[
                                'class' => 'form-control  mt-1 mb-3',
                            ])!!}

                            </div>
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                              <div class="col-md-6">
                                   {!!Form::label('name', 'إدخل توقيت الحجز') !!} <span class="text-danger font-weight-bolder">*</span>
                            {!!Form::time('time', null,[
                                'class' => 'form-control  mt-1 mb-3',
                            ])!!}


                            </div>

                              @error('time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>







                            <div class="form-group">
                                {!!Form::label('name', 'حالة الحجز')!!} <span class="text-danger font-weight-bolder">*</span>
                                <br>
                                {!!Form::radio('status', '1')!!} حجز موعد <br>
                                {!!Form::radio('status', '2')!!} أتم الزيارة <br>
                                {!!Form::radio('status', '3')!!} إلغاء الموعد <br>
                                {!!Form::radio('status', '4')!!} لم يحضر <br>

                            </div>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <hr>

                            <div class="form-group">
                                {!!Form::label('name', 'نوع الحجز')!!} <span class="text-danger font-weight-bolder">*</span>
                                <br>

                                {!!Form::radio('type', '1')!!} كشف  <br>
                                {!!Form::radio('type', '2')!!} إستشارة  <br>
                            </div>

                            @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!!Form::label('name', ' إسم شركة التأمين')!!}
                                        {!!Form::text('insurance', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'إسم شركة التأمين    '
                                        ])!!}
                                    </div>
                                </div>

                                  @error('insurance')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <div class="form-group">
                                    {!!Form::label('name', 'النسبة المئوية لتحمل التأمين % ')!!}
                                        {!!Form::number('insurance_percentage', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'ادخل النسبة المئوية لتحمل التأمين بدون % مثال (10) ',
                                            'step'=>'any',
                                        ])!!}
                                    </div>
                                </div>
                                @error('insurance_percentage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                    {!!Form::label('name', ' خصم التأمين')!!}
                                        {!!Form::number('insurance_discount', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => ' خصم التأمين  '
                                        ])!!}
                                    </div>
                                </div>

                                @error('insurance_discount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror --}}
                            </div>








                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!Form::label('name', 'الشركة التي تم الحجز بواسطتها')!!}
                                            {!! Form::select('company_id', $companies, null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'إختر الشركة ',
                                            ])
                                            !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!Form::label('name', 'ملاحظات')!!}
                                            {!!Form::text('notes', null,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'ملاحظات'
                                            ])!!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('name','إختر طريقة الدفع')!!} <span class="text-danger font-weight-bolder">*</span>
                                            {!! Form::select('payment_method_id', $paymentMethods, null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'إختر طريقة الدفع',
                                            ])
                                            !!}
                                        </div>
                                    </div>
                                </div>


                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('تأكيد الحجز',[
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


    {{-- select doctore by specialist and branch --}}
    <script>
    $(document).ready(function () {
            $('select[name="specialist_id"]').on('change', function () {
                var specialist_id = $(this).val();
                var branch_id = $("#branch_id").val();

                if (specialist_id) {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("/admin/getDoctorsBySpecialistAndBranch") }}/" + specialist_id + "/" + branch_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
            
                            $('select[name="doctor_id"]').empty();
                            $('select[name="doctor_id"]').append('<option value=""  selected>إختر الطبيب </option>');
                            $.each(data, function (key, value) {

                                $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });



            var specialist_id = $('select[name="specialist_id"]').val();
            var branch_id = $("#branch_id").val();
        
            if (specialist_id) {

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getDoctorsBySpecialistAndBranch") }}/" + specialist_id + "/" + branch_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
        
                        $('select[name="doctor_id"]').empty();
                        $('select[name="doctor_id"]').append('<option value=""  selected>إختر الطبيب </option>');
                        $.each(data, function (key, value) {

                            $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    </script>
    {{-- select subspecialist by specialist --}}
    <script>
        $(document).ready(function () {
            $('select[name="specialist_id"]').on('change', function () {
                var specialist_id = $(this).val();
        
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
                            $('select[name="sub_specialist_id"]').empty();
                            $('select[name="sub_specialist_id"]').append('<option value=""  selected>إختر التخصص الفرعي</option>');
                            $.each(data, function (key, value) {

                                $('select[name="sub_specialist_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });



            var specialist_id = $('select[name="specialist_id"]').val();

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
                        $('select[name="sub_specialist_id"]').empty();
                        $('select[name="sub_specialist_id"]').append('<option value=""  selected>إختر التخصص الفرعي</option>');
                        $.each(data, function (key, value) {

                            $('select[name="sub_specialist_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    </script>


    {{-- select doctore by subspecialist --}}
    <script>
    $(document).ready(function () {
            $('select[name="sub_specialist_id"]').on('change', function () {
                var sub_specialist_id = $(this).val();
                var branch_id = $("#branch_id").val();

                if (sub_specialist_id) {
                
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("/admin/getDoctorsBySubSpecialistAndBranch") }}/" + sub_specialist_id + "/" + branch_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                    
                            $('select[name="doctor_id"]').empty();
                            $('select[name="doctor_id"]').append('<option value=""  selected>إختر الطبيب </option>');
                            $.each(data, function (key, value) {

                                $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });

                var sub_specialist_id = $('select[name="sub_specialist_id"]').val();
                var branch_id = $("#branch_id").val();
                
                if (sub_specialist_id) {
                
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("/admin/getDoctorsBySubSpecialistAndBranch") }}/" + sub_specialist_id + "/" + branch_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            console.log(data);
                            $('select[name="doctor_id"]').empty();
                            $('select[name="doctor_id"]').append('<option value=""  selected>إختر الطبيب </option>');
                            $.each(data, function (key, value) {

                                $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
        });
    </script>

    <script>
        $(document).ready(function() {
        $('.js-multiple').select2();
    });
    </script>

@endsection

