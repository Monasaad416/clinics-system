<link href="{{asset('web/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
<!DOCTYPE html>

@if (App::getLocale() == 'en')
    <html lang="ar" dir="ltr">
@else
    <html lang="ar" dir="rtl">
@endif




@include('front.layout.head')




<body>


  <!-- ======= Top Bar ======= -->

  @include('front.layout.top_bar')





  <!-- ======= Header ======= -->
  @include('front.layout.header')



  <!-- ======= Hero Section ======= -->
  @include('front.layout.hero_sec')
<div style="z-index:1000000000000">  @include('inc.messages')</div>
  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="about" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Welcare Clinic</h3>
              <p>
                    {{ trans('web.welcare') }}
                    <br>
                    {{trans('web.for_booking')}} <br>
                    ☎ {{trans('web.mobile')}} :{{ $settings->phones }} <br>
                        @if (App::getLocale() == 'en')
                            {{trans('web.address')}} : {{ $settings->address_en }} <br>
                        @else
                          {{trans('web.address')}} : {{ $settings->address_ar }} <br>
                        @endif


              </p>
              <div class="text-center">
                <a href="#" class="more-btn"> {{trans('web.book_now')}}<i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>Welcare Clinic</h4>
                    <p> {{ trans('web.at_clinic') }}</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Welcare Clinic</h4>
                    <p>{{ trans('web.tests') }}</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Welcare Clinic</h4>
                    <p>{{ trans('web.elite') }}</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
