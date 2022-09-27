@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Tournament Rooms Details </h2>
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
  </div>

</section>

@endsection

