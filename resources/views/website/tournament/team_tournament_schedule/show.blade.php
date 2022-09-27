@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Team Tournament Schedule Details</h2>
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
   </div>

</section>

@endsection

