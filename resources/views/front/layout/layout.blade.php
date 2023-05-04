<link href="{{asset('web/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
<!DOCTYPE html>
<html lang="ar" dir="rtl">

@include('front.layout.head')

<body>


  <!-- ======= Top Bar ======= -->

  @include('front.layout.top_bar')

  

  @include('inc.messages')

  <!-- ======= Header ======= -->
  @include('front.layout.header')



  <!-- ======= Hero Section ======= -->
  @include('front.layout.hero_sec')

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="about" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Welcare Clinic</h3>
              <p>
                    مركز طبي متكامل يحتوي علي جميع التخصصات الطبية والخدمات الطبية المتكاملة تحت رعاية نخبة من الإستشاريين مجهز بأحدث معايير عالمية فى الشيخ زايد
                    <br>
                    للحجز والاستفسار: <br>
                    ☎ موبايل :01117944449 <br>
                    ☎ موبايل : 01008827778 <br>
                    🚦العنوان : الشيخ زايد الحي السابع المجاورة الثانيه شيلز مول. <br>
              </p>
              <div class="text-center">
                <a href="#" class="more-btn"> احجز الان <i class="bx bx-chevron-right"></i></a>
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
                    <p> في عيادات ويلكير التخصصية .. بنقدم لك نخبة من أمهر الأطباء في كافة التخصصات الطبية مع استقبال طواريء طوال 24 ساعة يوميا ومعمل مزود باحدث الأجهزة.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Welcare Clinic</h4>
                    <p>وفرنا لك كل التحاليل اللي ممكن تحتاجها في مكان واحد .. اهتم بالكشف الطبي وعمل التحاليل اللازمة مع المتابعة بشكل دوري علشان تطمن على صحتك.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Welcare Clinic</h4>
                    <p>في عيادات ويلكير .. بنقدم لك نخبة من أمهر الأطباء في كافة التخصصات
                      دكتور محمد احمد حمدى ... استشارى النساء والتوليد</p>
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
              <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
              <p>الاطباء</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="far fa-hospital"></i>
              <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
              <p>التخصصات</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-flask"></i>
              <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
              <p>المعامل</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-award"></i>
              <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
              <p>الجوائز</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>التخصصات في Welcare Clinic</h2>
          <p>تسعي عيادات ويلكير كلينك الى تغيير مفهوم الرعاية الصحية الأولية في مصر من خلال تقديم خدمات طبية فريدة للأسرة المصرية تعتمد على تطبيق المعايير العالمية للرعاية الصحية الأولية.          </p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-heartbeat"></i></div>
              <h4><a href="">النساء والتوليد</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-pills"></i></div>
              <h4><a href="">طب الاطفال</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">الباطنة العامه</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-dna"></i></div>
              <h4><a href="">العظام</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-wheelchair"></i></div>
              <h4><a href="">جراحة الفم والاسنان</a></h4>
              <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-notes-medical"></i></div>
              <h4><a href="">الانف والاذن والحنجرة</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Appointment Section ======= -->


 @yield('main')

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
      <div class="container">

        <div class="section-title">
          <h2>الاطباء</h2>
          <p>لدينا في ويلكير كلينك نخبة من افضل وامهر الاطباء علي مستوي التخصصات المتاحة لدينا تم اختيارهم بعناية فائقة</p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="{{url('web/assets/img/doctors/doctors-1.')}}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>د. الاسم</h4>
                <span>التخصص</span>
                <p>نبذة عن الدكتور تكتب هنا</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="{{url('web/assets/img/doctors/doctors-2.jpg')}}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>د. الاسم</h4>
                <span>التخصص</span>
                <p>نبذة عن الدكتور تكتب هنا</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="{{url('web/assets/img/doctors/doctors-3.jpg')}}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>د. الاسم</h4>
                <span>التخصص</span>
                <p>نبذة عن الدكتور تكتب هنا</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="{{url('web/assets/img/doctors/doctors-4.jpg')}}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>د. الاسم</h4>
                <span>التخصص</span>
                <p>نبذة عن الدكتور تكتب هنا</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Doctors Section -->


        <!-- ======= Offers Section ======= -->
        <section id="Offers" class="Offers">
            <div class="container">
              <div class="section-title">
                <h2>العروض</h2>
                <p>عروض مميزة من ويلكير كلينك  مصممه بعناية فائقة لراحتك</p>
              </div>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <div class="card">
                                    <a class="img-card" href="">
                                    <img src="https://1.bp.blogspot.com/-Bii3S69BdjQ/VtdOpIi4aoI/AAAAAAAABlk/F0z23Yr59f0/s640/cover.jpg" />
                                  </a>
                                    <div class="card-content text-center">
                                        <h4 class="card-title">
                                            <a href="">عنوان العرض
                                          </a>
                                        </h4>
                                        <p class="">
                                            نبذة عن العرض  نبذة عن العرض نبذة عن العرض نبذة عن العرض نبذة عن العرض
                                        </p>
                                    </div>
                                    <div class="card-read-more">
                                        <a href="" class="btn btn-link btn-block">
                                           المزيد
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4">
                              <div class="card">
                                  <a class="img-card" href="">
                                  <img src="https://1.bp.blogspot.com/-Bii3S69BdjQ/VtdOpIi4aoI/AAAAAAAABlk/F0z23Yr59f0/s640/cover.jpg" />
                                </a>
                                  <div class="card-content text-center">
                                      <h4 class="card-title">
                                          <a href="">عنوان العرض
                                        </a>
                                      </h4>
                                      <p class="">
                                          نبذة عن العرض  نبذة عن العرض نبذة عن العرض نبذة عن العرض نبذة عن العرض
                                      </p>
                                  </div>
                                  <div class="card-read-more">
                                      <a href="" class="btn btn-link btn-block">
                                         المزيد
                                      </a>
                                  </div>
                              </div>
                          </div>

                          <div class="col-xs-12 col-sm-4">
                            <div class="card">
                                <a class="img-card" href="">
                                <img src="https://1.bp.blogspot.com/-Bii3S69BdjQ/VtdOpIi4aoI/AAAAAAAABlk/F0z23Yr59f0/s640/cover.jpg" />
                              </a>
                                <div class="card-content text-center">
                                    <h4 class="card-title">
                                        <a href="">عنوان العرض
                                      </a>
                                    </h4>
                                    <p class="">
                                        نبذة عن العرض  نبذة عن العرض نبذة عن العرض نبذة عن العرض نبذة عن العرض
                                    </p>
                                </div>
                                <div class="card-read-more">
                                    <a href="" class="btn btn-link btn-block">
                                       المزيد
                                    </a>
                                </div>
                            </div>
                        </div>


                        </div>
                    </div>
                </div>
            </div>

        </section><!-- End Offers Section -->




    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>التواصل معنا</h2>
          <p>جميع وسائل التواصل مع عيادات ويلكير كلينك تجدها هنا في هذا المكان</p>
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
                <h4>العنوان:</h4>
                <p>الشيخ زايد الحي السابع المجاورة الثانيه شيلز مول</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>البريد الالكتروني:</h4>
                <p>welcarecliniczayed@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>رقم الموبايل:</h4>
                <p>01117944449</p>
                <p>01008827778</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="الاسم بالكامل" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="البريد الالكتروني" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="الموضوع" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="الرسالة" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">جاري التحميل</div>
                <div class="error-message"></div>
                <div class="sent-message">تم ارسال الرسالة بنجاح</div>
              </div>
              <div class="text-center"><button type="submit">ارسال </button></div>

            </form>

          </div>

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
            <p>
              الشيخ زايد الحي السابع <br>
              المجاورة الثانيه شيلز مول<br>
              مصر<br><br>
              <strong>الموبايل:</strong>01008827778<br>
              <strong>البريد الالكتروني:</strong> welcarecliniczayed@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>روابط هامه</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">الرئيسية</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">من نحن</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">التخصصات</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">سياسة الاستخدام</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">سياسة الخصوصية</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>الخدمات</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">حجز كشف</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">خدمات طبية</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">الاطباء</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">المدونة</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">دخول العملاء</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>اشترك الان</h4>
            <p>اشترك بالنشرة البريدية ليصلك كل جديد</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="إشترك">
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

</body>

</html>
