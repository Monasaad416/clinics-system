
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة قسم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الإقسام</span>
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

                        @inject('model', 'App\Models\Department')

                        @php
                            $branches = App\Models\Branch::pluck('name_ar','id');
                        @endphp

                        @include('inc.errors')
                        {!! Form::model($model,[
                            'route' => 'admin.departments.store',
                            ])
                        !!}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::text('name_ar', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'القسم باللغة العربية'
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::text('name_en', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'القسم باللغة الإنجليزية  '
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name', 'الفرع')!!}
                                      <div class="col-md-12">
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

                                    </div>

                                </div>

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
@endsection

