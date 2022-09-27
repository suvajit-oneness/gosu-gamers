

@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Gamer Tournament Schedule Details</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>
   <div class="container">
      <div class="content">

         <div class="card">
            <div class="card-header">
            <a class="btn btn-danger float-right" href="{{ route('gamer.tournaments.show',$user->id) }}"><i class="icon-exit ml-2"></i> Back</a>
            </div>
            <div class="card-body">
               <div class="content">
                  <div class="form-group">
                     <strong class="text-uppercase">Name :</strong>
                     {{$gamertournamentschedule->name}} <strong class="text-uppercase">Game Id :</strong> {{$gamertournamentschedule->game_id}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">player1 :</strong>
                     {{$gamertournamentschedule->player1}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">player2 :</strong>
                     {{$gamertournamentschedule->player2}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">tournament_id :</strong>
                     {{$gamertournamentschedule->tournament_id}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">start_time :</strong>
                     {{$gamertournamentschedule->start_time}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">end_time :</strong>
                     {{$gamertournamentschedule->end_time}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">stage :</strong>
                     {{$gamertournamentschedule->stage}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">room_code :</strong>
                     {{$gamertournamentschedule->room_code}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">winner :</strong>
                     {{$gamertournamentschedule->winner}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">runner :</strong>
                     {{$gamertournamentschedule->runner}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">winner_point :</strong>
                     {{$gamertournamentschedule->winner_point}}
                  </div>
                  <div class="form-group">
                     <strong class="text-uppercase">runner_point :</strong>
                     {{$gamertournamentschedule->runner_point}}
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>

</section>

@endsection

