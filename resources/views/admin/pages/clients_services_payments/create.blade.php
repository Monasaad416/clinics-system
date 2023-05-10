
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة سند قبض من للعميل للحجز {{ $reservation->number }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سندات القبض</span>
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
                        @endphp

                        @include('inc.errors')
                        {!! Form::model($model,[
                            'route' => 'admin.client_payment.store',
                            ])
                        !!}

                    <fieldset class="my-4">
                        <legend>  الكشف</legend>
                        <div class="row">
                                <div class="col-6">
                                    <input class="form-check-input" id="firstVisit" type="radio" name="selected_type" value="firstVisit" {{$reservation->type == "first_visit" ? 'checked' : ''}} id="flexCheckChecked" >
                                    <label class="form-check-label mx-3 my-2" for="flexCheckChecked">
                                    كشف جديد
                                    </label>
                                    <input type="number" class="form-control" id="firstVisitFees" step="any" name="first_visit_fees" min="0" value={{$reservation->doctor->fees}} readonly />
                                </div>

                                <div class="col-6">
                                    <input class="form-check-input" id="secVisit" type="radio" name="selected_type" value="secVisit" {{$reservation->type == "sec_visit" ? 'checked' : ''}}id="flexCheckChecked" >
                                    <label class="form-check-label mx-3 my-2" for="flexCheckChecked">
                                        إستشارة
                                    </label>
                                     <input type="number" class="form-control" id="secVisitFees" step="any" name="sec_visit_fees" min="0" value="0"  />
                                </div>
                        </div>
                    </fieldset>
                    <hr>


                    <fieldset class="my-4">
                        <legend> الخدمات الإضافية </legend>

                                <div class="row">
                                    {{-- <div class="col">
                                        <div class="form-group">
                                            {!!Form::label('name', 'الخدمات الإضافية ')!!}
                                            <select name="service_ids[]" class="form-control js-multiple" multiple>
                                            <option value="">إختار الخدمات الإضافية</option>
                                            @foreach (Auth::user()->branch->services as $service)
                                                <option value="{{ $service->id }}">{{$service->name_ar}}</option>
                                            @endforeach

                                            </select>
                                        </div>
                                    </div> --}}
                                    @php
                                    $total= 0;
                                        foreach($reservation->services as $service){
                                            $serviceFees = App\Models\Service::where('id',$service->id)->first()->price;
                                            $total += $serviceFees;
                                        }


                                    @endphp

                                    <div class="col">
                                
                                    <label class="form-check-label mx-3 my-2" for="flexCheckChecked">
                                        مبلغ الخدمات اللإضافية
                                    </label>
                                     <input type="number" class="form-control" id="servicesFees" step="any" name="services_fees" min="0" value="{{$total}}" readonly />
                                    </div>
                                    </div>


                                    {{-- <div class="col-md-6 my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','المبلغ المتبقي من الخدمات')!!}
                                            {!! Form::number('remaining_amount_ser', null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'المبلغ المتبقي من الخدمات ',
                                            'step' => "any" ,
                                            ])
                                            !!}
                                        </div>
                                    </div>
                                    </div>
                          --}}


                                 <input type="hidden" name="reservation_id" value= {{ $reservation->id }}>
                    </fieldset>


                    <fieldset>


                    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!!Form::label('name', ' إسم شركة التأمين')!!}
                                        {!!Form::text('insurance', $reservation->insurance,[
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
                                    {!!Form::label('name', ' % النسبة المئوية لتحمل التأمين  ')!!}
                                        {!!Form::number('insurance_percentage', $reservation->insurance_percentage,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => '% النسبة المئوية لتحمل التأمين  ',
                                            'step' => 'any',
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

                       

                            {{-- <div class="col-md-6 my-4">
                                <div class="form-group">
                                    {!! Form::label('name','إجمالي المبلغ')!!}
                                    {!! Form::number('remaining_amount', null ,
                                    ['class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => '  إجمالي المبلغ  ',
                                    'step' => "any" ,
                                    'readonly' => 'true',
                                    'id' =>'total',
                            
                                    ])
                                    !!}
                                </div>
                            </div> --}}
                           <div class="col-md-4 my-4">
                                <div class="form-group">
                                    {!! Form::label('name','مبلغ الخصم  ')!!}
                                    {!! Form::number('discount', null ,
                                    ['class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => 'مبلغ الخصم   ',
                                    'step' => "any" ,
                                    'value' => 0,
                                    ])
                                    !!}
                                </div>
                            </div>

                            <div class="col-md-4 my-4">
                                <div class="form-group">
                                    {!! Form::label('name','المبلغ المدفوع  ')!!}
                                    {!! Form::number('paid_amount', null ,
                                    ['class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => 'المبلغ المدفوع   ',
                                    'step' => "any" ,
                                    ])
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4 my-4">
                                <div class="form-group">
                                    {!! Form::label('name','المبلغ المتبقي للعيادة  ')!!}
                                    {!! Form::number('remaining_amount', null ,
                                    ['class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => 'المبلغ المتبقي للعيادة   ',
                                    'step' => "any" ,
                                    ])
                                    !!}
                                </div>
                            </div>


                            <div class="col-md-6 my-4">
                                <div class="form-group">
                                    {!! Form::label('name',' ملاحظات')!!}
                                    {!! Form::textarea('notes', null, [
                                        'class'      => 'form-control',
                                        'rows'       => 2,
                                        'name'       => 'txt',
                                        'id'         => 'txt',
                                        'onkeypress' => "return nameFunction(event);"
                                    ]) !!}
                                </div>
                            </div>
                            @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-md-6 my-4">
                                <div class="form-group">
                                    {!! Form::label('name','إختار طريقة الدفع')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!! Form::select('payment_method_id', $paymentMethods, null ,
                                    ['class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => 'إختار طريقة الدفع',
                                    ])
                                    !!}
                                </div>
                            </div>

                        </div>
                    </fieldset>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('تأكيد الدفع ',[
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
            </div>
        </div>
    </div>
@endsection
@section('js')
@push('scripts')

<script>
    $(document).ready(function() {
    $('.js-multiple').select2();
});
</script>


    <script>

    document.getElementById("firstVisit").addEventListener('click', function (event) {
        if (event.target && event.target.matches("input[type='radio']")) {
            var fees = parseFloat(document.getElementById("firstVisitFees").value);
            console.log(fees);
            var servicesFees = parseFloat(document.getElementById("servicesFees").value);

            var total= parseFloat(fees + servicesFees);
            document.getElementById("total").value = total;

        }
    });

    document.getElementById("secVisit").on('change', function() {
                    document.getElementById("total").setAttribute('value',0);
              });
    document.getElementById("secVisit").addEventListener('click', function (event) {
        if (event.target && event.target.matches("input[type='radio']")) {
            document.getElementById("total").setAttribute('value', "0" );
              document.getElementById("secVisit").on('change', function() {
                    document.getElementById("total").setAttribute('value',0);
              });
              var fees = parseFloat(document.getElementById("secVisitFees").value);
              console.log(fees); 
              var servicesFees = parseFloat(document.getElementById("servicesFees").value);

            var total= parseFloat(fees + servicesFees);
            document.getElementById("total").value = total;
        }
    });
    </script>




{{-- select services by branch --}}
<script>
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
                        $('select[name="service_ids[]"]').append('<option value="selected disabled">إختار الخدمات الإضافية </option>');
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
                        $('select[name="doctor_id"]').append('<option value="selected disabled">إختار الطبيب </option>');
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
                        $('select[name="sub_specialist_id"]').append('<option value="0" selected disabled>إختار التخصص الفرعي</option>');
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
                        $('select[name="doctor_id"]').append('<option value="selected disabled">إختار الطبيب </option>');
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
    <script>
        $(document).ready(function () {
            $('select[name="type_id"]').on('change', function () {
                var modelName;
                if( $(this).val() == 'doctor') {
                     modelName = 'Doctor'
                } else {
                     modelName = 'User'
                };
                $('select[name="branch_id"]').on('change', function () {
                    var branchId = $(this).val();
                    console.log(branchId);
                       if (modelName) {
                    $.ajax({
                        url: "{{ URL::to('/admin/getNamesByJob') }}/" + modelName + '/' + branchId ,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            $('select[name="employee_id"]').empty();
                             $('select[name="employee_id"]').append('<option value="" selected disabled >إختار الإسم</option>');
                            $.each(data, function (key, value) {
                                $('select[name="employee_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
                });

                console.log(modelName);

            });
        });
    </script>



    {{-- get fees by doctor --}}
    <script>
    $(document).ready(function () {
            $('select[name="doctor_id"]').on('change', function () {
                var doctorId = $(this).val();
                var locale = '{{ App::getLocale()}}';
                console.log(doctorId);
                if (doctorId) {

                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("/admin/getFeesByDoctor") }}/" + doctorId,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            $('#fees').val(data[doctorId]);

                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endpush

@endsection

