  <!-- Vendor JS Files -->
  <script src="{{asset('web/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<!--   <script src="{{asset('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <script src="{{asset('web/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('web/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('web/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('web/assets/js/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('web/assets/js/main.js')}}"></script>

 <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>


  <!-- Owl Carousel -->

<!-- jquery -->

{{-- get doctors by specialists --}}
<script>
  $(document).ready(function () {
        $('select[name="specialist_id"]').on('change', function () {
            var specialist_id = $(this).val();
            //console.log(specialist_id + "kkk");
            var branch_id = $("#branch_id").val();
            //console.log(branch_id + "kkk");
            var locale = '{{ App::getLocale()}}';


            if (specialist_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/front/getDoctorsBySpecialistAndBranch") }}/" + specialist_id + "/" + branch_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="doctor_id"]').empty();
                           if(locale == 'ar') {
                                 $('select[name="doctor_id"]').append('<option value="0" selected disabled>إختر الطبيب </option>');
                           } else{
                               $('select[name="doctor_id"]').append('<option value="0" selected disabled>Select Doctor  </option>');
                           }
                        $.each(data, function (key, value) {

                            $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
{{-- get sub specialists by specialist --}}
<script>
  $(document).ready(function () {
        $('select[name="specialist_id"]').on('change', function () {
            var specialistId = $(this).val();
            var locale = '{{ App::getLocale()}}';
            //console.log(specialistId);
            if (specialistId) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/front/getSubSpecialistsBySpecialist") }}/" + specialistId,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="sub_specialist_id"]').empty();
                             if(locale == 'ar') {
                                 $('select[name="sub_specialist_id"]').append('<option value="0" >إختر التخصص الفرعي </option>');
                           } else{
                               $('select[name="sub_specialist_id"]').append('<option value="0">Select Sub Speciality  </option>');
                           }
                        $.each(data, function (key, value) {

                            $('select[name="sub_specialist_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

{{-- get doctors by sub specialists --}}
<script>
  $(document).ready(function () {
        $('select[name="sub_specialist_id"]').on('change', function () {
            var sub_specialist_id = $(this).val();
            var branch_id = $("#branch_id").val();
            var locale = '{{ App::getLocale()}}';


            if (sub_specialist_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/front/getDoctorsBySubSpecialistAndBranch") }}/" + sub_specialist_id + "/" + branch_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="doctor_id"]').empty();
                           if(locale == 'ar') {
                                 $('select[name="doctor_id"]').append('<option value="0" selected disabled>إختر الطبيب </option>');
                           } else{
                               $('select[name="doctor_id"]').append('<option value="0" selected disabled>Select Doctor  </option>');
                           }
                        $.each(data, function (key, value) {

                            $('select[name="doctor_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>



{{-- get days by doctors --}}
<script>
  $(document).ready(function () {
        $('select[name="doctor_id"]').on('change', function () {
            var doctorId = $(this).val();
            console.log(doctorId);
            var locale = '{{ App::getLocale()}}';



            if (doctorId ) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/front/getDaysByDoctor") }}/" + doctorId ,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                      //console.log(data)

                        $('select[name="day_id"]').empty();
                        if(locale == 'ar') {
                                 $('select[name="day_id"]').append('<option value="0" selected disabled>إختر الموعد </option>');
                          $.each(data, function (key, value) {

                           $('select[name="day_id"]').append('<option value="' + value['day_en'] +" "+"from"+" " +value['from'] + " " + "to" +" " + value['to']+ '">'
                                 + value['day_en'] +" "+"from"+" " +value['from'] + " " + "to" +" " + value['to']+
                                 '</option>') ;
                        });

                        } else {
                                 $('select[name="day_id"]').append('<option value="0" selected disabled> Select Appointment </option>');
                          $.each(data, function (key, value) {

                            $('select[name="day_id"]').append('<option value="' + value['day_en'] +" "+"from"+" " +value['from'] + " " + "to" +" " + value['to']+ '">'
                                 + value['day_en'] +" "+"from"+" " +value['from'] + " " + "to" +" " + value['to']+
                                 '</option>') ;
                          });
                        }

                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<!-- owl carousel -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function(){
    var mydir = $("html").attr("dir");

if (mydir == 'rtl') {
     var rtlVal=true
}
else{
     var rtlVal=false
    }

    $(".owl-carousel").owlCarousel({
        loop:true,
         rtl: rtlVal,
      dots: false,
      autoplay: true,
                autoplayTimeout: 3000,
  stagePadding: 0,
  margin: 15,
  nav: true,
  navText: ['<i class="icon-left-small"></i>', '<i class="icon-right-small"></i>'],
  navContainer: '#lgi__slider',
  navClass: [ 'lgi__btn lgi__btn--prev', 'lgi__btn lgi__btn--next' ],
  responsive: {
    0: {
      items: 1,
    },
    768: {
      items: 2,
      autoWidth: false,
    },
    992: {
      items: 3,
      autoWidth: false,
    },
    1310: {
      items: 3,
      autoWidth: false,
      margin: 30,
    }
  }
    });
  });
</script>


{{-- get fees by doctor --}}
<script>
  $(document).ready(function () {
        $('select[name="doctor_id"]').on('change', function () {
            var doctorId = $(this).val();
            var locale = '{{ App::getLocale()}}';
            console.log(doctorId);
            if (doctorId) {

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/front/getFeesByDoctor") }}/" + doctorId,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('#fees').val(data[doctorId]);
              
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>












