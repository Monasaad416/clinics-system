			<div class="row row-sm">
					<!--div-->

                  @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">المراجعة المالية للطبيب بناءا علي الكشوفات الفعليه </h4>
								</div>


                                <div class="row my-5">
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



     


							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
                                        <h3>البيانات الأساسية للطبيب</h3>
											<tr>
												<th>الإسم</th>
                                                <th>التخصص الرئيسي </th>
                                                <th>التخصصات الفرعية</th>
												<th>الراتب </th>
                                                {{-- <th>تاريخ الإلتحاق </th> --}}
                                                <th>الفرع</th>

											</tr>
										</thead>
										<tbody>
                                                <tr>
                                                    <td>{{ $doctor->name_ar }}</td>
     
                                                   <td>{{ $doctor->specialist->name_ar}}</td>
                                                     <td>
                                                        @foreach ( $doctor->subSpecialists as $sub_special )
                                                            {{ $sub_special->name_ar}}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $doctor->salary}}</td>
													

                                                    {{-- <td>{{Carbon\Carbon::parse($doctor->created_at)->format('d M ,Y')}}</td> --}}
                                           
                                                    <td>{{$doctor->branch->name_ar}}</td>
                                
                                      
										</tbody>
									</table>
								</div>


                                <div class="table-responsive my-5">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">البند  </th>
                                                        <th class="border-bottom-0"> المبلغ (جنية) </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                    
                                                    <tr>
                                                        <th class="border-bottom-0">إجمالي الكشوفات الفعلية  </th>
                                                        <th class="border-bottom-0">{{ number_format($actualReservations)}} </th>
                                                    </tr>
                                

                                                    <tr>
                                                        <th class="border-bottom-0">إجمالي المبالغ المستلمة   </th>
                                                        <th class="border-bottom-0">{{ number_format($payments) }} </th>
                                                    </tr>
                                    

                                                </tbody>
                                            </table>
                                </div>

							</div>



                
						</div>
					</div>
					<!--/div-->
				</div>
