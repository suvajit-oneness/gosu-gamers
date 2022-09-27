

@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('teamtournamentpoint.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" enctype="multipart/form-data" action="{{route('teamtournamentpoint.update1')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team tournament schedule *</td>
                        <td>
                           <select class='form-control' id='teamtournamentschedule' name='teamtournamentschedule_id'>
                           <option value="{{ $teamtournamenschedule->id }}">{{ ucfirst($teamtournamenschedule->id) }}</option>                             
                              @if($teamtournamentschedule)
                              @foreach($teamtournamentschedule as $index => $teamtournamentschedule)
                              <option value="{{ $teamtournamentschedule->id }}">{{ ucfirst($teamtournamentschedule->id) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team1_score  *</td>
                        <td>
                           <input type="number" value="{{$teamtournamentpoint->team1_score}}" class="form-control" name="team1_score">
                        </td>
                     </tr>
                     <input type="hidden" value="{{$teamtournamentpoint->id}}" class="form-control" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team2_score *</td>
                        <td>
                           <input type="number" value="{{$teamtournamentpoint->team2_score}}" class="form-control" name="team2_score">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team1_point *</td>
                        <td>
                           <input type="number" value="{{$teamtournamentpoint->team1_point}}" class="form-control" name="team1_point">  
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team2_point *</td>
                        <td>
                           <input type="number" value="{{$teamtournamentpoint->team2_point}}" class="form-control" name="team2_point">  
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">winner *</td>
                        <td>
                           <input type="number" value="{{$teamtournamentpoint->winner}}" class="form-control" name="winner">  
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

