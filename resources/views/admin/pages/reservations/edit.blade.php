
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تحديث الحجز رقم {{ $reservation->number }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الحجوزات</span>
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

                        @php
                            $branches = App\Models\Branch::pluck('name_ar', 'id');
                            // $services = App\Models\Service::where('branch_id',$reservation->branch_id)->get();
                            // $servicesIds = $reservation->services()->pluck('service_id')->toArray();
                            $pluck = App\Models\PaymentMethod::pluck('name_ar', 'id');
                            $specialists = App\Models\Specialist::all();

                            $doctorsIds = DB::table("doctor_sub_specialist")->where("sub_specialist_id",$reservation->sub_specialist_id)->pluck('doctor_id');
                            $doctors = $doctorsIds->count() != 0 ?
                            App\Models\Doctor::whereIn('id',$doctorsIds)->get() :
                            App\Models\Doctor::where('branch_id',$reservation->branch_id)
                            ->where('specialist_id',$reservation->specialist_id)->get() ;
                            $companies = App\Models\Company::pluck('name','id')


                        @endphp


                        @include('inc.errors')
                        {!! Form::model($reservation,[
                            'route' =>['admin.reservations.update',$reservation],
                            ])
                        !!}

                        {{ method_field('PUT')}}


                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('name','الفرع ')!!} <span class="text-danger font-weight-bolder">*</span>
                                @if(Auth::user()->roles_name == ["superadmin"])
                                    <div class="form-group">
                                        {!! Form::select('branch_id', $branches, $reservation->branch_id ,
                                            ['class' => 'form-control mt-1 mb-3',
                                            'placeholder' => 'إختر الفرع',
                                            'id' => 'branch_id'
                                            ])
                                        !!}
                                    </div>
                                @else
                                {{-- {{ dd(Auth::user()->branch->id)}} --}}
                                    <div class="form-group">
                                        <select name='branch_id' class="form-control" id="branch_id">
                                            <option value="{{(Auth::user()->branch_id)}}" >{{(Auth::user()->branch->name_ar)}}</option>
                                        </select>
                                    </div>
                                @endif
                            </div>

                            @error('branch_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror



                            <div class="col-md-3">
                                 {!! Form::label('name','التخصص الرئيسي ')!!} <span class="text-danger font-weight-bolder">*</span>
                                 <select class="form-control mt-1 mb-3" name="specialist_id">
                                    <option value="">--إختر التخصص الرئيسي--</option>
                                    @foreach($specialists as $specialist)
                                        <option value="{{ $specialist->id }}" {{ $reservation->doctor->specialist_id  == $specialist->id ? 'selected' : ''}}>{{ $specialist->name_ar }}</option>
                                    @endforeach
                                 </select>

                            </div>

                            @error('specialist_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                               <div class="col-md-3">
                                 {!! Form::label('name','التخصص الفرعي ')!!}
                                 <select class="form-control mt-1 mb-3" name="sub_specialist_id" >
                                    <option value="0">--إختر التخصص الفرعي--</option>
                                    @foreach($subSpecialists as $subSpecialist)
                                        <option value="{{ $subSpecialist->id }}" {{ $reservation->sub_specialist_id  === $subSpecialist->id ? 'selected' : '' }}>{{ $subSpecialist->name_ar }}</option>
                                    @endforeach
                                 </select>

                            </div>
                            @error('sub_specialist_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('name','إختر الطبيب')!!} <span class="text-danger font-weight-bolder">*</span>
                                    <select class="form-control mt-1 mb-3 " name="doctor_id" >
                                    <option value="">--إختر الطبيب --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ $reservation->doctor_id == $doctor->id ? 'selected' : ''}}>{{ $doctor->name_ar }}</option>
                                    @endforeach
                                 </select>
                                </div>
                            </div>
                              @error('doctor_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                        </div>


                        <div class="row">


                            <div class="col-md-4">
                                <div class="form-group">
                                {!! Form::label('name','إسم العميل ')!!}<span class="text-danger font-weight-bolder">*</span>
                                    {!!Form::text('name', $reservation->client->name,[
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
                                    {!!Form::text('phone', $reservation->client->phone,[
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
                                    {!!Form::label('name','تاريخ ميلاد العميل ')!!} <span class="text-danger font-weight-bolder">*</span>
                                    {!!Form::date('date_of_birth', $reservation->client->date_of_birth,[
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
                          <input type="date" value={{ $reservation->date }} name="date" class ="form-control  mt-1 mb-3">

                            </div>
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                              <div class="col-md-6">
                            {!!Form::label('name', 'إدخل توقيت الحجز') !!} <span class="text-danger font-weight-bolder">*</span>
                           <input type="time" value={{ $reservation->time }} name="time" class ="form-control  mt-1 mb-3">


                            </div>

                              @error('time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>




                               <div class="form-group">
                                {!!Form::label('name', 'حالة الحجز')!!} <span class="text-danger font-weight-bolder">*</span>
                                <br>
                                <input type="radio" name="status" value='pending' {{ $reservation->status == "pending" ? 'checked' : ''}}> حجز موعد <br>
                                <input type="radio" name="status" value='completed' {{ $reservation->status == "completed" ? 'checked' : ''}}> اتم الزيارة <br>
                                 <input type="radio" name="status" value='canceled'  {{ $reservation->status == "canceled" ? 'checked' : ''}}> إلغاء الموعد <br>
                                <input type="radio" name="status" value='absent' {{ $reservation->status == "absent" ? 'checked' : ''}}> لم يحضر <br>

                            </div>
                           <hr>

                            <div class="form-group">
                                {!!Form::label('name', 'نوع الحجز')!!} <span class="text-danger font-weight-bolder">*</span>
                                <br>
                                <input type="radio" name="type" value='first_visit' {{ $reservation->type == "first_visit" ? 'checked' : ''}}> كشف<br>
                                <input type="radio" name="type" value="sec_visit" {{ $reservation->type == "sec_visit" ? 'checked' : ''}}> إستشارة  <br>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                    {!!Form::label('name', ' % النسبة المئوية لتحمل التأمين بدون ')!!}
                                        {!!Form::number('insurance_percentage', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => '% النسبة المئوية لتحمل التأمين بدون ',
                                             'step'=>'any',
                                        ])!!}
                                    </div>
                                </div>
                                @error('insurance_percentage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-md-4">
                                    <div class="form-group">
                                    {!!Form::label('name', ' خصم التأمين')!!}
                                        {!!Form::number('insurance_discount', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => ' خصم التأمين  ',
                                             'step'=>'any',
                                        ])!!}
                                    </div>
                                </div>

                                @error('insurance_discount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            {!! Form::select('payment_method_id', $pluck, null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => 'إختر طريقة الدفع',
                                            ])
                                            !!}
                                        </div>
                                    </div>
                            </div>

                            <input type="hidden" name="id" value="{{ $reservation->id }}">

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                {!!Form::submit('تحديث الحجز',[
                                    'class' =>'btn btn-secondary btn-flat'
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
                        $('select[name="doctor_id"]').append('<option value="disabled">إختر الطبيب </option>');
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
                        $('select[name="sub_specialist_id"]').append('<option value="0" selected disabled>إختر التخصص الفرعي</option>');
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
            console.log(sub_specialist_id,branch_id);

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
                        $('select[name="doctor_id"]').append('<option value="0" selected >إختر الطبيب </option>');
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
    $(document).ready(function() {
    $('.js-multiple').select2();
});
</script>

@endsection
