
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة حجز خدمة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ حجز الخدمات</span>
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
                            $specialists = App\Models\Specialist::pluck('name_ar', 'id');
                            $branches = App\Models\Branch::pluck('name_ar', 'id');
                            $employees = [];
                            $subSpecialists = [];
                            $doctors = [];
                            $services = App\Models\Service::pluck('name_ar', 'id');;
                            $paymentMethods = App\Models\PaymentMethod::pluck('name_ar', 'id');
                            $companies = App\Models\Company::pluck('name', 'id');
                        @endphp

                        @include('inc.errors')
                        {!! Form::model($model,[
                            'route' => 'admin.services_bookings.store',
                            ])
                        !!}
                        <div class="row">
                            <div class="col-md-4 my-4">
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
                            <div class="col-md-4 my-4">
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

                            <div class="col-md-4 my-4">
                                 {!! Form::label('name','التخصص الفرعي ')!!}
                                 {!! Form::select('sub_specialist_id', $subSpecialists, null ,
                                    ['class' => 'form-control mt-1 mb-3',
                                    'placeholder' => 'إختر التخصص الفرعي',
                                    ])
                                !!}
                            </div>

                            @error('sub_specialist_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                {!! Form::label('name','إسم العميل ')!!}
                                    {!!Form::text('name', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إسم العميل ',
                                        'id' => 'name',
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
                                        'placeholder' => 'رقم هاتف العميل ',
                                         'id' => 'phone',
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
                                        'placeholder' => ' تاريخ ميلاد العميل ',
                                         'id' => 'date_of_birth',
                                    ])!!}
                                </div>
                            </div>
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 my-4 my-4">
                                <div class="form-group">
                                    {!! Form::label('name',' القائم بالخدمة')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!! Form::select('user_type',['doctor' => 'طبيب', 'employee' => 'موظف'],null ,['class' => 'form-control'])!!}
                                </div>
                            </div>
                            <div class="col-md-6 my-4 my-4 doctor">
                                <div class="form-group">
                                    {!! Form::label('name',' الطبيب')!!}
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

                            <div class="col-md-6 my-4 my-4 employee">
                                <div class="form-group">
                                    {!! Form::label('name',' الموظف')!!}
                                    {!! Form::select('employee_id', $employees, null ,
                                    ['class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => 'إختر الموظف',
                                    ])
                                    !!}
                                </div>
                            </div>
                            @error('doctor_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>



                        <div class="row">
                            <div class="col-md-6 my-5">
                                {!! Form::label('name','الخدمة  ')!!}
                                 {!! Form::select('service_id', $services, null ,
                                    ['class' => 'form-control mt-1 mb-3',
                                    'placeholder' => 'إختر الخدمة ',
                                    ])
                                !!}
                            </div>

                            <div class="col-md-6 my-5">
                                <div class="form-group">
                                    <label for="">سعر الخدمة </label>
                                    <input type="number" class="form-control" id="service_price" name="service_price" step="any" placeholder="أدخل سعر الخدمة">
                                </div>
                            </div>
                        </div>



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
                                        {!!Form::number('insurance_percentage', 0,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'ادخل النسبة المئوية لتحمل التأمين بدون % مثال (10) ',
                                            'step'=>'any',
                                               'id' => 'insurancePercentage',

                                        ])!!}
                                    </div>
                                </div>
                                @error('insurance_percentage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                          <div class="col-md-6 my-4">
                                    <div class="form-group">
                                        {!! Form::label('name','مبلغ الخصم  ')!!}
                                        {!! Form::number('discount', 0 ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'مبلغ الخصم   ',
                                        'step' => "any" ,
                                        'value' => 0,
                                        'id' => 'discount',
                                        ])
                                        !!}
                                    </div>
                                </div>

                                <div class="col-md-6 my-4">
                                    <div class="form-group">
                                        {!! Form::label('name','الإجمالي')!!}
                                        {!! Form::number('total', null ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إجمالي المبلغ',
                                        'step' => "any" ,
                                        'value' => 0,
                                        'readonly' => true,
                                        'id' => 'total',
                                        ])
                                        !!}
                                    </div>
                                </div>
                            </div>






                        <div class="row">
                            <div class="col-md-6 my-4">
                            {!!Form::label('name', 'إدخل يوم الحجز') !!} <span class="text-danger font-weight-bolder">*</span>
                            {!!Form::date('date', null,[
                                'class' => 'form-control  mt-1 mb-3',
                            ])!!}

                            </div>
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                              <div class="col-md-6 my-4">
                                   {!!Form::label('name', 'إدخل توقيت الحجز') !!} <span class="text-danger font-weight-bolder">*</span>
                            {!!Form::time('time', null,[
                                'class' => 'form-control  mt-1 mb-3',
                            ])!!}


                            </div>

                              @error('time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>







                            {{-- <div class="form-group">
                                {!!Form::label('name', 'حالة الحجز')!!} <span class="text-danger font-weight-bolder">*</span>
                                <br>
                                {!!Form::radio('status', 'pending')!!} حجز خدمة <br>
                                {!!Form::radio('status', 'completed')!!} أتم الخدمة <br>
                                {!!Form::radio('status', 'canceled')!!} إلغاء الخدمة <br>
                                {!!Form::radio('status', 'absent')!!} لم يحضر المريض <br>

                            </div>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}
                            <hr>


                  





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
                                    {!!Form::submit(' حفظ  وتقسيم الأرباح',[
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



{{-- select who will apply service doctor or employee --}}
<script>
  $(document).ready(function () {
        $('.employee').hide();
        $('select[name="user_type"]').on('change', function () {
            var type = $(this).val();
            if (type == 'employee') {
                $('.doctor').hide();
                $('.employee').show();
            } else {
                $('.doctor').show();
                 $('.employee').hide();

            }
        });
    });
</script>


{{-- select doctore by specialist and branch --}}
<script>
  $(document).ready(function () {
        $('select[name="specialist_id"]').on('change', function () {
            var specialist_id = $(this).val();
            var branch_id = $("#branch_id").val();
            console.log("jjjjjjj");
            console.log(branch_id);

            if (specialist_id) {
                console.log(specialist_id);
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
                        console.log(data);
                        $('select[name="doctor_id"]').empty();
                        $('select[name="doctor_id"]').append('<option value=""selected disabled>إختر الطبيب </option>');
                        $.each(data, function (key, value) {

                            $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

{{-- select employees by branch --}}
<script>
  $(document).ready(function () {
        $('select[name="branch_id"]').on('change', function () {

            var branch_id = $("#branch_id").val();
            console.log(branch_id);
            if (branch_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getEmployeesByBranch") }}/" + branch_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        console.log(data);
                        $('select[name="employee_id"]').empty();
                        $('select[name="employee_id"]').append('<option value="">إختر الموظف </option>');
                        $.each(data, function (key, value) {

                            $('select[name="employee_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


{{-- get client data by phone number --}}
<script>
    $('#phone').on('focusout', function() {
  const phone = $(this).val();
  console.log(phone);

  $.ajax({
    url: "{{ URL::to("/admin/getClientByPhone") }}/" + phone,
    data: { phone: phone },
    dataType: 'json',
    success: function(data) {
        console.log(data);
      if (data) {
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#date_of_birth').val(data.date_of_birth);
      }else {
        alert('Please select')
      }
    }
  });
});
</script>
{{-- select subspecialist by specialist --}}
<script>
  $(document).ready(function () {
        $('select[name="specialist_id"]').on('change', function () {
            var specialist_id = $(this).val();
            //console.log(specialist_id);
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
                        $('select[name="sub_specialist_id"]').append('<option value="" selected disabled>إختر التخصص الفرعي</option>');
                        $.each(data, function (key, value) {

                            $('select[name="sub_specialist_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


{{-- select doctore by subspecialist --}}
<script>
  $(document).ready(function () {
        $('select[name="sub_specialist_id"]').on('change', function () {
            var sub_specialist_id = $(this).val();
            var branch_id = $("#branch_id").val();
            console.log(sub_specialist_id);
            console.log(branch_id);


            if (sub_specialist_id) {
                console.log(sub_specialist_id);
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
                        $('select[name="doctor_id"]').append('<option value="" selected disabled>إختر الطبيب </option>');
                        $.each(data, function (key, value) {

                            $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

{{-- select days by doctor --}}
<script>
  $(document).ready(function () {
        $('select[name="doctor_id"]').on('change', function () {
            var doctorId = $(this).val();
            console.log(doctorId);



            if (doctorId ) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getDaysByDoctor") }}/" + doctorId ,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                      console.log(data)

                        $('select[name="day_id"]').empty();
                        $('select[name="day_id"]').append('<option value=""selected disabled>إختر الموعد </option>');
                          $.each(data, function (key, value) {

                            $('select[name="day_id"]').append('<option value="' + key + '">' + value[days] + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

{{-- select services by branch --}}
{{-- <script>
  $(document).ready(function () {
        $('select[name="branch_id"]').on('change', function () {
            var branchId = $(this).val();
            console.log(branchId);

            if (branchId ) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getServicesByBranch") }}/" + branchId ,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                      console.log(data)

                        $('select[name="service_ids[]"]').empty();
                        $('select[name="service_ids[]"]').append('<option value="selected disabled">إختر الخدمات الإضافية </option>');
                          $.each(data, function (key, value) {

                            $('select[name="service_ids[]"]').append('<option value="' + key + '">' + value+ '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
    $('.js-multiple').select2();
});
</script>



<script>
    // $('#service_price').on('focusout',function(){
    //     const servicePrice = $(this).val();
    //     console.log(servicePrice);


    //          $('#user_profit, #company_profit ').on('input', function() {
    //         const company_profit = parseFloat($('#company_profit').val()) || 0;
    //         console.log(company_profit);
    //         const user_profit = parseFloat($('#user_profit').val());
    //         $("#clinic_profit").val(parseFloat(servicePrice - company_profit - user_profit).toFixed(2));
    //         });
    // })




        $('#service_price').on('keyup',function(){
            const totalPrice = $(this).val();
            $('#total').val(totalPrice);


            $('#discount, #insurancePercentage').on('input', function() {
                const discount = parseFloat($('#discount').val()) || 0;
                const insurance_percentage = parseFloat($('#insurancePercentage').val()) || 0;
                const insurance_discount = insurance_percentage * totalPrice /100;
                console.log(insurance_percentage);

                $("#total").val(parseFloat(totalPrice - discount - insurance_discount).toFixed(2));
            });

        })






</script>

@endsection

