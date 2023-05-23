
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تقسيم الارباح للخدمة رقم {{ $serviceBooking->number }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأرباح </span>
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

                        @inject('model', 'App\Models\ServiceBooking')
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
                            'route' => 'admin.profits_distributions_serv.store',
                            ])
                        !!}

                           {!!Form::hidden('service_booking_id', $serviceBooking->id)!!}


                                    <div class="col my-4">
                                        <div class="form-group">
                                            {!! Form::label('name','الإجمالي')!!}
                                            {!! Form::number('total', $serviceBooking->final_price ,
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
                                            {!! Form::label('name','نسبة القائم بالخدمة  ')!!}
                                            {!! Form::number('user_profit', null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'نسبة القائم بالخدمة',
                                            'step' => "any" ,
                                            'id' => 'userProfit',
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

    $('#userProfit, #companyProfit').on('input', function() {
        const company_profit = parseFloat($('#companyProfit').val()) || 0;
        const user_profit = parseFloat($('#userProfit').val());
        const total = parseFloat($('#total').val());
        $("#clinicProfit").val(parseFloat(total - company_profit - user_profit).toFixed(2));
    });


</script>


@endpush

@endsection

