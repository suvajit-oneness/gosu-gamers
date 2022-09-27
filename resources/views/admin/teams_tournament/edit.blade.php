@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('teamstournament.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" enctype="multipart/form-data" action="{{route('teamstournament.update1')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team Name *</td>
                        <td>
                           <select class='form-control' id='team_id' name='team_id'>
                            <option value="{{$teamsname->id }}">{{ ucfirst($teamsname->team_name) }}</option>   
                            @if($teams)
                              @foreach($teams as $index => $teams)
                              <option value="{{ $teams->id }}">{{ ucfirst($teams->team_name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">room code *</td>
                        <td>
                           <input type="text" value="{{$teamstournament->room_code}}" class="form-control" name="room_code">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">tournament Name *</td>
                        <td>
                           <select class='form-control' id='tournaments' name='tournament_id'>
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
                        <td width="15%" class="text-right border-right text-uppercase">point *</td>
                        <td>
                           <input type="number" value="{{$teamstournament->point}}" class="form-control" name="point">
                        </td>
                     </tr>
                     <input type="hidden" value="{{$teamstournament->id}}" class="form-control" name="id">  
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">payment_status *</td>
                        <td>
                           <input type="number" value="{{$teamstournament->payment_status}}" class="form-control" name="payment_status">  
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">score *</td>
                        <td>
                           <input  type="number" value="{{$teamstournament->score}}" class="form-control" name="score"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">earning*</td>
                        <td>
                           <input  type="number" value="{{$teamstournament->earning}}" class="form-control" name="earning"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">currency id *</td>
                        <td>
                           <input  type="number" value="{{$teamstournament->currency_id}}" class="form-control" name="currency_id"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">status *</td>
                        <td>
                           <input  type="number" value="{{$teamstournament->status}}" class="form-control" name="status"> 
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