@extends("website.layouts.master")
@section("content")
<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Upcoming Tournaments</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
  

  <div class="clearfix"></div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 d-none d-md-block">
        <div class="tournament_sidebar row">
          <div class="col-12 d-flex justify-content-center">
            <h4><span>Filter Tournaments</span></h4>
            @php
              $today = date("Y-m-d");
              @endphp
              <form action="{{route('user_created_tournaments')}}">
                <div class="form-group">
                  <select name="date" id="date" class="form-control custom-control">
                    <option value="">Select date...</option>
                    @for ($i = 0; $i <= 90; $i++)
                        <option value="{{ date('Y-m-d', strtotime($today. ' + '.$i.' days')) }}"  @php
                        if (!empty($_GET['date'])) {
                            if ($_GET['date'] == date('Y-m-d', strtotime($today. ' + '.$i.' days'))) {
                                echo 'selected';
                            }
                        }
                    @endphp>{{date("jS F",strtotime('+'.$i.' day', strtotime($today)))}}</span>  {{date("l",strtotime('+'.$i.' day', strtotime($today)))}}</option>
                    @endfor
                  </select>
                  <select name="game" id="game" class="form-control custom-control">
                    <option value=""> Select Game</option>
                    @foreach($games as $game)
                      <option value="{{ $game->id }}" @php
                        if (!empty($_GET['game'])) {
                            if ($_GET['game'] == $game->id) {
                                echo 'selected';
                            }
                        }
                    @endphp>{{ $game->name }}</option>
                    @endforeach
                  </select>
                  <button class="btn buttton_color" type="submit">submit</button>
                </div>
              </form>
          </div>
        
            {{-- <ul class="game_filter">
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
          </ul> --}}
        </div>
      </div>

      <div class="col-md-12">
        <ul class="tournament_list big">
          @foreach($tournaments as $data)
          <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $data->name)); ?>
          {{-- <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" data-match="game{{$game->game_id}}">
          --}}
          <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="news__blocks">
              <div class="img_block">
                <img src="{!!asset("$data->image")!!}" alt="" srcset="">
              </div>
              <div class="news__blocks__body flex-row align-items-center">
                @if($data->gamer_id == NULL)
                <img src="{!!asset('letsgamenow/images/logo.png')!!}" width="35px">
                @endif
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
      </div>
    </div>
  </div>

  <form action="" id="form1">
    {{-- <input type="hidden" name="date" id="start_date" value="{{$date}}"> --}}
    {{-- <input type="hidden" name="game_id" id="game_id" value="{{$game_id}}"> --}}
  </form>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  // $('.date-click').on('click', function () {
  //   $('#start_date').val($(this).attr('date-val'));
  //   $('.date-li').removeClass('active');
  //   $(this).parent('li').addClass('active');
  //   $('#form1').submit();
  // })

  // $('.game-li').on('click',function(){
  //   $('#game_id').val($(this).attr('game-val'));
  //   $('#form1').submit();
  // })
</script>
@endsection