@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Gamer Tournament Schedule Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('gamertournamentschedule.index') }}"><i class="icon-exit ml-2"></i>Back </a>
         </div>
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
@endsection

