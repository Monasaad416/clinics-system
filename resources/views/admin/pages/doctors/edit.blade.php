
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
                <h4 class="content-title mb-0 my-auto">تحديث بيانات الطبيب</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأطباء</span>
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
                            @php
                                $departments = App\Models\Department::pluck('name_ar', 'id');
                                $branches = App\Models\Branch::pluck('name_ar', 'id');
                                $doctorTitles = App\Models\DoctorTitle::pluck('name_ar', 'id');
                                $professionalTitles = App\Models\ProfessionalTitle::pluck('name_ar', 'id');
                                $specialists = App\Models\Specialist::pluck('name_ar', 'id');
                                $sub_specialists = [];
                                $days = App\Models\Day::all();
                            @endphp
                            
                            @include('inc.errors')

                            {!! Form::model($doctor,[
                                'route' => ['admin.doctors.update',$doctor->id],
                                'files' =>true,
                                ])
                            !!}

                            {{ method_field('PUT')}}
                            <div class="">
                                <h3>البيانات الأساسية للطبيب</h3>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!Form::label('name_en', ' الأسم باللغة الإنجليزية:')!!}
                                                {!!Form::text('name_en', null,[
                                                    'class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => 'أدخل الأسم بالإنجليزية'
                                                ])!!}
                                            </div>
                                        </div>

                                        <div class="col-md">

                                            <div class="form-group">
                                                {!!Form::label('name_ar', ' الإسم  باللغة العربية:')!!}
                                                {!!Form::text('name_ar', null,[
                                                    'class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => 'أدخل الإسم بالعربية'
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
                                            {!!Form::label('about_ar', 'نبذة عن الطبيب باللغة العربية:')!!}
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!!Form::label('name', 'الهاتف:')!!}
                                                {!!Form::text('phone', null,[
                                                    'class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => 'أدخل رقم الهاتف '
                                                ])!!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>الجنس:</label>
                                                <select name='gender' class ='form-control mt-1 mb-3'>
                                                    <option value="1" {{ $doctor->gender == 1 ? 'selected' : '' }}>ذكر</option>
                                                    <option value="2" {{ $doctor->gender == 2 ? 'selected' : '' }}>أنثي</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="">
                                <h3>التخصص</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::select('doctor_title_id', $doctorTitles, null ,
                                                ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => ' إختر المسمي الوظيفي ',
                                                ])
                                            !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::select('professional_title_id', $professionalTitles, null ,
                                                ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => ' إختر اللقب المهني ',
                                                ])
                                            !!}
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        {!! Form::select('specialist_id', $specialists, null ,
                                            ['class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => ' إختر التخصص الرئيسي',
                                            ])
                                        !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>إختر التخصص الفرعي</label>
                                            <select style="border-color: gray" class="js-example-basic-multiple form-control" name="sub_specialist_ids[]" multiple="multiple">
                                            <option value="">إخترالتخصص الفرعي  </option>
                                                @php
                                                    $doctorSSpecialistsIds = DB::table('doctor_sub_specialist')->where('doctor_id', $doctor->id)->pluck('sub_specialist_id')->toArray();
                                                @endphp

                                                @foreach($doctor->specialist->subSpecialists as $subSp)

                                                @if(in_array($subSp->id ,$doctorSSpecialistsIds))
                                                <option value="{{$subSp->id}}" selected>{{$subSp->name_ar}} </option>
                                                @else
                                                <option value="{{$subSp->id}}" >{{$subSp->name_ar}} </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row my-4">
                                    <div class="col-md-4">
                                        <input type="file" class="my-2" name="professional_image">
                                        @if($doctor->professional_image)
                                        <img width="70px" src="{{ url('uploads/doctors'.'/'.$doctor->professional_image) }}">
                                        @endif
                                        <br> <span class="text-muted"> صورةإثبات بطاقة مزاولة المهنة </span>

                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="my-2" name="title_image">
                                        @if($doctor->title_image)
                                        <img width="70px" src="{{ url('uploads/doctors'.'/'.$doctor->title_image) }}">
                                        @endif
                                        <br> <span class="text-muted">صورةإثبات اللقب المهني </span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="my-2" name="image">
                                        @if($doctor->image)
                                        <img width="70px" src="{{ url('uploads/doctors'.'/'.$doctor->image) }}"><br> <span class="text-muted">الصورة الشخصية</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <h3>المنشأة</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        {!!Form::label('about_ar', 'الفرع :')!!}
                                        @if(Auth::user()->roles_name == ["superadmin"])
                                            <div class="form-group">
                                                {!! Form::select('branch_id', $branches, null ,
                                                    ['class' => 'form-control  mt-1 mb-3',
                                                    'placeholder' => 'إختر الفرع',
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!Form::label('name', 'الراتب :')!!}
                                            {!!Form::number('amount', $doctor->salary,[
                                                'class' => 'form-control  mt-1 mb-3',
                                                'placeholder' => 'أدخل الراتب ',
                                                'min' => 0,
                                                'step'=>'any',
                                            ])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <label>رسوم الكشف</label>
                                        <input  type="number" min="0" step="any" name="fees" class='form-control  mt-1 mb-3' value="{{ $doctor->fees}}" placeholder= 'أدخل  رسوم الكشف '>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <label>رسوم الكشف في حالة وجود خصم</label>
                                        <input  type="number" step="any" min="0" name="discount_fees" class='form-control  mt-1 mb-3' value="{{ $doctor->discount_fees}}" placeholder= ' أدخل  رسوم الكشف في حالة وجود خصم '>
                                    </div> --}}
                                </div>

                            </div>

                            <div class="form-group">
                                <option>إختر الأيام المتاحة للعمل</option>
                                    @foreach ( App\Models\Day::all() as $day)

                                        @if(in_array($day->id, $daysIds))
                                        <input type="checkbox" name="day_ids[]" class="mycheckbox" checked value="{{$day->id}}" />{{$day->day_ar}}
                        
                                                <div>
                                                    @php
                                                        $dayAppoinments = App\Models\Appointment::where('doctor_id',$doctor->id)->where('day_id',$day->id)->get(); 
                                                    @endphp  
                                            
                                                    <label>من</label>
                                                    <input type="time" name="from1[]" class="col-3" value="{{ $dayAppoinments[0]->from }}">
                                                    <label >إلي</label>
                                                    <input type="time" name="to1[]" class="col-3" value="{{ $dayAppoinments[0]->to }}">
                                                    <label >عدد الكشوفات</label>
                                                    <input type="number" name="no_of_reservations1[]" min="0" class="col-3" value="{{ $dayAppoinments[0]->no_of_reservations }}">
                                                    @if($dayAppoinments->count() == 1 )

                                                        <input type="checkbox" class="sec" >إضافة موعد أخر
                                                        <br>
                                                        <div style="display:none" class="secDiv">
                                                            <label>من</label>
                                                            <input type="time" name="from2[]" class="col-3">
                                                            <label >إلي</label>
                                                            <input type="time" name="to2[]" class="col-3">
                                                            <label >عدد الكشوفات</label>
                                                            <input type="number" name="no_of_reservations2[]" min="0"  class="col-3">
                                                        </div>

                                                    @endif
                                                    

                                                    <br>
                                                    @if($dayAppoinments->count() == 2 )
                                                    <label>من</label>
                                                    <input type="time" name="from2[]" class="col-3" value="{{ $dayAppoinments[1]->from }}">
                                                    <label >إلي</label>
                                                    <input type="time" name="to2[]" class="col-3" value="{{ $dayAppoinments[1]->to }}">
                                                    <label >عدد الكشوفات</label>
                                                    <input type="number" name="no_of_reservations2[]" min="0"  class="col-3" value="{{ $dayAppoinments[1]->no_of_reservations }}">
                                                    @endif
                                                   
                                                </div>
                                        @else
                                            <input type="checkbox" name="day_ids[]" class="mycheckbox" value="{{$day->id}}" />{{$day->day_ar}}
                                            <div style="display:none">
                                                <label>من</label>
                                                <input type="time" name="from1[]" class="col-3">
                                                <label >إلي</label>
                                                <input type="time" name="to1[]" class="col-3">
                                                <label >عدد الكشوفات</label>
                                                <input type="number" name="no_of_reservations1[]" min="0"  class="col-3">


                                                    <input type="checkbox" class="sec" >إضافة موعد أخر
                                                    <br>
                                                    <div style="display:none" class="secDiv">
                                                        <label>من</label>
                                                        <input type="time" name="from2[]" class="col-3">
                                                        <label >إلي</label>
                                                        <input type="time" name="to2[]" class="col-3">
                                                        <label >عدد الكشوفات</label>
                                                        <input type="number" name="no_of_reservations2[]" min="0"  class="col-3">
                                                    </div>
                                            </div>
                                    
                                        <br>
                                        @endif
                                    @endforeach
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">الحجز بأولوية الحضور</label>
                                        <select name='first_come' class ='form-control  mt-1 mb-3'>
                                            <option value="0" >--إختر--</option>
                                            <option value="yes" {{ $doctor->first_come =='yes' ? 'selected':''}}>نعم</option>
                                            <option value="no" {{ $doctor->first_come =='no' ? 'selected':''}}>لا</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">توقف الحجز بعد أول كشف  </label>
                                        <select name='stop_reservations' class ='form-control  mt-1 mb-3'>
                                            <option value="0" >--إختر--</option>
                                            <option value="yes" {{ $doctor->stop_reservations =='yes' ? 'selected':''}}>نعم</option>
                                            <option value="no" {{ $doctor->stop_reservations =='yes' ? 'selected':''}}>لا</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="doctor_id" value={{ $doctor->id }}>


                        </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                {!!Form::submit('تحديث',[
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

@push('scripts')
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
                        $('select[name="sub_specialist_ids[]"]').append('<option value="selected disabled">إختر التخصص الفرعي</option>');
                        $.each(data, function (key, value) {

                            $('select[name="sub_specialist_ids[]"]').append('<option value="' + key + '">' + value + '</option>');
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
                    $('select[name="sub_specialist_ids[]"]').empty();
                    $('select[name="sub_specialist_ids[]"]').append('<option value="selected disabled">إختر التخصص الفرعي</option>');
                    $.each(data, function (key, value) {

                        $('select[name="sub_specialist_ids[]"]').append('<option value="' + key + '">' + value + '</option>');
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

</script>

@endpush
@endsection

