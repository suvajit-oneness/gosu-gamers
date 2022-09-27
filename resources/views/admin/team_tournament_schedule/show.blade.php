@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Team Tournament Schedule Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('teamtournamentschedule.index') }}"><i class="icon-exit ml-2"></i>Back </a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong class="text-uppercase">team1 :</strong>
               {{$teamtournamentschedule->team1}} 
            </div>
            <div class="form-group">
               <strong class="text-uppercase">team2 :</strong>
               {{$teamtournamentschedule->team2}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">tournament id :</strong>
               {{$teamtournamentschedule->tournament_id}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">start time :</strong>
               {{$teamtournamentschedule->start_time}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">end time :</strong>
               {{$teamtournamentschedule->end_time}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">stage :</strong>
               {{$teamtournamentschedule->stage}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">room code :</strong>
               {{$teamtournamentschedule->room_code}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">winner :</strong>
               {{$teamtournamentschedule->winner}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">runner :</strong>
               {{$teamtournamentschedule->runner}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">winner point :</strong>
               {{$teamtournamentschedule->winner_point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">runner point :</strong>
               {{$teamtournamentschedule->runner_point}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

