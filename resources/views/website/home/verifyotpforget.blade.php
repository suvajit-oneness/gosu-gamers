<!doctype html>
<html lang="en">
  <head>
@include("website.layouts.header")
  </head>
  <body>    
    <section class="register__area">
      <div class="container-fluid">
        <div class="row justify-content-end">
          <div class="col-sm-6 text-center p-3">
            <img src="{!!asset('letsgamenow/images/logo.png')!!}" class="mb-3" data-aos="fade-down" data-aos-duration="1000" width="100px">
             @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="login__block">
             <form id="tab-1" method="post" action="{{route('otpverifyforget')}}" class="tab-content login__form current">
               @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                      <input type="text" name="otp" value="" placeholder="Enter your OTP " required="">
                    </div>
                  </div>
                  <input type=hidden name ="mobile" value="{{$gamer->mobile ?? ''}}">
                  <input type=hidden name ="email" value="{{$gamer->email ?? ''}}">
                  <input type=hidden name ="id" value="{{$gamer->id ?? ''}}">
                  <div class="col-sm-6">
                    <div class="row align-items-center">
                      <div class="col-sm-6">
                       <div class="form-group">
                      <button type="submit" class="" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-in-sine">Submit</button>
                    </div>
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