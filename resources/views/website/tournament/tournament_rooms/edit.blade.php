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
      <form method="post" enctype="multipart/form-data" action="{{route('tournamentrooms.update1')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Tournaments *</td>
                        <td>
                           <select class='form-control' id='tournaments_id' name='tournaments_id'>
                              <option value="{{ $tournamentsname->id }}">{{ ucfirst($tournamentsname->name) }}</option>                              
                              @if($tournaments)
                              @foreach($tournaments as $index => $tournaments)
                              <option value="{{ $tournaments->id }}">{{ ucfirst($tournaments->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">game_room_id  *</td>
                        <td>
                           <input type="number" value="{{$tournamentrooms->game_room_id}}" class="form-control" name="game_room_id">
                           @error('game_room_id') {{$message}} @enderror
                        </td>
                     </tr>
                     <input type="hidden" value="{{$tournamentrooms->id}}" class="form-control" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">room code *</td>
                        <td>
                           <input type="text" value="{{$tournamentrooms->room_code}}" class="form-control" name="room_code">
                           @error('room_code') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">status *</td>
                        <td>
                           <input type="number"value="{{$tournamentrooms->status}}" class="form-control" name="status">  
                           @error('status') {{$message}} @enderror
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                   <button type="submit" class="btn btn-primary"><i class="fas fa-edit mr-1"></i>Edit</button>
               </div>
            </div>
         </form>
      </div>

    </div>

    </div>
  </div>

</section>


@endsection

