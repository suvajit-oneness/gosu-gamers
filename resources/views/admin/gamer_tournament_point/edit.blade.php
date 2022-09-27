@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('gamertournamentpoint.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" enctype="multipart/form-data" action="{{route('gamertournamentpoint.update1')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Gamer Tournament Schedule Id *</td>
                        <td>
                           <select class='form-control' id='schedule_id' name='schedule_id'>
                            <option value="{{ $gamertournamschedule->id }}">{{ ucfirst($gamertournamschedule->id )}}</option>       
                              @if($gamertournamentschedule)
                              @foreach($gamertournamentschedule as $index => $gamertournamentschedule)
                              <option value="{{ $gamertournamentschedule->id }}">{{ ucfirst($gamertournamentschedule->id) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <input type="hidden" value="{{$gamertournamentpoint->id}}" class="form-control" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">player1 score  *</td>
                        <td>
                           <input type="number" value="{{$gamertournamentpoint->player1_score}}" class="form-control" name="player1_score">
                           @error('player1_score') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">player2 score *</td>
                        <td>
                           <input type="number" value="{{$gamertournamentpoint->player2_score}}" class="form-control" name="player2_score">
                           @error('player2_score') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">player1 point *</td>
                        <td>
                           <input type="number" value="{{$gamertournamentpoint->player1_point}}" class="form-control" name="player1_point">  
                           @error('player1_point') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">player2 point *</td>
                        <td>
                           <input  type="number"  value="{{$gamertournamentpoint->player2_point}}"class="form-control" name="player2_point"> 
                           @error('player2_point') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">winner *</td>
                        <td>
                           <input  type="number" value="{{$gamertournamentpoint->winner}}" class="form-control" name="winner"> 
                           @error('winner') {{$message}} @enderror 
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

