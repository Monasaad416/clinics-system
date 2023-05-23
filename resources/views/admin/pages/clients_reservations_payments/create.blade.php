
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">دفع رسوم الكشف للحجز رقم {{ $reservation->number }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أذونات القبض</span>
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
                            'route' => 'admin.clients_reservations_payments.store',
                            ])
                        !!}

                           {!!Form::hidden('reservation_id', $reservation->id)!!}
                            <fieldset >
                                <legend>  الكشف</legend>
                                <div class="row">
                                        <div class="col-6 my-4">
                                            <input class="form-check-input" id="firstVisit" type="radio" name="selected_type" value="firstVisit" id="flexCheckChecked" >
                                            <label class="form-check-label mx-3 my-2" for="flexCheckChecked">
                                            كشف جديد
                                            </label>
                                            <input type="number" class="form-control" id="firstVisitFees" step="any" name="first_visit_fees" min="0" value={{$reservation->doctor->fees}} readonly />
                                        </div>

                                        <div class="col-6 my-4">
                                            <input class="form-check-input" id="secVisit" type="radio" name="selected_type" value="secVisit" {{$reservation->type == "sec_visit" ? 'checked' : ''}}id="flexCheckChecked" >
                                            <label class="form-check-label mx-3 my-2" for="flexCheckChecked">
                                                إستشارة
                                            </label>
                                            <input type="number" class="form-control" id="secVisitFees" step="any" name="sec_visit_fees" min="0" value="0"  />
                                        </div>
                                </div>
                            </fieldset>
                            <hr>

                            <fieldset >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group my-3">
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
                                            <div class="form-group my-3">
                                            {!!Form::label('name', ' % النسبة المئوية لتحمل التأمين')!!}
                                                {!!Form::number('insurance_percentage', $reservation->insurance_percentage ? $reservation->insurance_percentage : 0,[
                                                    'class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => '% النسبة المئوية لتحمل التأمين  ',
                                                    'step' => 'any',
                                                    'id' => 'insurancePercentage',
                                                    'readonly' => true,

                                                ])!!}
                                            </div>
                                        </div>
                                        @error('insurance_percentage')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-md-6 my-3">
                                            <div class="form-group">
                                                {!!Form::label('name', ' إسم الشركة التي تم الحجز بواسطتها ')!!}
                                                {!!Form::text('company', $reservation->company,[
                                                    'class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => 'إسم الشركة'
                                                ])!!}
                                            </div>
                                        </div>

                                        @error('company')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="col-md-6 my-3">
                                            <div class="form-group">
                                            {!!Form::label('name', 'مبلغ خصم الشركة ')!!}
                                                {!!Form::number('company_discount', 0,[
                                                    'class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => 'المبلغ   ',
                                                    'step' => 'any',
                                                    'id' => 'companyDiscount',
                                                ])!!}
                                            </div>
                                        </div>
                                        @error('company_discount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div> --}}
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

                                    {{-- <div class="col-md-6 my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','المبلغ المدفوع  ')!!}
                                            {!! Form::number('paid_amount', null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'المبلغ المدفوع   ',
                                            'step' => "any" ,
                                            'id' => 'partPaid',
                                            ])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','المبلغ المتبقي للعيادة  ')!!}
                                            {!! Form::number('remaining_amount', 0 ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'المبلغ المتبقي للعيادة   ',
                                            'step' => "any" ,
                                            'readonly' => true,
                                            'id' => 'remainingAmount',
                                            ])
                                            !!}
                                        </div>
                                    </div> --}}


                                    <div class="col-md-6 my-4">
                                        <div class="form-group">
                                            {!! Form::label('name',' ملاحظات')!!}
                                            {!! Form::textarea('notes', null, [
                                                'class'      => 'form-control',
                                                'rows'       => 2,
                                                'name'       => 'notes',
                                                'id'         => 'notes',
                                                'onkeypress' => "return nameFunction(event);"
                                            ]) !!}
                                        </div>
                                    </div>
                                    @error('notes')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-6 my-4">
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
                            </fieldset>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('حفظ وتقسيم الارباح',[
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
    $('input[type="radio"]').on('click change', function(e) {
        if ($('input[name="selected_type"][value="firstVisit"]').is(':checked')) {
            //console.log("The first radio button is currently selected.");

            const fees = parseFloat($("#firstVisitFees").val());
            const insurance_percentage =  parseFloat($("#insurancePercentage").val()) || 0;
            const insurance_discount =  parseFloat(insurance_percentage * fees / 100) || 0;

            $("#total").val(parseFloat(fees - insurance_discount).toFixed(2));

            $('#partPaid').on('input', function() {
                const part_paid = parseFloat($('#partPaid').val()) || 0;
                $("#remainingAmount").val(parseFloat(fees - insurance_discount - part_paid).toFixed(2));
                console.log(part_paid);
            });



            $('#discount, #companyDiscount').on('input', function() {
                const company_discount = parseFloat($('#companyDiscount').val()) || 0;
                const discount = parseFloat($('#discount').val()) || 0;
                $("#total").val(parseFloat(fees - insurance_discount - company_discount - discount).toFixed(2)); ;

                $('#partPaid').on('input', function() {
                const part_paid = parseFloat($('#partPaid').val()) || 0;
                $("#remainingAmount").val(parseFloat(fees - insurance_discount - company_discount - discount - part_paid).toFixed(2));
                console.log(part_paid);
            });
            });



        } else if($('input[name="selected_type"][value="secVisit"]').is(':checked')){
            console.log("kkkkkk");
            $("#total").val(0);

            $('#discount, #companyDiscount , #secVisitFees').on('input', function() {
                const fees = parseFloat($("#secVisitFees").val());
                const insurance_percentage =  parseFloat($('#insurancePercentage').val()) || 0;
                const insurance_discount =  parseFloat(insurance_percentage * fees / 100) || 0;
                const company_discount = parseFloat($('#companyDiscount').val()) || 0;
                const discount = parseFloat($('#discount').val()) || 0;
                $("#total").val(parseFloat(fees - company_discount - insurance_discount - discount).toFixed(2));
                $('#partPaid').on('input', function() {
                const part_paid = parseFloat($('#partPaid').val()) || 0;
                $("#remainingAmount").val(parseFloat(fees - company_discount - insurance_discount - discount - part_paid).toFixed(2));
                console.log(part_paid);
            });
                console.log( "jjjjkkkkkkkkkkkjjj");
            });

        }
    });




</script>


    <script>
        $(document).ready(function () {
            $('select[name="type_id"]').on('change', function () {
                let modelName;
                if( $(this).val() == 'doctor') {
                     modelName = 'Doctor'
                } else {
                     modelName = 'User'
                };
                $('select[name="branch_id"]').on('change', function () {
                    let branchId = $(this).val();
                    console.log(branchId);
                       if (modelName) {
                    $.ajax({
                        url: "{{ URL::to('/admin/getNamesByJob') }}/" + modelName + '/' + branchId ,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            $('select[name="employee_id"]').empty();
                             $('select[name="employee_id"]').append('<option value="" selected disabled >إختر الإسم</option>');
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
                let doctorId = $(this).val();
                let locale = '{{ App::getLocale()}}';
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

