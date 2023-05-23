
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة موظف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الموظفين</span>
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

                        @inject('model', 'App\Models\User')

                        @include('inc.errors')
                        @php

                            if(Auth::user()->roles_name == ["superadmin"]){
                                $departments = [];
                            } else {
                                $departments = App\Models\Department::where('branch_id',Auth::user()->branch->id)->pluck('name_ar', 'id');
                            }
                            if(Auth::user()->roles_name == ["superadmin"]){
                                $branches = App\Models\Branch::pluck('name_ar', 'id');
                            } else {
                                $branches = App\Models\Branch::where('id',Auth::user()->branch->id)->pluck('name_ar', 'id');
                            }

                            $roles_name = Spatie\Permission\Models\Role::pluck('name','name');
                        @endphp
                        {!! Form::model($model,[
                            'route' => 'admin.employees.store',
                            'files' =>true,
                            ])
                        !!}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::label('name', 'الأسم:')!!}
                                    {!!Form::text('name', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل الاسم'
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
                                  <input type="password" name="password" class="form-control" placeholder="أدخل كلمة السر">
                                </div>
                                <div class="form-group">
                                  <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة السر">
                                </div>
                                <div class="form-group">
                                    <label>
                                        {!!Form::file('image')!!}
                                        <span class="text-muted">تحميل الصورة الشخصية  </span>
                                    </label>
                                </div>

                            @if(Auth::user()->roles_name == ["superadmin"])
                                <div class="form-group">
                                    {!! Form::select('branch_id', $branches, old('branch_id') ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إختر الفرع',
                                        ])
                                    !!}
                                </div>
                                @else

                                <div class="form-group">
                                    <select name='branch_id' class="form-control">
                                        <option value="{{(Auth::user()->branch_id)}}" >{{(Auth::user()->branch->name_ar)}}</option>
                                    </select>
                                </div>
                                @endif





                                <div class="form-group">
                                    {!!Form::label('name', 'القسم')!!}
                                    {!! Form::select('department_id', $departments, old('department_id', $model->department_id) ,
                                        ['class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إختر القسم',
                                        ])
                                    !!}
                                </div>

        


                                <div class="form-group">
                                    {!!Form::label('name', 'المهام')!!}
                                    {!! Form::select('roles_name[]', $roles_name,[], array('class' => 'form-control','multiple')) !!}
                                    {{-- <select name='roles_name' class ='form-control  mt-1 mb-3' >
                                        <option value="">--إختر --</option>
                                        @foreach ($roles as $role )
                                            <option value="{{ $role->name }}">{{ $role->name }} </option>
                                        @endforeach
                                    </select> --}}

                                </div>
{{-- 
                                <div class="form-group">
                                    {!!Form::label('name', 'الراتب :')!!}
                                    {!!Form::number('salary', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'أدخل الراتب ',
                                        'min' => 0,
                                        'step'=>'any',
                                    ])!!}
                                </div> --}}

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('حفظ',[
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

<script>
  $(document).ready(function () {
        $('select[name="branch_id"]').on('change', function () {
            var branch_id = $(this).val();
            console.log(branch_id);
            if (branch_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getDepartmentsByBranch") }}/" + branch_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="department_id"]').empty();
                        $('select[name="department_id"]').append('<option value="selected disabled">إختر القسم </option>');
                        $.each(data, function (key, value) {

                            $('select[name="department_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });



          
            var branch_id =  $('select[name="branch_id"]').val();
 
            if (branch_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getDepartmentsByBranch") }}/" + branch_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="department_id"]').empty();
                        $('select[name="department_id"]').append('<option value="selected disabled">إختر القسم </option>');
                        $.each(data, function (key, value) {

                            $('select[name="department_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        
    });
    </script>
@endsection