<!--     <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a>
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
            <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi. Libero laboriosam sint et id nulla tenetur. Suscipit aut voluptate.</p>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-gift"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-atom"></i></div>
              <h4 class="title"><a href="">Dine Pad</a></h4>
              <p class="description">Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis</p>
            </div>

          </div>
        </div>

      </div>
    </section> --><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="fas fa-user-md"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\Doctor::count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ trans('web.doctors') }}</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="far fa-hospital"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\Specialist::count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ trans('web.specialities') }}</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-flask"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\Service::count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ trans('web.services') }}</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-award"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\Branch::count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ trans('web.branches') }}</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2> {{ trans('web.specialities_in') }} Welcare Clinic</h2>
          <p>{{ trans('web.we_seeking') }}</p>
        </div>


            <div class="owl-carousel">
                @foreach (App\Models\Specialist::all() as $specialist)
                    <div >
                        <div class="icon-box">
                        <div class="icon"><i class="{{ $specialist->image }}"></i></div>
                        @if (App::getLocale() == 'en')
                            <h4><a href="">{{ $specialist->name_en }}</a></h4>
                            <p>{{ $specialist->description_en }}</p>
                        @else
                            <h4><a href="">{{ $specialist->name_ar }}</a></h4>
                            <p>{{ $specialist->description_ar }}</p>
                        @endif




                        </div>
                    </div>
                @endforeach
            </div>


      </div>
    </section><!-- End Services Section -->

    <!-- ======= Appointment Section ======= -->

 @include('inc.messages')
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>{{ trans('web.booking_request') }} </h2>
          <p>{{ trans('web.please') }}</p>
        </div>
        @include('inc.errors')

        <form action="{{ route('front.bookAppointment') }}" method="post" role="form" >
          @csrf
          <div class="row">
            <div class="col-md-3 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="{{trans('web.name')}} " data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
            <div class="col-md-3 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="{{trans('web.email')}} " data-rule="email" data-msg="Please enter a valid email">
              <div class="validate"></div>
            </div>
            <div class="col-md-3 form-group mt-3 mt-md-0">
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="{{trans('web.phone')}}  " data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
            <div class="col-md-3 form-group">
              <input type="date" name="date_of_birth" class="form-control fc-datepicker" id="date_of_birth" placeholder="{{trans('web.date_of_birth')}} " data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 form-group mt-3">
              <select name="branch_id" id="branch_id" class="form-select">
                <option value="0"> {{trans('web.select_branch')}} </option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{$branch->name}}</option>
                @endforeach
              </select>
              <div class="validate"></div>
            </div>
            <div class="col-md-3 form-group mt-3">
              <select name="specialist_id" id="specialist_id" class="form-select">
                <option value="">{{trans('web.select_specialist')}}  </option>
                @foreach ($specialists as $specialist)
                    <option value="{{ $specialist->id }}">{{$specialist->name}}</option>
                @endforeach
              </select>
              <div class="validate"></div>
            </div>

            <div class="col-md-3 form-group mt-3">
              <select name="sub_specialist_id" id="sub_specialist_id" class="form-select">
                <option value="">{{trans('web.select_sub_specialist')}}  </option>

              </select>
              <div class="validate"></div>
            </div>

            <div class="col-md-3 form-group mt-3">
              <select name="doctor_id" id="doctor_id" class="form-select">
                <option value="">{{trans('web.select_doctor')}}  </option>

              </select>
              <div class="validate"></div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-4 form-group mt-3">
                <input type="text" class="w-100" name="fees" id="fees" readonly placeholder="{{ trans('web.price') }}">
            </div>

            <div class="col-md-4 form-group mt-3">
              <select name="day_id" id="day_id" class="form-select">
                <option value="">{{trans('web.select_day')}}  </option>

              </select>
              <div class="validate"></div>
            </div>

            <div class="col-md-4 form-group mt-3">
              <select name="type" id="type" class="form-select">
                <option value="">{{trans('web.select_type')}} </option>
                <option value="first_visit">{{trans('web.first_visit')}} </option>
                <option value="sec_visit">{{trans('web.sec_visit')}}  </option>
              </select>
              <div class="validate"></div>
            </div>

          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="notes" rows="5" placeholder="{{ trans('web.short_msg') }}"></textarea>
            <div class="validate"></div>
          </div>

          <div class="text-center my-4"><button type="submit"
          style="background: #1977cc;
                border: 0;
                padding: 10px 35px;
                color: #fff;
                transition: 0.4s;
                border-radius: 50px;">{{ trans('web.book_appointment') }}</button></div>
        </form>

      </div>
    </section><!-- End Appointment Section -->

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
      <div class="container">

        <div class="section-title">
          <h2>{{ trans('web.doctors') }}</h2>
          <p>{{ trans('web.selected') }}</p>
        </div>

        <div class="owl-carousel">
            @php
                $doctors = App\Models\Doctor::all();
            @endphp
            @foreach ($doctors as $doctor )
            @php
                $specialist_ar = $doctor->subSpecialists()->count() > 0 ? $doctor->subSpecialists()->where('doctor_id', $doctor->id)->first()->specialist->name_ar : $doctor->specialist->name_ar;
                $specialist_en=  $doctor->subSpecialists()->count() > 0 ? $doctor->subSpecialists()->where('doctor_id', $doctor->id)->first()->specialist->name_en : $doctor->specialist->name_en;
            @endphp
                <div>
                    <div class="member d-flex align-items-start">
                    <div class="pic"><img src="{{url('web/assets/img/doctors/doctors-1.')}}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        @if (App::getLocale() == 'en')
                        <h4>Dr. {{ $doctor->name_en}}</h4>
                        <span>{{$specialist_en}}</span>
                        <p>{{$doctor->about_en}}</p>
                        @else
                        <h4>د. {{ $doctor->name_ar }}</h4>
                        <span>{{$specialist_ar}}</span>
                        <p>{{$doctor->about_ar}}</p>
                        @endif

                        <div class="social">
                        <a href=""><i class="ri-twitter-fill"></i></a>
                        <a href=""><i class="ri-facebook-fill"></i></a>
                        <a href=""><i class="ri-instagram-fill"></i></a>
                        <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach



        </div>

      </div>
    </section><!-- End Doctors Section -->
        <!-- ======= Offers Section ======= -->
        <section id="Offers" class="Offers">
            <div class="container">
              <div class="section-title">
                <h2>{{ trans('web.offers') }}</h2>
                <p>{{ trans('web.luxury_offers') }}</p>
              </div>
                <div class="content">
                    <div class="container">
                        <div class="owl-carousel">
                            @foreach (App\Models\Offer::all() as $offer )
                                <div>
                                    <div class="card">
                                        <a class="img-card" href="">
                                        <img src="{{ url('uploads/offers'."/".$offer->image) }}" alt="offer"/>
                                    </a>
                                    @if (App::getLocale() == 'en')

                                        <div class="card-content text-center">
                                            <h4 class="card-title">
                                                <a href="">{{ $offer->title_en }}
                                            </a>
                                            </h4>
                                            <p class="" style="min-height:80px">
                                                {{ $offer->description_en }}
                                            </p>
                                        </div>

                                        <div class="card-read-more">
                                            <p class="text-primary mx-4">
                                            {{ $offer->price }} LE
                                            <br>
                                            <p class="text-primary mx-4">from : {{Carbon\Carbon::parse($offer->from_date)->format('d.m.Y')  }} to : {{$offer->to_date}}</p>
                                            </a>
                                        </div>

                                    @else

                                        <div class="card-content text-center">
                                            <h4 class="card-title">
                                                <a href="">{{ $offer->title_ar }}
                                            </a>
                                            </h4>
                                            <p class="">
                                                {{ $offer->description_ar }}
                                            </p>
                                        </div>

                                            <div class="card-read-more">
                                            <p class="text-primary mx-4">
                                            {{ $offer->price }} جنيه
                                            <br>
                                            <p class="text-primary mx-4">من : {{Carbon\Carbon::parse($offer->from_date)->format('d.m.Y')  }} إلي : {{$offer->to_date}}</p>
                                        </a>
                                        </div>
                                        @endif

                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </section><!-- End Offers Section -->




    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>{{ trans('web.contact_us') }}</h2>
          <p>{{trans('web.all_means')}}</p>
        </div>
      </div>

      <div>
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="container">
        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>{{ trans('web.address') }}:</h4>
                       @if (App::getLocale() == 'en')
                            <p>{{trans('web.address')}} : {{ $settings->address_en }} </p><br>
                        @else
                          <p>{{trans('web.address')}} : {{ $settings->address_ar }}</p> <br>
                        @endif
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>{{ trans('web.email') }}:</h4>
                <p>{{$settings->email}}</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>{{ trans('web.phone') }} :</h4>
                <p> {{ $settings->phones }}</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="{{ trans('web.name') }} " required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="{{ trans('web.email') }} " required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="{{ trans('web.subject') }} " required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="{{ trans('web.message') }} " required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">جاري التحميل</div>
                <div class="error-message"></div>
                <div class="sent-message">تم ارسال الرسالة بنجاح</div>
              </div>
              <div class="text-center"><button type="submit">{{ trans('web.send') }} </button></div>

            </form>

          </div>@php
        //     DB::table('doctor_day')->raw("CONCAT(doctor_day.from_date,' ',doctor_day.to_date) as full_name");
        //          $compined = DB::table('days')
        // ->leftjoin('doctor_day', 'days.id', '=', 'doctor_day.doctor_id')
        // ->where('doctor_id', 4)
        // ->pluck('day_ar');

        // $compined = DB::table('doctor_day')
        // ->leftjoin('doctors', 'doctors.id', '=', 'doctor_day.doctor_id')
        // ->leftjoin('days', 'days.id', '=', 'doctor_day.doctor_id')
        // ->where('doctor_id', 4)
        // ->get();

        // return dd($compined)
          @endphp

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Welcare clinic</h3>
            @if(App::getLocale() == 'en')
            <p>
              {{$settings->address_en}}
              <strong>{{ trans('web.phone') }}:</strong>{{ $settings->phones }}<br>
              <strong>{{ trans('web.email') }} :</strong> {{ $settings->email }}<br>
            </p>
            @else

                <p>
              {{$settings->address_ar}}
              <strong>{{ trans('web.phone') }}:</strong>{{ $settings->phones }}<br>
              <strong>{{ trans('web.email') }} :</strong> {{ $settings->email }}<br>
            </p>


            @endif

          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4> {{ trans('web.important_links') }}</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.home') }}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#"> {{ trans('web.who_are_us') }}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.specialists') }}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.usage_policy') }}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.privacy_policy') }} </a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>{{ trans('web.services') }}</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.book_appointment') }} </a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.medical_service') }} </a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.doctors') }}</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">{{ trans('web.blog') }}</a></li>
              {{-- <li><i class="bx bx-chevron-right"></i> <a href="#">دخول العملاء</a></li> --}}
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>{{ trans('web.subscribe_now') }} </h4>
            <p>{{ trans('web.subscribe_to') }} </p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="{{ trans('web.subscribe') }}">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Welcare Clinic</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
                 Designed by <a href="https://Dylanu.com/">Dylanu.com</a>
        </div>
      </div>
   <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>


    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@include('front.layout.scripts')


<script>
    var date = $('.fc-datepicker').datepicker({
       
        dateFormat: 'yy-mm-dd'
    }).val();

     console.log(date);
</script>


</body>

</html>






