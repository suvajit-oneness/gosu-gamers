@extends("website.layouts.master")
@section("content")
<style>
  .pagination {
      justify-content: end;
      margin-top: 25px;
  }
  .page-item {
    margin: 0 5px;
  }
  .page-link {
    background-color: transparent;
    color: #ef3f43;
    font-weight: 600;
  }
  .page-link:hover, .page-item.active .page-link, page-link {
    border-radius: 5px;
  }
  .page-item.disabled .page-link {
    color: #ef3f43;
    background-color: transparent;
    border-color: transparent;
  }
  .page-item:first-child .page-link, .page-item:last-child .page-link {
    border-radius: 5px;
  }
</style>
<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Completed Tournaments</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
  <!-- <div class="title__area mb-3 text-center">
    <div class="section__title">COMPLETED TOURNAMENTS</div>
    <div class="section__subtitle">Game Details</div>
  </div> -->

  <div class="clearfix"></div>
  @php
  $game_id = (isset($_GET['game_id']) && $_GET['game_id']!='')?$_GET['game_id']:'';
  $today = date("Y-m-d");
  @endphp

  <div class="container-fluid">
    <div class="row">
      <!-- <div class="col-sm-3">
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
      </div> -->
      <div class="col-sm-12">
        <ul class="tournament_list big">
          @foreach($tournaments as $data)
          <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $data->name)); ?>
          <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" data-match="game{{$game->game_id}}">
            <div class="news__blocks completed_events">
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
                <div class="col-6 col-sm-4 mb-2 mb-sm-0">
                  <p>Entry Fee</p>
                  @if($data->is_free == 0)
                  @php $price =$data->part_amount; @endphp
                  <h4>{{$price}}</h4>
                  @else
                  @php $price ='Free'; @endphp
                  <h4>{{$price}}</h4>
                  @endif
                </div>
                <div class="col-6 col-sm-4 mb-2 mb-sm-0">
                  <p>Time</p>
                  <h4>{{date("h:i a",strtotime($data->start_time))}}</h4>
                </div>
                <div class="col-6 col-sm-4">
                  <p>Max Player</p>
                   <h4>{{$data->player_joined}}/ {{$data->max_players}}</h4>
                </div>
              </div>
              <div class="row mx-0">
                <div class="col-12 ml-auto p-0">
                  <a href="{!! URL::to('tournament-details/'.$data->id.'/'.$key) !!}" class="news__button">More Details</a>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        {{ $tournaments->links() }}
      </div>
    </div>
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
  </div>
  <form action="" id="form1">
    <input type="hidden" name="game_id" id="game_id" value="{{$game_id}}">
  </form> -->
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

  $('.game-li').on('click',function(){
    $('#game_id').val($(this).attr('game-val'));
    $('#form1').submit();
  })
</script>
@endsection

