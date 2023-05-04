  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">

{{--         
        <i class="bi bi-person-fill"></i> <a href="">العملاء</a> --}}
        <i class="bi bi-globe"></i>
     <ul class="my-1">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      
                  @if(App::getLocale() == 'ar')
            <li> <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a></li>
            @else
            <li> <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a></li>
            @endif
        @endforeach

    
    </ul>
        <i class="bi bi-envelope"></i> <a href="mailto:welcarecliniczayed@gmail.com">welcarecliniczayed@gmail.com</a>
        <i class="bi bi-phone"></i>01008827778 
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/Welcareclinic.zayed/" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>