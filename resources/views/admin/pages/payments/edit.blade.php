
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تحديث سند الصرف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سندات الصرف</span>
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


                        @include('inc.errors')
                        <form method="POST" action="{{ route('admin.payments.update',$payment->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <select name="type_id" class="form-control">
                                        <option value="0">-- إختار المهنة--</option>
                                        <option value ="doctor" {{ $payment->salariable_type == 'App\Models\Doctor'  ? 'selected' : ''}}>طبيب</option>
                                        <option value ="user"  {{ $payment->salariable_type == 'App\Models\User'  ? 'selected' : ''}}>موظف</option>
                                    </select>
                                 </div>
                            
                             @if(Auth::user()->roles_name == ["superadmin"])
                                <div class="form-group">
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
                                <div class="form-group">
                                    <option value="0">-- إختار الأسم--</option>
                                    <select name="employee_id" class="form-control">
                                        @if($payment->salariable_type == 'App\Models\Doctor')
                                            @foreach (App\Models\Doctor::all() as $doctor)
                                                <option value ="{{ $doctor->id}}">{{ $doctor->name_ar }}</option>
                                            @endforeach
                                        @else
                                            @foreach (App\Models\User::all() as $user)
                                                <option value ="{{ $user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="form-group">
                                   <label>المبلغ</label>
                                   <input type="number" name="amount" min="0" class="form-control" value="{{ old('amount', $payment->amount)}}">  
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>تفاصيل البند</label>
                                   <input type="text" name="details" class="form-control"  value="{{ old('details', $payment->details)}}">  
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                </div>
                                <input type="hidden" name="id" value= {{ $payment->id }}>

                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                   <button type="submit" class="btn btn-secondary">تحديث</button> 
                                </div>

                            </div>
                        </form>
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
@endpush

@endsection

