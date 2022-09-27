@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px; margin-top:15px">Tournament Rooms Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('tournamentrooms.index') }}"><i class="icon-exit ml-2"></i>Back </a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong class="text-uppercase">tournament id :</strong>
               {{$tournamentrooms->tournament_id}} 
            </div>
            <div class="form-group">
               <strong class="text-uppercase">game room id :</strong>
               {{$tournamentrooms->game_room_id}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">room code :</strong>
               {{$tournamentrooms->room_code}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">status :</strong>
               {{$tournamentrooms->status}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

