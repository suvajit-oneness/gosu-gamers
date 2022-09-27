<!doctype html>
<html lang="en">
    {{--include styles--}}
   @include("website.layouts.header")
  <body>
  {{--include styles--}}
   @include("website.layouts.sub-header")

    <section class="banner__area game inner">
      <img src="{!!asset('letsgamenow/images/game_details.jpg')!!}" class="img-fluid">
      <h2 class="text-center">Game Details</h2>
    </section>

    <section class="overflow_show pt-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 game_banner pr-sm-0" data-aos="fade-down" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <img src="{{URL::asset($game->image)}}" class="img-fluid game_poster">

            <div class="game__details_area">
              <div class="row align-items-center">
                <div class="col-sm-6">
                <P><h1>{{$game->name}}</h1></P>
                </div>
                <div class="col-sm-6 text-right">
                  <a href="#" class="register__btn" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1000">Register</a>
                  <a href="#" class="play__btn" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">Lets Play</a>
                </div>
              </div>
              <hr>

              <div class="row align-items-center justify-content-between game__details">
                <div class="col-sm-12">
                  <h4>About the Game</h4>
                  <div class="mb-4">{!!$game->description!!}</div>
                </div>
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col border-right">
                      <h5>62 TEAMS</h5>
                      <p>ROUND ROBIN</p>
                    </div>
                    <div class="col border-right">
                      <h5>2 GROUPS</h5>
                      <p>36 PLAYERS</p>
                    </div>
                    <div class="col">
                      <h5>Rating</h5>
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
              </div>
            </div>
          </div>         
        </div>        
      </div>
    </section>
    <section class="sponser_bg pt-5 pb-5">
      <div class="title__area mb-3 text-center">
        <div class="section__subtitle">Game Details</div>
        <div class="section__title">TOURNAMENTS</div>
      </div>
      <div class="clearfix"></div>
      <div class="container mt-5">
        <ul class="tournament_list">
          @foreach($tournaments as $tournament)
          <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $tournament->name)); ?>
          <li data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1000">
          <div class="news__blocks" style="background-image: url('{!!asset("$tournament->image")!!}');">
              <div class="news__blocks__body">
                <a href="#">{{$tournament->name}}</a>
                <h4>{{date("M.d.Y",strtotime($tournament->start_date))}}</h4>
              </div>
              <div class="news__blocks__footer">
                <div class="col d-flex p-0">
                  <div class="col">
                    <p>Entry Fee</p>
                    <h4><?php echo ($tournament->is_free==1)?'Free':0 ?></h4>
                  </div>
                  <div class="col">
                    <p>Time</p>
                    <h4>{{$tournament->start_time}}</h4>
                  </div>
                  <div class="col">
                    <p>Max Player</p>
                    <h4>
                     {{ $tournament->player_joined }} /{{$tournament->max_players}}</h4>
                  </div>
                </div>
                <div class="col-3 ml-auto p-0">
                  <a href="{!! URL::to('tournament-details/'.$tournament->id.'/'.$key) !!}" class="news__button">More Details <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </li>
          @endforeach          
        </ul>
      </div>
      <!-- <div class="clearfix p-5"></div>
      <div class="container mt-5">
        <div class="title__area text-center">
          <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" ><img src="{!!asset('letsgamenow/images/foot-logo.png')!!}"></div>
          <div class="section__subtitle">About Us</div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="container-fluid mt-5 mb-5">
        <div class="about_text" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
          <p>Lets Game Now is a simple to use esports portal for all types of gamers. With a variety of online tournaments, gamer will get the chance to qualify for international tournaments, get noticed and build a career as a professional, or just play for fun against friend and compete regularly for cash prizes.</p>
        </div>
      </div> -->
    </section>
    @include("website.layouts.footer")

    <div class="left_bar_social">
<ul class="mb-0 social_list">
<li class="facebook"><a target="_blanck" href="https://www.facebook.com/lgnindia"><i class="fab fa-facebook-f"></i></a></li>
<!-- <li class="twitter"><a target="_blanck" href="https://twitter.com/lets_game_now"><i class="fab fa-twitter"></i></a></li> -->
<li class="instagram"><a target="_blanck" href="https://instagram.com/lets_game_now"><i class="fab fa-instagram"></i></a></li>
<!-- <li class="linkedin"><a target="_blanck" href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a></li> -->
<li class="youtube"><a target="_blanck" href="https://youtube.com"><i class="fab fa-youtube"></i></a></li>
</ul>
<!-- <a class="sharethis_btn" href="#"><i class="ti-sharethis"></i></a> -->
</div>

      @include("website.layouts.scripts")

  </body>
</html>