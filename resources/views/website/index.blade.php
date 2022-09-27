@extends("website.layouts.master")
@section("content")
<style type="text/css">
.videoWrapper { position: relative; padding-bottom: 56.25%; /* 16:9 */ height: 0; }
.videoWrapper iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
.news__blocks{background-size: cover !important;}
</style>
<section class="banner__area" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-offset="0">
      <ul class="banner">
        @foreach($banners as $banner)
        <li><a href="{{$banner->description}}"><img src="{{URL::asset($banner->image)}}" class="img-fluid"></a></li>
        @endforeach
        
      </ul>

      <div class="news__ticker" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-delay="500" data-aos-duration="1000">
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
   {{-- <section class="dark_bg pt-5 pb-5">--}}
{{--      <div class="container">--}}
{{--        <div class="videoWrapper">--}}
{{--          <iframe width="949" height="534" src="https://www.youtube.com/embed/8yiWSS_PpRs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </section> --}}

<section class="gin_allgame py-3 py-sm-5">
  <div class="container-fluid">
    <div class="title__area text-center">
      <div class="section__subtitle">Games</div>
      <div class="section__title">Games</div>
    </div>
    <div class="clearfix"></div>
  
    <ul class="slide__wrapper mt-3 mt-sm-5" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
      @foreach($games as $game)
      <li data-match="game{{$game->id}}" onclick="location.href='{!! URL::to('upcoming-tournaments') !!}'">
        <div class="slide__block">
          <figure>
            <img src="{{URL::asset($game->image)}}">
          </figure>
          <div class="slide__content">
            <h3><a href="#">{{$game->name}}</a></h3>
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

    <section class="py-3 py-sm-5 upcom_tournament">
      <div class="title__area text-center mb-3 mb-sm-5">
        <div class="section__subtitle">Tournaments</div>
        <div class="section__title text-white">Upcoming Tournaments</div>
      </div>
      <div class="container mt-5">
        <div class="row newsarea">
          <div class="col-sm-12" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <ul class="upcoming_tournament">
              @foreach($tournaments as $key => $n)
              @php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $n->name)); @endphp
              <li>
                <div class="news__blocks">
                <div class="img_block">
                  <img src="{{ asset($n->image) }}" alt="" srcset="">
                </div>
                <div class="news__blocks__body flex-row align-items-center">
                  <img src="{!!asset('letsgamenow/images/logo.png')!!}" width="35px">
                  <div class="col">
                    <a href="{!! URL::to('tournament-details/'.$n->id.'/'.$key) !!}">{{$n->name}}</a>
                    <h4>{{$n->start_date}}</h4>
                  </div>
                </div>
                <div class="news__blocks__footer row">
                  <div class="col-12 col-sm-12 mb-2 mb-sm-0">
                    <p>Game Name</p>
                    @php
                    $getGame = App\Models\Game::where('id', $n->game_id)->first();
                    @endphp
                    <h4>{{$getGame->name}}</h4>
                  </div>
                </div>
                <div class="row mx-0">
                  <div class="col-12 ml-auto p-0">
                    <a href="{!! URL::to('tournament-details/'.$n->id.'/'.$key) !!}" class="news__button">More Details</a>
                  </div>
                </div>

                  <!-- <div class="news__blocks__body">
                    <a href="{!! URL::to('tournament-details/'.$n->id.'/'.$key) !!}">{{$n->name}}</a>
                    <h4>{{$n->start_date}}</h4>
                  </div>
                  <div class="news__blocks__footer">
                    <div class="col d-flex p-0">
                      <div class="col">
                        <p>Game Name</p>
                        @php
                        $getGame = App\Models\Game::where('id', $n->game_id)->first();
                        @endphp
                        <h4>{{$getGame->name}}</h4>
                      </div>
                      <div class="col">
                      </div>
                    </div>
                    <div class="col-6 col-sm-4 ml-auto p-0">
                      <a href="{!! URL::to('tournament-details/'.$n->id.'/'.$key) !!}" class="news__button">More Details <i class="fas fa-arrow-right"></i></a>
                    </div> -->
                  </div>

              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </section>
    
    <!-- <section class="pt-5 pb-5 hot_news">
      <div class="title__area text-center">
        <div class="section__subtitle">Latest News</div>
        <div class="section__title">Hot News</div>
      </div>
      <div class="clearfix"></div>
      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-12" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <ul class="news__list">
              @foreach($news as $n)
              <li>
                <div class="news__image">
                  <img src="{{URL::asset($n->image)}}">
                </div>
                <div class="news__content">
                  <h2>{{$n->title}}</h2>
                  <h4><a href="" class="badge badge-primary">{{$news_categories_arr[$n->category_id]}}</a> {{$n->post_date}}</h4>
                </div>
              </li>
              @endforeach
              
            </ul>
          </div>
        </div>
      </div>
    </section> -->

    <section class="testimonial_bg py-5">
      <div class="container">
        <div class="title__area text-center">
          <div class="section__subtitle">ALL REVIEWS</div>
          <div class="section__title text-white">Players Testimonials</div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container mt-5">
        <div class="testimonial__row">
          <ul class="testimonials testimonial_slider" data-aos="fade-down" data-aos-easing="ease-in-back" data-aos-duration="1000">
           @foreach($testimonials as $testimonial)
            <li>
              <div class="testimonial_block">
                <span class="test__image"><img src="{{URL::asset($testimonial->image)}}" style="width: 100px;"></span>
                <p>{!!$testimonial->content!!}</p>
                <h4>{{$testimonial->author}}</h4>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </section>

@endsection
