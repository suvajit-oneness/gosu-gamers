@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); 
 $userId = Auth::guard('gamer')->user()->id;
 $today = date('Y-d-m');
@endphp
@endif

@extends("website.layouts.master")
@section("content")
<section class="banner__area game inner">
  <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid">
  <h2 class="text-center">All Message</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
  <div class="clearfix"></div>

  <div class="container">
    <div><a href="{{ route('gamer.tournaments.show',$user->id) }}" class="edit__team__member float-right my-3">Back</a>
    </div>
    <div class="team__member__list__table">
      <div class="table-responive">
        <table class="table">
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Tournament Name</th>
            <th class="text-center">Name</th>
            <th class="text-center">Action</th>
          </tr>
          <?php $slno = 1; ?>
          @if($data)
          @foreach($data as $key =>$dataValue)
          @php
          $getTname = App\Models\Tournaments::where('id', $dataValue->tournament_id)->first();
          $getName = App\Models\Gamer::where('id', $dataValue->gamer_id)->first();
          @endphp
          <tr>
            <td class="text-center">{{$slno}}</td>
            <td class="text-center">{{$getTname->name}}</td>
            <td class="text-center">{{$getName->fname}} {{ $getName->lname }} </td>
            <td>
              <div class="list-icons text-center">
                <a class="btn btn-warning m-1 position-relative toggle"
                  href="#chat{{ $dataValue->gamer_id}}" data-toggle="tooltip"><i
                    class="fas fa-sms "></i>
                    @php
                    $latest_UserSMS = App\Models\TournamentChat::where('tournament_id', $dataValue->tournament_id)->where('gamer_id', $userId)->where('sms_to', $getName->id)->latest('created_at')->first();
                    @endphp
                    @if($latest_UserSMS)
                      @php
                      // dd($latest_UserSMS->message);
                        $countSMS = App\Models\TournamentChat::where('tournament_id', $dataValue->tournament_id)->where('gamer_id', $getName->id)->where('sms_to', $userId)->where('created_at', '>', $latest_UserSMS->created_at)->count();
                      @endphp
                      @if($countSMS>0)
                        <span class="sms_count">{{ $countSMS }}</span>
                      @endif
                    @else
                      @php
                        $countSMS = App\Models\TournamentChat::where('tournament_id', $dataValue->tournament_id)->where('gamer_id', $getName->id)->where('sms_to', $userId)->count();
                      @endphp
                      <span class="sms_count">{{ $countSMS }}</span>
                    @endif
                </a>
              </div>

              <!-- Modal -->
              <div class="wrapper" >
                <div class="chat_dive content" id="chat{{ $dataValue->gamer_id }}" >
                  @php
                  $gamerId = $dataValue->gamer_id;
                  $getcreator = $getTname->gamer_id==NULL ? "Admin" : $userId;
                  $getSMS = DB::table('tournament_chats')
                  ->where(function($query) use($getcreator, $gamerId) {
                  $query->where('gamer_id', $getcreator)
                  ->orWhere('gamer_id', $gamerId);
                  })
                  ->where('tournament_id', $dataValue->tournament_id)
                  ->orderBy('created_at', 'ASC')->get();
                  @endphp
                  <h3>{{ ($getTname->gamer_id==NULL)? "Admin" : "$getName->fname $getName->lname" }} 
                    {{-- <span class="online">online</span> --}}
                    <button class="Closer">×</button>
                  </h3>
                  <ul class="chat_msg" id="online_chat">
                    @if($getSMS)
                    @foreach($getSMS as $getSMSKey => $getSMSValue)
                    @php
                    $fetchDate = date("Y-d-m",strtotime($getSMSValue->created_at))
                    @endphp
                    @if($getSMSValue->gamer_id == $userId && $getSMSValue->sms_to == $gamerId)
                    <li id="get_data">
                      <div class="msg you">
                        {{ $getSMSValue->message }}
                        <span
                          class="time">{{($fetchDate == $today) ? "Today ".date("h:i",strtotime($getSMSValue->created_at)): date("d m h:i",strtotime($getSMSValue->created_at))}}</span>
                      </div>
                    </li>
                    @elseif($getSMSValue->gamer_id = $gamerId && $getSMSValue->sms_to == $userId)
                    <li id="get_data">
                      <div class="msg him">
                        {{ $getSMSValue->message }}
                        <span
                          class="time">{{($fetchDate == $today) ? "Today ".date("h:i",strtotime($getSMSValue->created_at)): date("d m h:i",strtotime($getSMSValue->created_at))}}</span>
                      </div>
                    </li>
                    @endif
                    @endforeach
                    @endif
                  </ul>
                  <form>
                    <div class="input-group">
                      <input type="hidden" name="tournament_id" value="{{ $dataValue->tournament_id }}">
                      <input type="hidden" name="gamer_id" value="{{ $userId }}">
                      <input type="hidden" name="creator" value="{{ $userId }}">
                      <input type="hidden" name="sms_to" value="{{ $gamerId }}">
                      <input type="text" class="form-control" name="sms" placeholder="Enter here...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"  onclick="createPost()"><img src="{{ asset('letsgamenow/images/live_chat/send.svg') }}" width="22px"></button>
                        </span>
                    </div>
                  </form>
                  <!-- /input-group -->
                </div>
              </div>
            </td>
          </tr>
          <?php $slno = $slno + 1; ?>
          @endforeach
          @endif
        </table>
      </div>
    </div>
  </div>

  
  <div class="clearfix p-5"></div>

  <div class="container mt-5">
    <div class="title__area text-center">
      <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000"><img
          src="{!!asset('letsgamenow/images/foot-logo.png')!!}"></div>
      <div class="section__subtitle">About Us</div>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="container-fluid mt-5 mb-5">
    <div class="about_text" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
      <p>Lets Game Now is a simple to use esports portal for all types of gamers. With a variety of online tournaments,
        gamer will get the chance to qualify for international tournaments, get noticed and build a career as a
        professional, or just play for fun against friend and compete regularly for cash prizes.</p>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  $(".toggle").on("click", function(){
      $(".content").toggle(); // fadeToggle() // .slideToggle()
    });

    $(".toggle").click(function () {
    // Display active tab
    let currentTab = $(this).attr("href");
    $(".content").hide();
    $(currentTab).show();
    return false;
  });
  $(".Closer").click(function () {

        // This will close the dialog
        $(".content").hide();
    });

    
   function createPost() {
    var tournament_id = $('#tournament_id').val();
    var gamer_id = $('#user_id').val();
    var sms_to = $('#sms_to').val();
    var creator = $('#creator').val();
    var sms = $('#sms').val();
      var d = new Date();
      var month = d.getMonth() + 1;
      var day = d.getDate();
      var time = d.getHours() + ":" + d.getMinutes();
      var year = d.getFullYear();
      var today = (day<10?'0':'')+ day + '-' +(month<10?'0':'')+ month + '-' + year;
   //  console.log(time);
    let _url     = `{{route('gamer.tournaments.sms')}}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: _url,
        type: "POST",
        data: {
          tournament_id: tournament_id,
          sms: sms,
          gamer_id: gamer_id,
          sms_to: sms_to,
          creator: creator,
          _token: _token
        },
        success: function(response) {
         const d = new Date(response.data.created_at);
          const formattedDate = d.getHours() + ':' + ("0" + (d.getMinutes())).slice(-2)
           $("#online_chat").append('<li id="get_data"><div class="msg you">'+response.data.message+'<span class="time">'+formattedDate+'</span></div></li>');
        }
      });
      $('#sms').val('');
  }
</script>
@endsection