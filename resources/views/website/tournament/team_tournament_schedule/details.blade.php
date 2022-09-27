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
  <div><a href="{{ route('gamer.tournaments.show',$user->id) }}" class="btn btn-danger float-right my-3">Tournaments</a></div>

  <table class="table table-dark" style="color: #fff;
    background-color: #110032;">
    <thead>
      <tr>
        <th class="text-center" scope="col">#</th>
        <th class="text-center" scope="col">Tournament Name</th>
        <th class="text-center" scope="col">Team 1</th>
        <th class="text-center" scope="col">Team 2</th>
        <th class="text-center" scope="col">Start Time</th>
        <th class="text-center" scope="col">End Time</th>
        <th class="text-center" scope="col">winner</th>
        <th class="text-center" scope="col">stage</th>
        <th class="text-center" scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php $slno = 1; ?>
    @if($teamtournamentschedule)
    @foreach($teamtournamentschedule as $data)
      <tr>
        <th scope="row">{{$slno}}</th>
        <td class="text-center">{{$data->tname}}</td>
        <td class="text-center">{{$data->Team1name}}</td>
        <td class="text-center">{{$data->Team2name}}</td>
        <td class="text-center">{{$data->start_time}}</td>
        <td class="text-center">{{$data->end_time}}</td>
        <td class="text-center">{{$data->Team3name}}</td>
        <td class="text-center">{{$data->stage}}</td>
        <td>
            <a class="badge bg-primary text-light"href="{{route('gamer.tournaments.teamtournamentschedule.edit',$data->id)}}">Select Winner</a>
        </td>
      </tr>
    <?php $slno = $slno + 1; ?>  
    @endforeach
    @endif
       
    </tbody>
  </table>
</div>
  <div class="clearfix p-5"></div>

  <div class="container mt-5">
    <div class="title__area text-center">
      <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" ><img src="{!!asset('letsgamenow/images/foot-logo.png')!!}"></div>
      <div class="section__subtitle">About Us</div>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="container-fluid mt-5 mb-5">
    <div class="about_text" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
      <p>Lets Game Now is a simple to use esports portal for all types of gamers. With a variety of online tournaments, gamer will get the chance to qualify for international tournaments, get noticed and build a career as a professional, or just play for fun against friend and compete regularly for cash prizes.</p>
    </div>
  </div>
</section>
@endsection

