@extends("website.layouts.flipkart.flipkart-master")

@section("content")

<img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid">
{{-- <h2 class="text-center">Upcoming Tournaments</h2> --}}
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 d-md-none d-block mobile-date-listing">
      <div class="panel-group" role="tablist">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
            <h4 class="panel-title">
              <a class="collapsed btn date-btn" data-toggle="collapse" href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                <i class="far fa-calendar-alt" style="font-size: 27px;" aria-hidden="true"></i>
              </a>
            </h4>
          </div>
          <div id="collapseListGroup1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
            <ul class="list-group date_list">
              @php
                $date = (isset($_GET['date']) && $_GET['date']!='')?$_GET['date']:date("Y-m-d");
                $game_id = (isset($_GET['game_id']) && $_GET['game_id']!='')?$_GET['game_id']:'';
                $today = date("Y-m-d");
              @endphp
              <li class="date-li @if($today==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val="{{$today}}">
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime($today))}}</span> Today
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+1 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+1 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+1 day', strtotime($today)))}}</span> Tomorrow
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+2 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+2 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+2 day', strtotime($today)))}}</span> {{date("l",strtotime('+2 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+3 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+3 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+3 day', strtotime($today)))}}</span> {{date("l",strtotime('+3 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+4 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+4 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+4 day', strtotime($today)))}}</span> {{date("l",strtotime('+4 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+5 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+5 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+5 day', strtotime($today)))}}</span> {{date("l",strtotime('+5 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+6 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+6 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+6 day', strtotime($today)))}}</span> {{date("l",strtotime('+6 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+7 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+7 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+7 day', strtotime($today)))}}</span> {{date("l",strtotime('+7 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+8 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+8 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+8 day', strtotime($today)))}}</span> {{date("l",strtotime('+8 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+9 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+9 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+9 day', strtotime($today)))}}</span> {{date("l",strtotime('+9 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+10 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+10 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+10 day', strtotime($today)))}}</span> {{date("l",strtotime('+10 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+11 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+11 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+11 day', strtotime($today)))}}</span> {{date("l",strtotime('+11 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+12 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+12 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+12 day', strtotime($today)))}}</span> {{date("l",strtotime('+12 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+13 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+13 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+13 day', strtotime($today)))}}</span> {{date("l",strtotime('+13 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+14 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+14 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+14 day', strtotime($today)))}}</span> {{date("l",strtotime('+14 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+15 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+15 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+15 day', strtotime($today)))}}</span> {{date("l",strtotime('+15 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+16 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+16 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+16 day', strtotime($today)))}}</span> {{date("l",strtotime('+16 day', strtotime($today)))}}
                </a>
              </li>
              <li class="date-li @if(date('Y-m-d', strtotime('+17 day'))==$date){{'active'}}@endif">
                <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+17 day"))}}'>
                  <i class="far fa-calendar-alt"></i>
                  <span>{{date("jS F",strtotime('+17 day', strtotime($today)))}}</span> {{date("l",strtotime('+17 day', strtotime($today)))}}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-none d-md-block">
      <div class="tournament_sidebar row">
        <div class="col-6"><h4><span>All Games</span></h4></div>
        <div class="col-6">
          <div class="panel-group" role="tablist">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                <h4 class="panel-title">
                  <a class="collapsed btn date-btn" data-toggle="collapse" href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1" data-toggle="tooltip" data-html="true" title="Calendar">
                    <i class="far fa-calendar-alt" style="font-size: 27px;" aria-hidden="true"></i>
                  </a>
                </h4>
              </div>
              <div id="collapseListGroup1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                <ul class="list-group date_list">
                  @php
                    $date = (isset($_GET['date']) && $_GET['date']!='')?$_GET['date']:date("Y-m-d");
                    $game_id = (isset($_GET['game_id']) && $_GET['game_id']!='')?$_GET['game_id']:'';
                    $today = date("Y-m-d");
                  @endphp
                  <li class="date-li @if($today==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val="{{$today}}">
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime($today))}}</span> Today
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+1 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+1 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+1 day', strtotime($today)))}}</span> Tomorrow
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+2 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+2 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+2 day', strtotime($today)))}}</span> {{date("l",strtotime('+2 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+3 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+3 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+3 day', strtotime($today)))}}</span> {{date("l",strtotime('+3 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+4 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+4 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+4 day', strtotime($today)))}}</span> {{date("l",strtotime('+4 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+5 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+5 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+5 day', strtotime($today)))}}</span> {{date("l",strtotime('+5 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+6 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+6 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+6 day', strtotime($today)))}}</span> {{date("l",strtotime('+6 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+7 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+7 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+7 day', strtotime($today)))}}</span> {{date("l",strtotime('+7 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+8 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+8 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+8 day', strtotime($today)))}}</span> {{date("l",strtotime('+8 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+9 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+9 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+9 day', strtotime($today)))}}</span> {{date("l",strtotime('+9 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+10 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+10 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+10 day', strtotime($today)))}}</span> {{date("l",strtotime('+10 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+11 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+11 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+11 day', strtotime($today)))}}</span> {{date("l",strtotime('+11 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+12 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+12 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+12 day', strtotime($today)))}}</span> {{date("l",strtotime('+12 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+13 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+13 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+13 day', strtotime($today)))}}</span> {{date("l",strtotime('+13 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+14 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+14 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+14 day', strtotime($today)))}}</span> {{date("l",strtotime('+14 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+15 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+15 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+15 day', strtotime($today)))}}</span> {{date("l",strtotime('+15 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+16 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+16 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+16 day', strtotime($today)))}}</span> {{date("l",strtotime('+16 day', strtotime($today)))}}
                    </a>
                  </li>
                  <li class="date-li @if(date('Y-m-d', strtotime('+17 day'))==$date){{'active'}}@endif">
                    <a href="javascript:void(0);" class="date-click" date-val='{{date("Y-m-d", strtotime("+17 day"))}}'>
                      <i class="far fa-calendar-alt"></i>
                      <span>{{date("jS F",strtotime('+17 day', strtotime($today)))}}</span> {{date("l",strtotime('+17 day', strtotime($today)))}}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
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
              @if($data->gamer_id == NULL)
              <img src="{!!asset('letsgamenow/images/logo.png')!!}" width="60px">
              @endif
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
                <a href="{!! URL::to('tournament-details/'.$data->id.'/'.$key) !!}" class="news__button">More Details <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
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
<form action="" id="form1">
  <input type="hidden" name="date" id="start_date" value="{{$date}}">
  <input type="hidden" name="game_id" id="game_id" value="{{$game_id}}">
</form>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$('.date-click').on('click',function(){
  $('#start_date').val($(this).attr('date-val'));
  $('.date-li').removeClass('active');
  $(this).parent('li').addClass('active');
  $('#form1').submit();
})

$('.game-li').on('click',function(){
  $('#game_id').val($(this).attr('game-val'));
  $('#form1').submit();
})
</script>

@endsection

