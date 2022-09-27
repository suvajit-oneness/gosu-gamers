@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
   <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
   <h2 class="text-center">Tournament Rooms List </h2>
</section>

<section class="sponser_bg pt-5 pb-5">
   <div class="clearfix"></div>
   <div class="container">
      <div class="content">

         <div class="card">
            <div class="card-header">
               <a href="{{route('gamer.gamerpositions',$id)}}" class="btn btn text-light mx-2 float-right"
                  style="background-color: #0a0e27; border-color: rgb(10 13 36);"> Gamer Positions</a>
               <a class="btn btn-danger float-right mx-2" href="{{ route('gamer.tournaments.show',$user->id) }}"><i
                     class="icon-exit ml-2"></i> Back</a>
               <br>
               <br>
               <br>
               <div class="header-elements float-right">
                  <a class="btn text-light mx-2 float-right text-uppercase"
                     style="background-color: #0a0e27; border-color: rgb(10 13 36);"
                     href="{{route('gamer.teamstournament.create')}}"><i class="fas fa-plus mr-1"></i>Teams
                     Tournament</a>
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal"
                     class="btn text-light mx-2 float-right text-uppercase"
                     style="background-color: #0a0e27; border-color: rgb(10 13 36);">Set Room Password</a>
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#myModalroom"
                     class="btn text-light mx-2 float-right text-uppercase"
                     style="background-color: #0a0e27; border-color: rgb(10 13 36);">Email Room</a>
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#myModals1"
                     class="btn text-light mx-2 float-right text-uppercase"
                     style="background-color: #0a0e27; border-color: rgb(10 13 36);">Email To All </a>
                  <a href="{{ route('gamer.teamassignroomsingle',$id) }}"
                     class="btn text-light mx-2 float-right text-uppercase"
                     style="background-color: #0a0e27; border-color: rgb(10 13 36);">Assign Room</a>
                  <button class="btn text-light mx-2 float-right text-uppercase"
                     style="background-color: #0a0e27; border-color: rgb(10 13 36);" id="sendEmail">Send Email</button>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="" class="table table-striped">
                     <thead>
                        <tr class="bg-teal-400">
                           <th><input type="checkbox" id="checkAll">Select All </th>
                           <th width="3%">SL No</th>
                           <th>Team Name</th>
                           <th>Captain Name</th>
                           <th>Captain Email</th>
                           <th>Tournament</th>
                           <th>Room Code</th>
                           <th>Ingame Name</th>
                           <th>Ingame Id</th>
                           <th>Show Team Member</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $slno = 1; ?>
                        @if($teamstournament)
                        @foreach($teamstournament as $data)
                        <tr>
                           <td><input type="checkbox" class="chkService" id="customCheck{{$data->id}}" value="{{$data->email}}"></td>
                           <td>{{$slno}}</td>
                           <td> {{$data->teams}}</td>
                           <td> {{$data->fname}} {{$data->lname}}</td>
                           <td> {{$data->email}}</td>
                           <td>{{$data->tournaments}}</td>
                           <td> {{$data->room_code}}</td>
                           <td>{{$data->in_game_name}}</td>
                           <td>{{$data->in_game_id}}</td>
                           <td>
                              <div class="list-icons">
                                 <a href="#" data-toggle="modal" data-target="#myModal{{$data->id}}"
                                    class="btn btn-success">Show Team Member</a>
                                    <!-- Modal -->
                                 @php
                                 $team_id = $data->team_id;
                                 // dd($team_id);
                                 $teamsplayers = DB::table('team_players')->where('team_id',$team_id)->where('is_deleted',0)->get();
                                 @endphp
                                 <div id="myModal{{$data->id}}" class="modal fade show_team_member" role="dialog">
                                    <div class="modal-dialog">
                                       <!-- Modal content-->
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h4 class="modal-title">Team Memeber</h4>
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="table-responsive Team-table">
                                                <table class="table table-striped datatable-responsive">
                                                   <thead>
                                                      <tr>
                                                         <th>Name</th>
                                                         <th>email</th>
                                                         <th>Mobile</th>
                                                         <th>In Game Name</th>
                                                         <th>In Game ID</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>

                                                      @foreach($data->TeamPlayers as $teamsplayer)

                                                      <tr>
                                                         <td> {{$teamsplayer->name}}</td>
                                                         <td> {{$teamsplayer->email}}</td>
                                                         <td> {{$teamsplayer->phone_no}}</td>
                                                         <td> {{$teamsplayer->ingame_name}}</td>
                                                         <td> {{$teamsplayer->ingame_id}}</td>
                                                      </tr>
                                                   </tbody>
                                                   @endforeach
                                                </table>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-dark"
                                                data-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                           </td>
                        </tr>
                        <?php $slno = $slno + 1; ?>
                        @endforeach
                        @endif
                     </tbody>
                  </table>
                  <div>
                  </div>
               </div>
            </div>
         </div>

</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Set Room Password</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{route('gamer.teamroomSchedule')}}" method="post" accept-charset="utf-8"
               onSubmit="return gamerSelectLimit();">
               <input type="hidden" name="tournament_id" value="{{$id}}">
               @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Select Room : <em>*</em></label> <br>
                        <select name="room_code" id="room_code" class="form-control" autocomplete="off"
                           required="required">
                           <option value="">Select Room</option>
                           @foreach($tournamentrooms as $room)
                           <option value="{{$room->room_code}}">{{$room->room_code}}</option>
                           @endforeach
                        </select>

                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Password : <em>*</em></label> <br>
                        <input type="text" name="password" id="password" class="form-control" autocomplete="off"
                           required="required">
                        @if($errors->has('password'))
                        <span class="roy-vali-error"><small>{{$errors->first('password')}}</small></span>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Start date : <em>*</em></label> <br>
                        <input type="date" name="start_date" id="start_date" class="form-control" autocomplete="off"
                           required="required">

                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>End date : <em>*</em></label> <br>
                        <input type="date" name="end_date" id="end_date" class="form-control" autocomplete="off"
                           required="required">

                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Start time : <em>*</em></label> <br>
                        <input type="time" name="start_time" id="start_time" class="form-control" autocomplete="off"
                           required="required">

                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>End time : <em>*</em></label> <br>
                        <input type="time" name="end_time" id="end_time" class="form-control" autocomplete="off"
                           required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <button type="submit" class="btn bg-primary text-light"><i class="fas fa-save mr-1"></i>
                           Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div id="myModalroom" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Room Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{route('gamer.teamroomSchedulemail')}}" method="post" accept-charset="utf-8"
               onSubmit="return gamerSelectLimit();">
               @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Select Room To Send Mail: <em>*</em></label> <br>
                        <select name="room_code" id="room_code" class="form-control" autocomplete="off"
                           required="required">
                           <option value="">Select Room</option>
                           @foreach($tournamentrooms as $room)
                           <option value="{{$room->room_code}}">{{$room->room_code}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Subject : <em>*</em></label> <br>
                        <input type="text" name="subject" id="subject" class="form-control" autocomplete="off"
                           required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Message : <em>*</em></label> <br>
                        <textarea class="form-control" name="messagemail" id="messagemail" autocomplete="off"
                           required="required"></textarea>
                     </div>
                  </div>
               </div>
               <script type="text/javascript">
                  CKEDITOR.replace('messagemail');
               </script>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary text-light"><i class="fas fa-save mr-1"></i>
                           Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div id="myModals1" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Send Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{route('gamer.teamsendMail')}}" method="post" accept-charset="utf-8"
               onSubmit="return gamerSelectLimit();">
               <input type="hidden" name="tournament_id" value="{{$id}}">
               @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Subject : <em>*</em></label> <br>
                        <input type="text" name="subject" id="subject" class="form-control" autocomplete="off"
                           required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Message : <em>*</em></label> <br>
                        <textarea class="form-control" name="message" id="message" autocomplete="off"
                           required="required"></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div id="myModals2" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Send Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{route('gamer.sendallgameremail')}}" method="post" accept-charset="utf-8"
               onSubmit="return gamerSelectLimit();">

               @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>To : <em>*</em></label> <br>
                        <textarea class="form-control" name="to" id="to" autocomplete="off"
                           required="required"></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Subject : <em>*</em></label> <br>
                        <input type="text" name="subject" id="subject" class="form-control" autocomplete="off"
                           required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Message : <em>*</em></label> <br>
                        <textarea class="form-control" name="message1" id="message1" autocomplete="off"
                           required="required"></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>


@endsection