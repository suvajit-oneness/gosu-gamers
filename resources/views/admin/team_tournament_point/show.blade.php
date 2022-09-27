@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Team Tournament Point Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('teamtournamentpoint.index') }}"><i class="icon-exit ml-2"></i>Back </a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong class="text-uppercase">team schedule id :</strong>
               {{$teamtournamentpoint->team_schedule_id}} 
            </div>
            <div class="form-group">
               <strong class="text-uppercase">team1 score :</strong>
               {{$teamtournamentpoint->team1_score}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">team2 scoren :</strong>
               {{$teamtournamentpoint->team2_score}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">team1 point :</strong>
               {{$teamtournamentpoint->team1_point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">team2 point :</strong>
               {{$teamtournamentpoint->team2_point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">winner :</strong>
               {{$teamtournamentpoint->winner}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

