@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Teams Tournament Details </h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>
   <div class="container">
      <div class="content">

         <div class="card">
            <div class="card-header">
            <a class="btn btn-danger float-right" href="{{ route('gamer.teamstournament.index',$user->id) }}"><i class="icon-exit ml-2"></i> Back</a>
            </div>
            <div class="card-body">
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
   </div>

</section>

@endsection