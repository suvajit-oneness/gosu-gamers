@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Tournament Schedule</h2>
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
	  <div style=" margin-left:30%; margin-top:10px;margin-bottom: 10px;">
		<h3>Winners of Tournament {{$tournament->name}} : </h3> 	
		@foreach($tours as $name)
		<P>Winner of {{ $name->room_code}} is {{ $name->name }}</P>
		 @endforeach
	</div>
      </div>

    </div>

    </div>
  </div>

</section>

@endsection

