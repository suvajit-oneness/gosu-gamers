<!doctype html>
<html lang="en">
  <head>
@include("website.layouts.header")
  </head>
  <body>    
    <section class="login__area">
      <div class="container">
        <div class="row">
        <div class="col-sm-6 register_image">
          </div>
          <div class="col-sm-6 login_wrapper text-center">
            <a href="{{route('home.index')}}" >
            <img src="{!!asset('letsgamenow/images/logo.png')!!}" class="mb-5" data-aos="fade-down" data-aos-duration="1000" width="100px"></a>
            <h4>Register</h4>
            <div class="login__block">
              <form id="tab-1" method="post" action="{{route('gamer.register.submit')}}" class="login__form">
               @csrf
                <div class="login_field row">
                  <div class="col-md-6">
                    <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                      <input type="text" name="fname" value="{{old('fname')}}" placeholder="Enter your First Name">
                    </div>
                    @error('fname') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                      <input type="text" name="lname" value="{{old('lname')}}" placeholder="Enter your Last Name">
                    </div>
                    @error('lname') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                  <div class="col-md-12">
                    <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                      <input type="email" name="email" value="{{old('email')}}" placeholder="Enter your Email ID">
                    </div>
                    @error('email') <p class="small text-danger" style="margin-left: -177px;">{{ $message }}</p> @enderror
                  </div>
                  <div class="col-md-7">
                    <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                      <input type="tel" name="mobile" value="{{old('mobile')}}" placeholder="Enter your Contact No">
                    </div>
                    <p class="text-danger">{{ Session::get('message') }}</p>
                    @error('mobile') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                  <div class="col-md-5">
                    <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                      <input  name="dob" placeholder="Enter your DOB" type="text" onfocus="(this.type='date')" id="date">
                    </div>
                     @error('dob') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                  <div class="col-md-12">
                    <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                      <select name='country_id'>
                      @foreach($country as $c)
                      <option value="{{$c->id}}" {{$c->id==99 ? 'selected': ''}}>{{$c->name}}</option>
                      @endforeach  
                      </select>
                    </div>
                    @error('country_id') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                  <div class="col-md-12 custom-control custom-checkbox text-left mb-3 ml-3" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <input type="checkbox" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1"><small>Please accept the terms and conditions by checking the checkbox.</small></label>
                  </div>
                </div>
                  <div class="row align-items-center">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <button type="submit" class="" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-in-sine">Submit Now</button>
                      </div>
                    </div>
                  </div>

                <div class="row align-items-center justify-content-between mt-4">
                  <div class="col-sm-6 text-left">
                    <p data-aos="fade-top" data-aos-duration="1000" data-aos-easing="ease-in-sine" data-aos-offset="10"><a href="{{route('home.login')}}">Have an Account?</a></p>
                  </div>
                  <div class="col-sm-6 text-right">
                    <p>
                      <a href="{{route('home.login')}}" data-aos="fade-left" data-aos-duration="1000" data-aos-easing="ease-in-sine">Login Now</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/bootstrap.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/bootstrap.min.js')) }}"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/slick.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/slick.min.js')) }}"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/jquery.carouselTicker.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/jquery.carouselTicker.min.js')) }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript">
      $(window).on("load", function() {
        $("#carouselTicker").carouselTicker();
      });
      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 104) {
          $("header").addClass("top");
        } else {
          $("header").removeClass("top");
        }
      });
    </script>
    <script>
      AOS.init();
    </script>
    <script type="text/javascript">
      $(document).ready(function(){

        $('.slide__wrapper').slick({
          dots: false,
          infinite: false,
          speed: 300,
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToShow: 6,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });

         $(document).on('click', '.filter-option a', function(){
          $('.filter-option a').removeClass('active');
            $(this).addClass('active');

            var cat = $(this).attr('data-category');
            if(cat !== 'all'){
              $('.slide__wrapper').slick('slickUnfilter');
              $('.slide__wrapper li').each(function(){
                $(this).removeClass('slide-shown');
              });
              $('.slide__wrapper li[data-match='+ cat +']').addClass('slide-shown');
              $('.slide__wrapper').slick('slickFilter', '.slide-shown');
            }
        
            else{
              $('.slide__wrapper li').each(function(){
                $(this).removeClass('slide-shown');
              });
              $('.slide__wrapper').slick('slickUnfilter');
            }
          });
          $('.news__list__horizon').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.news__list'
          });

          $('.news__list').slick({
            vertical: true,
            infinite: true,
            verticalSwiping: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: false,
            focusOnSelect: true,
            asNavFor: '.news__list__horizon'
          });

          $('.video__list').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
          });

          $('.testimonials').slick({
            dots: false,
            infinite: true,
            speed: 300,
            centerMode: true,
            arrows: false,
            centerPadding: '60px',
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
          });


          $('ul.register__list li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.register__list li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
          });

      });
    </script>

  </body>
</html>