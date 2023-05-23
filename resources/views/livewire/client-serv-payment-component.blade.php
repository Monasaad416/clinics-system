<div>
    <!-- row opened -->
    <div>
        <!--div-->

        @include('inc.messages')
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                     <h4 class="card-title mg-b-0 my-4 text-danger my-3">قائمة  الخدمات المحجوزة و أذونات قبض العملاء    </h4>
                    <div class="d-flex justify-content-between">


                            <button class="btn btn-primary"><a class="x-small text-white" wire:click="exportClientServices" >تصدير إلي إكسيل</a></button>
                            <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.services_bookings.create")}}">إضافة خدمة</a></button>

                    </div>
                    {{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
                </div>
                <div class="card-body">
                    <div>
                        @php
                            $specialists = App\Models\Specialist::all();
                        @endphp
                        <div class="row my-5">

                            <div class="col">
                                <label for="">بحث بالفرع</label>
                                <select wire:model="branch_id" class="form-control" name="branch_id" value="{{ old('branch_id') }}" >
                                    <option value="">-- إختر الفرع--</option>
                                    @foreach(App\Models\Branch::all() as $branch)
                                        <option value ="{{$branch->id}}">{{$branch->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="">بحث بالتخصص الرئيسي </label>
                                <select wire:model="specialist_id" class="form-control" name="specialist_id" value="{{ old('specialist_id') }}" >
                                    <option value="">-- إختر التخصص--</option>
                                    @foreach($specialists as $specialist)
                                        <option value ="{{$specialist->id}}">{{$specialist->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>




                                <div class="col">
                                    <label for="">بحث بالطبيب   </label>

                                    <select wire:model="doctor_id" class="form-control" name="doctor_id" value="{{ old("doctor_id") }}" >
                                        <option value="">-- إختر الطبيب--</option>
                                            @if (!is_null($branch_id) || !is_null($specialist_id))
                                                @foreach($doctors as $doctor)
                                                <option value ="{{$doctor->id}}">{{$doctor->name_ar}}</option>
                                                @endforeach
                                            @endif

                                    </select>

                                </div>


                                <div class="col">
                                    <label for="">بحث بالموظف   </label>

                                    <select wire:model="doctor_id" class="form-control" name="doctor_id" value="{{ old("doctor_id") }}" >
                                        <option value="">-- إختر الموظف--</option>
                                            @if (!is_null($branch_id))
                                                @foreach($employees as $employee)
                                                <option value ="{{$employee->id}}">{{$employee->name}}</option>
                                                @endforeach
                                            @endif

                                    </select>

                                </div>



                            <div class="col">
                                <label for="">بحث من تاريخ</label>
                                <input type="date" wire:model="from_date" class="form-control" id="from">
                            </div>
                            <div class="col">
                                <label for="">بحث إلي تاريخ</label>
                                <input type="date" wire:model="to_date" class="form-control" id="to" >
                            </div>


                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>العميل </th>
                                    <th>رقم حجز الخدمة </th>
                                    <th>القائم بالخدمة</th>
                                    <th>المبلغ </th>
                                    @can('dashboard')
                                        <th>الفرع</th>
                                    @endcan
                                    <th>تحديث</th>
                                    <th>حذف</th>
                                    <th>طباعة</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    $payments = App\Models\salary::latest()->paginate(20);
                                @endphp --}}
                                @foreach ($clientsServpayments as $payment )

                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $payment->client->name }}</td>
                                        <td>{{ $payment->number }}</td>
                                        @if($payment->doctor_id)
                                            <td class="text-success"> طبيب -{{ $payment->doctor->name_ar }}</td>
                                        @else
                                            <td class="text-info"> موظف - {{ $payment->user->name }}</td>
                                        @endif

                                        <td >{{ $payment->service_price}}</td>

                                        @can('dashboard')
                                            <th>{{ $payment->branch->name_ar }}</th>
                                        @endcan

                                        <td>
                                            <a href="{{route('admin.services_bookings.edit',$payment->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث الاذن"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_payment{{ $payment->id }}" title="حذف الاذن"><i class="fa fa-trash"></i></button></td>
                                            <!-- Delete Modal -->
                                            <form action="{{route('admin.services_bookings.destroy',$payment->id)}}" method="POST">

                                                @method('delete')
                                                @csrf
                                                <div class="modal fade" id="delete_payment{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">حذف اذن القبض من قائمة الأذونات</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                <p>هل انت متأكد من حذف اذن القبض الخاص بحجز خدمة رقم  {{$payment->number }} </p>




                                                                <input type="hidden" value="{{$payment->id}}" name="id">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                    <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>

                                        <td>
                                            <a href="{{route('admin.clients_services_payments.print',$payment->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="طباعة الاذن"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
        <div class="d-flex justify-content-center align-items-center my-5">
            {{ $clientsServpayments-> links() }}
        </div>
</div>
</div>
