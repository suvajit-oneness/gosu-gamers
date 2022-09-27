@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Teams Tournament Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('teamstournament.index') }}"><i class="icon-exit ml-2"></i>Back</a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong class="text-uppercase">team id :</strong>
               {{$teamstournament->name}} <strong class="text-uppercase">Game Id :</strong> {{$teamstournament->team_id}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">tournament id :</strong>
               {{$teamstournament->tournament_id }}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">room code :</strong>
               {{$teamstournament->room_code}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">point :</strong>
               {{$teamstournament->point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">payment status :</strong>
               {{$teamstournament->payment_status}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">score :</strong>
               {{$teamstournament->score}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">earning :</strong>
               {{$teamstournament->earning}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">currency_id :</strong>
               {{$teamstournament->currency_id}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">status :</strong>
               {{$teamstournament->status}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection