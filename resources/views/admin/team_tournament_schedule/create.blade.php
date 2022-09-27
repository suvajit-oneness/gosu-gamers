@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('teamtournamentschedule.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" enctype="multipart/form-data" action="{{route('teamtournamentschedule.store')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">tournaments *</td>
                        <td colspan="4">
                           <select class='form-control' id='tournament' name='tournament_id'>
                              @if($tournaments)
                              @foreach($tournaments as $index => $tournaments)
                              <option value="{{ $tournaments->id }}">{{ ucfirst($tournaments->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team1  *</td>
                        <td colspan="4">
                           <input type="number" class="form-control" name="team1">
                           @error('team1') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team2 *</td>
                        <td colspan="4">
                           <input type="number" class="form-control" name="team2">
                           @error('team2') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">stage *</td>
                       <td colspan="4">
                           <input type="text" class="form-control" name="stage">  
                           @error('stage') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">room code *</td>
                        <td colspan="4">
                           <input  type="text" class="form-control" name="room_code"> 
                           @error('room_code') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">start time *</td>
                        <td>
                           <input  type="time" class="form-control" name="start_time"> 
                           @error('start_time') {{$message}} @enderror 
                        </td>
                        <td width="15%" class="text-right border-right text-uppercase">end time *</td>
                        <td>
                           <input  type="time" class="form-control" name="end_time"> 
                           @error('end_time') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">winner *</td>
                        <td colspan="4">
                           <input  type="number" class="form-control" name="winner"> 
                           @error('winner') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">runner *</td>
                       <td colspan="4">
                           <input  type="number" class="form-control" name="runner"> 
                           @error('runner') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">winner point *</td>
                        <td colspan="4">
                           <input  type="number" class="form-control" name="winner_point"> 
                           @error('winner_point') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">runner point *</td>
                        <td colspan="4">
                           <input  type="number" class="form-control" name="runner_point"> 
                           @error('runner_point') {{$message}} @enderror 
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                 <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('teamtournamentschedule.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

