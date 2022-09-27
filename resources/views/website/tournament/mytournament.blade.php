@extends("website.layouts.master")
@section("content")
    <section class="banner__area game inner">
      <!-- <img src="{!!asset('letsgamenow/images/game_details.jpg')!!}
      " class="img-fluid"> -->
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
            <div class="news__blocks">
              <div class="img_block">
                <img src="{!!asset("$data->image")!!}" alt="" srcset="">
              </div>
              <div class="news__blocks__body flex-row align-items-center">
                <img src="{!!asset('letsgamenow/images/logo.png')!!}" width="35px">
                <div class="col">
                  <a href="#">{{$data->name}}</a>
                  <h4>{{date("M.d.Y",strtotime($data->start_date))}}</h4>
                </div>
              </div>
              <div class="news__blocks__footer row">
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
              </div>
              <div class="row mx-0">
                <div class="col-12 ml-auto p-0">
                <a href="{!! URL::to('tournament-details/'.$data->id.'/'.$key) !!}" class="news__button">More Details </a>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
   </section>
@endsection