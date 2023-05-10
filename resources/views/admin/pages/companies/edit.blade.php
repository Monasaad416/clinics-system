
@extends('admin.layout.master')
@section('css')
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
                        {!! Form::model($company,[
                           'route' =>  ['admin.companies.update' ,$company->id ],
                            ])
                        !!}

                          {{ method_field('PUT')}}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::text('name', $company->name,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'إسم الشركة  '
                                    ])!!}
                                </div>

                                   {!!Form::hidden('id', $company->id)!!}
     
                                <div class="form-group">
                                    {!!Form::textarea('notes', $company->notes,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => 'ملاحظات',
                                        'name' => 'notes',
                                        'rows' =>2,
                                    ])!!}
                                </div>



                                </div>
                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit('تحديث',[
                                        'class' =>'btn btn-secondary btn-flat'
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

