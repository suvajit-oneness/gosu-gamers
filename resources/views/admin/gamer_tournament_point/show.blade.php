@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Gamer Tournament Point Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('gamertournamentpoint.index') }}"><i class="icon-exit ml-2"></i>Back </a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong class="text-uppercase">schedule_id :</strong>
               {{$gamertournamentpoint->schedule_id}} 
            </div>
            <div class="form-group">
               <strong class="text-uppercase">player1 score :</strong>
               {{$gamertournamentpoint->player1_score}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">player2 score :</strong>
               {{$gamertournamentpoint->player2_score}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">player1 point :</strong>
               {{$gamertournamentpoint->player1_point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">player2 point:</strong>
               {{$gamertournamentpoint->player2_point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">Winner :</strong>
               {{$gamertournamentpoint->winner}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection