@extends("website.layouts.flipkart.flipkart-master")

@section("content")

    <div class="dark_bg col-xs-12 d-none d-md-block" style="height:100px;"></div>

    <section class="banner__area game inner banner__area_full_height_fk">
        <img src="{!!asset('flipkart/images/banners/bgmi.jpg')!!}?ver={{ filemtime(public_path('flipkart/images/banners/bgmi.jpg')) }}" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;">
{{--        <h2 class="text-center">Upcoming Tournaments</h2>--}}
    </section>

    <section class="sponser_bg pt-5 pb-5">

        <div class="clearfix p-5"></div>

        <div class="container mt-5">
            <div class="title__area text-center">
                <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <img src="{!!asset('letsgamenow/images/foot-logo.png')!!}?ver={{ filemtime(public_path('letsgamenow/images/foot-logo.png')) }}"></div>
                <div class="section__subtitle">About Us</div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    <div class="tournament_sidebar">
                        <h4><span>All Games</span></h4>

                        <ul class="game_filter">
                            @foreach($games as $game)
                                <li class="game-li" game-val="{{$game->id}}">
                                    <a href="javascript:void(0);">
                                        <div class="game_thumb">
                                            <img src='{!!asset("$game->image")!!}'>
                                        </div>
                                        <div class="game_content">
                                            <h3>{{$game->name}}</h3>
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
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- <div class="tournament_sidebar">
                      <h4><span>Types</span></h4>

                      <ul class="game_filter">
                        <li>
                          <a href="#">
                            <div class="game_thumb">
                              <img src="images/cg_01.jpg">
                            </div>
                            <div class="game_content">
                              <h3>Shooting</h3>
                              <p>Prior to major incidents in the Overwatch League</p>
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <div class="game_thumb">
                              <img src="images/cg_01.jpg">
                            </div>
                            <div class="game_content">
                              <h3>Racing</h3>
                              <p>Prior to major incidents in the Overwatch League</p>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </div> -->
                </div>


                <div class="col-md-9">
                    <ul class="tournament_list big">
                        @foreach($tournaments as $data)
                            <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $data->name)); ?>
                            <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" data-match="game{{$game->game_id}}">
                                <div class="news__blocks" style="background-image: url('{!!asset("$data->image")!!}');">
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
                                            @if($data->is_free == 0)
                                                @php $price =$data->part_amount; @endphp
                                                <h4>{{$price}}</h4>
                                            @else
                                                @php $price ='Free'; @endphp
                                                <h4>{{$price}}</h4>
                                            @endif
                                        </div>
                                        <div class="col-6 col-sm-3 mb-2 mb-sm-0">
                                            <p>Time</p>
                                            <h4>{{date("h:i a",strtotime($data->start_time))}}</h4>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <p>Max Player</p>
                                            <h4>{{$data->player_joined}}/ {{$data->max_players}}</h4>
                                        </div>
                                        <div class="col-6 col-sm-3 ml-auto p-0">
                                            <a href="{!! URL::to('flipkart-gaming/tournament-details/'.$data->id.'/'.$key) !!}" class="news__button">More Details <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection

