@extends("website.layouts.master")
@section("content")
    <section class="banner__area game inner">
      <img src="{!!asset('letsgamenow/images/game_details.jpg')!!}
      " class="img-fluid">
      <h2 class="text-center">Game Details</h2>
    </section>
    <section class="sponser_bg pt-5 pb-5">
      <div class="title__area mb-3 text-center">
        <div class="section__title"> MY TOURNAMENTS</div>
        <div class="section__subtitle">Game Details</div>
      </div>
      <div class="clearfix"></div>
      <div class="explore__tab mt-3 mb-3">
     
      </div>
      <div class="clearfix"></div>
      <div class="container-fluid">
        <ul class="tournament_list big ">
          @foreach($tournaments as $data)
          <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $data->name)); ?>
          <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" >
            <div class="news__blocks" style="background-image: url({!!asset("$data->image")!!});">
              <div class="news__blocks__body flex-row align-items-center">
                <img src="{!!asset('letsgamenow/images/logo.png')!!}" width="60px">
                <div class="col">
                  <a href="#">{{$data->name}}</a>
                  <h4>{{date("M.d.Y",strtotime($data->start_date))}}</h4>
                </div>
              </div>
              <div class="news__blocks__footer row m-0">
                <div class="col-6 col-sm-3 mb-2 mb-sm-0">
                  <p>Entry Fee</p>
                  <h4>Free</h4>
                </div>
                <div class="col-6 col-sm-3 mb-2 mb-sm-0">
                  <p>Time</p>
                  <h4>{{$data->start_time}}</h4>
                </div>
                <div class="col-6 col-sm-3">
                  <p>Max Player</p>
                  <h4>{{$data->max_players}} / {{$data->max_players}}</h4>
                </div>
                <div class="col-6 col-sm-3 ml-auto p-0">
                  <a href="{!! URL::to('tournament-details/'.$data->id.'/'.$key) !!}" class="news__button">More Details <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
      <div class="clearfix p-5"></div>
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
      </div>
   </section>
@endsection