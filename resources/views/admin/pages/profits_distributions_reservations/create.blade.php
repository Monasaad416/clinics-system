
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تقسيم الارباح للحجز رقم {{ $reservation->number }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأرباح </span>
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
                            'route' => 'admin.profits_distributions_res.store',
                            ])
                        !!}

                           {!!Form::hidden('reservation_id', $reservation->id)!!}


                                    <div class="col my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','الإجمالي')!!}
                                            {!! Form::number('total', $reservation->reservation_price ,
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

                                    <div class="col my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','نسبة الطبيب  ')!!}
                                            {!! Form::number('doctor_profit', 0 ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'نسبة الطبيب',
                                            'step' => "any" ,
                                            'value' => 0,
                                            'id' => 'doctorProfit',
                                            ])
                                            !!}
                                        </div>
                                    </div>



                                    <div class="col my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','نسبة الشركة')!!}
                                            {!! Form::number('company_profit', null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'نسبة الشركة',
                                            'step' => "any" ,
                                            'id' => 'companyProfit',
                                            ])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','نسبة المركز ')!!}
                                            {!! Form::number('clinic_profit', 0 ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'نسبة المركز',
                                            'step' => "any" ,
                                            'readonly' => true,
                                            'id' => 'clinicProfit',
                                            ])
                                            !!}
                                        </div>
                                    </div>


          

                                </div>
                            </fieldset>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit(' حفظ الارباح',[
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

    $('#doctorProfit, #companyProfit').on('input', function() {
        const company_profit = parseFloat($('#companyProfit').val()) || 0;
        const doctor_profit = parseFloat($('#doctorProfit').val());
        const total = parseFloat($('#total').val());
        $("#clinicProfit").val(parseFloat(total - company_profit - doctor_profit).toFixed(2));
    });


</script>


@endpush

@endsection

