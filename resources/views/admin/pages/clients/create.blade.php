
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة عميل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ العملاء</span>
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

                        @inject('model', 'App\Models\Client')

                        @include('inc.errors')
                
                        @php
                            $branches = App\Models\Branch::pluck('name_ar','id');
                        @endphp

                        {!! Form::model($model,[
                            'route' => 'admin.clients.store',
                            ])
                        !!}

                            <div class="card-body">
                                <div class="form-group">
                                 {!!Form::label('name', ' إسم العميل')!!}
                                    {!!Form::text('name', old('name'),[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' إسم العميل'
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name', ' البريد الإلكتروني ')!!}
                                    {!!Form::text('email', old('email'),[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' البريد الإلكتروني'
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name', ' رقم الهاتف ')!!}
                                    {!!Form::text('phone', old('phone'),[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' رقم الهاتف '
                                    ])!!}
                                </div>

                                {{-- <div class="form-group">
                                    {!!Form::text('how_know_us', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' كيف تعرفت علينا ',

                                    ])!!}
                                </div> --}}


                       
                                <div class="form-group">
                                    {!!Form::label('name', 'كيف تعرفت علينا')!!}
                                        {!!Form::text('how_know_us', old('how_know_us'),[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => ' كيف تعرفت علينا ',
                                    ])!!}
                                </div>
                      

                                <div class="form-group">
                                    {!!Form::label('name', 'العنوان')!!}
                                    {!!Form::text('address', old('address'),[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' العنوان',

                                    ])!!}
                                </div>

                
                                <div class="form-group">
                                    {!!Form::label('name', 'تاريخ الميلاد')!!}
                                    {!!Form::date('date_of_birth', old('date_of_birth'),[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => ' تاريخ ميلاد العميل',

                                    ])!!}
                                </div>


                                @if(Auth::user()->roles_name == ["superadmin"])
                                <div class="form-group">
                                    {!!Form::label('name', 'الفرع')!!}
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

