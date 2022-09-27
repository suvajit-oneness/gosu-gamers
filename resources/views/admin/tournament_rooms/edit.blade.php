@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('tournamentrooms.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
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
                   <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Edit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection