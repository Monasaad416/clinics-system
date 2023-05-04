
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة سند صرف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سندات الصرف</span>
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


                        @include('inc.errors')
                        <form method="POST" action="{{ route('admin.payments.store') }}">
                            @csrf
                            <div class="card-body">
                                 <div class="form-group">
                                    <select name="type_id" class="form-control">
                                        <option value="0">-- إختار المهنة--</option>
                                        <option value ="doctor">طبيب</option>
                                        <option value ="user">موظف</option>
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
                                        @foreach (Auth::user()->branch->employees as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>المبلغ</label>
                                   <input type="number" name="amount" min="0" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>تفاصيل البند</label>
                                   <input type="text" name="details" class="form-control">
                                </div>

                                </div>

                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                   <button type="submit" class="btn btn-primary">حفظ</button>
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

