<!doctype html>
<html lang="en">
    {{--include styles--}}
   @include("website.layouts.header")
  <body>
  {{--include styles--}}
   @include("website.layouts.sub-header")

    <section class="banner__area inner">
      {{-- <img src="{!! asset('/letsgamenow/images/g_in/subscribe-bg.jpg')!!}" class="img-fluid"> --}}

      <h2 class="text-center">OUR Games</h2>

      <div class="news__ticker">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
              @foreach($upcoming_tournaments as $upcoming_tournament)
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-primary">{{$upcoming_tournament->game_name}}</a><a href="#">{{$upcoming_tournament->name}} is starting from {{date("M.d.Y",strtotime($upcoming_tournament->start_date))}}. Register today to participate.</a>
                </li>
              @endforeach

            </ul>
        </div>
      </div>
    </section>


    <section class="py-3 py-sm-5 inner_body_bg">
      <div class="container">
        <div class="title__area light text-center mb-4 mb-sm-5">
          <div class="section__subtitle">Latest Games</div>
          <div class="section__title" data-aos="zoom-out" data-aos-easing="ease-in-back" data-aos-duration="1000">All New Games</div>
          
        </div>
  
        <div class="clearfix"></div>

          <div class="game__row">
            <ul class="game__list">
              @foreach($latest_games as $latest_game)
              <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $latest_game->name)); ?>
              <li>
                <a href="{!! URL::to('game-details/'.$latest_game->id.'/'.$key) !!}" class="game__block" style="background-image: url('{!!asset($latest_game->image)!!}');">
                  <span class="badge badge-info ml-auto"></span>
                  <div class="game__desc mt-auto">
                    <p>{{$latest_game->name}}</p>
                    <p class="text-danger"></p>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        <div class="title__area text-center my-sm-5 my-4">
          <div class="section__subtitle">Latest Games</div>
          <div class="section__title">Games</div>
        </div>
        <ul class="game__thumb__list">
          @foreach($games as $game)
          <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $game->name)); ?>
          <li data-match="racing">
            <div class="slide__block">
              <img src="{!!asset("$game->image")!!}">
              <div class="slide__content">
              <h3><a href="{!! URL::to('game-details/'.$game->id.'/'.$key) !!}">{{$game->name}}</a></h3>
                <div class="rating">
                  Rating
                  <span class="ratings">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                </div>
              </div>
            </div>
          </li>
          @endforeach
  
        </ul>
      </div>
      
    </section>


    <section class="bluedark_bg py-4 py-sm-5 d-none">
      <div class="title__area text-center">
        <div class="section__title">Games</div>
        <div class="section__subtitle">Latest Games</div>
      </div>

      <div class="clearfix"></div>

      <div class="container-fluid mt-5">

<!--         <div class="select__area text-center">
          <div class="platform__select">
            <select class="selection__box">
              <option>Platforms</option>
              <option>Platforms</option>
              <option>Platforms</option>
              <option>Platforms</option>
              <option>Platforms</option>
              <option>Platforms</option>
            </select>
          </div>

          <div class="genres__select">
            <select class="selection__box">
              <option>Genres</option>
              <option>Genres</option>
              <option>Genres</option>
              <option>Genres</option>
              <option>Genres</option>
              <option>Genres</option>
            </select>
          </div>
        </div> -->
        <ul class="game__thumb__list">
          @foreach($games as $game)
          <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $game->name)); ?>
          <li data-match="racing">
            <div class="slide__block">
              <img src="{!!asset("$game->image")!!}">
              <div class="slide__content">
                <div class="rating">
                  Rating
                  <span class="ratings">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </span>
                </div>
                <h3><a href="{!! URL::to('game-details/'.$game->id.'/'.$key) !!}">{{$game->name}}</a></h3>
              </div>
            </div>
          </li>
          @endforeach

        </ul>


        <!-- <p class="text-center"><a href="#" class="loadmore__btn"><span>Load More</span></a></p> -->
      </div>
    </section>
  {{--include styles--}}
   @include("website.layouts.footer")

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
      $(window).on('load', function () {
        AOS.refresh();
      });
      $(function () {
        AOS.init();
      });
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

          $('.game__list').slick({
            dots: false,
            infinite: true,
            speed: 300,
            centerMode: true,
            arrows: false,
            centerPadding: '20px',
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 5,
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
      });
    </script>

  </body>
</html>