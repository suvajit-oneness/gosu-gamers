
@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Gamer Tournaments Details </h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>
   <div class="container">
      <div class="content">

         <div class="card">
            <div class="card-header">
            <a class="btn btn-danger float-md-right" href="{{ route('gamer.tournaments.show',$user->id) }}"><i class="icon-exit ml-2"></i> Back</a>
            </div>
            <div class="card-body">
            <div class="content">
            <div class="form-group">
               <strong class="text-uppercase">user_id :</strong>
               {{$gamerstournaments->user_id}} 
            </div>
            <div class="form-group">
               <strong class="text-uppercase">tournament_id:</strong>
               {{$gamerstournaments->tournament_id}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">room_code :</strong>
               {{$gamerstournaments->room_code}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">point :</strong>
               {{$gamerstournaments->point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">payment_status :</strong>
               {{$gamerstournaments->payment_status}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">score :</strong>
               {{$gamerstournaments->score}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">earning :</strong>
               {{$gamerstournaments->earning}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase"> currency_id  :</strong>
               {{$gamerstournaments-> currency_id }}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">status :</strong>
               {{$gamerstournaments->status}}
            </div>
         </div>
            </div>

         </div>
      </div>
   </div>

</section>

@endsection
