@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Gamers Tournaments  List </h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>
   <div class="container">
      <div class="content">

         <div class="card">
            <div class="card-header">
            <a class="btn btn-danger float-right" href="{{route('gamer.gamerpositions',$id)}}"> Gamer Positions</a>

            <div class="header-elements">
            @can('Tournaments-Create')
            <div class="list-icons">
               <a href="{{route('gamer.gamerstournaments.create')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Add Gamers Tournaments</a>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn bg-teal-400 text-uppercase">Set Room Password</a>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#myModalroom" class="btn bg-teal-400 text-uppercase">Email Room</a>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal1" class="btn bg-teal-400 text-uppercase">Send Email To All</a>
               <a href="{{ route('gamer.assignroomsingle',$id) }}" class="btn bg-teal-400 text-uppercase assign">Assign Room</a>
               <button class="btn bg-teal-400 text-uppercase" id="sendEmail">Send Email</button>
            </div>
            @endcan
         </div>
            </div>
            <div class="card-body">

               <div class="table-responsive">
                  <table id="example1" class="table table-striped datatable-responsive">
                     <thead>
                        <tr class="bg-teal-400">
                           <th><input type="checkbox" id="checkAll">Select All</th>
                           <th>SL No</th>
                           <th>Tournament</th>
                           <th>Room Code</th>
                           <th>Gamer Name</th>
                           <th>Gamer Email</th>
                           <th>Ingame Name</th>
                           <th>Ingame Id</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $slno = 1; ?>
                        @if($gamerstournaments)
                        @foreach($gamerstournaments as $data)
                        <tr>
                           <td><input type="checkbox" class="chkService" id="customCheck{{$data->id}}" value="{{$data->email}}"></td>
                           <td>{{$slno}}</td>
                           <td> {{$data->tournaments}}</td>
                           <td>{{$data->room_code}}</td>
                           <td>{{$data->fname}} {{$data->lname}}</td>
                           <td>{{$data->email}}</td>
                           <td>{{$data->in_game_name}}</td>
                           <td>{{$data->in_game_id}}</td>
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
      </div>
   </div>

</section>

<script type="text/javascript">
   CKEDITOR.replace('message');
    CKEDITOR.replace ('message1');
   
</script>
<script type="text/javascript">
   var emailArr = [];
   var allEmails = '';
   $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
   });
   
   $('#sendEmail').click(function() {
      emailArr = [];
      allEmails = '';
      total = 0;
      var $boxes = $('input[type="checkbox"]:checked');
   
      $boxes.each(function(){
          // Do stuff here with this
          emailArr.push({"email":$(this).val()});
          if(allEmails==''){
            if($(this).val()!='on' && $(this).val()!=''){
               allEmails += $(this).val();
            }
          }else{
            if($(this).val()!='on' && $(this).val()!=''){
               allEmails += ','+$(this).val();
            }
          }
      });
   
      $('#to').val(allEmails);
      console.log("arr>"+JSON.stringify(emailArr));
      $('#myModals1').modal('show');
   })
</script>
<script type="text/javascript">
   $(function () {
   
        $(document).on("click", ".assign", function () {     
             location.reload();
      });
   });     
</script> 


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
            <form action="{{route('gamer.roomSchedule')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
               @csrf 
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Select Room : <em>*</em></label> <br>
                        <select name="room_code" id="room_code" class="form-control" autocomplete="off" required="required">
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
                        <input type="text" name="password" id="password" class="form-control" autocomplete="off" required="required">
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
                        <input type="date" name="start_date" id="start_date" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>End date : <em>*</em></label> <br>
                        <input type="date" name="end_date" id="end_date" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Start time : <em>*</em></label> <br>
                        <input type="time" name="start_time" id="start_time" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>End time : <em>*</em></label> <br>
                        <input type="time" name="end_time" id="end_time" class="form-control" autocomplete="off" required="required">
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
<div id="myModalroom" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
         <h4 class="modal-title">Room Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>            
         </div>
         <div class="modal-body">
            <form action="{{route('gamer.roomSchedulemail')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
               @csrf 
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Select Room To Send Mail: <em>*</em></label> <br>
                        <select name="room_code" id="room_code" class="form-control" autocomplete="off" required="required">
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
                        <input type="text" name="subject" id="subject" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Message : <em>*</em></label> <br>
                        <textarea class="form-control"  name="messagemail" id="messagemail" autocomplete="off" required="required"></textarea>                    
                     </div>
                  </div>
               </div>
               <script type="text/javascript">
                  CKEDITOR.replace('messagemail');
               </script>
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
<div id="myModal1" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Send Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>          
         </div>
         <div class="modal-body">
            <form action="{{route('gamer.sendMail')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
               @csrf 
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Subject : <em>*</em></label> <br>
                        <input type="text" name="subject" id="subject" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Message : <em>*</em></label> <br>
                        <textarea class="form-control"  name="message" id="message" autocomplete="off" required="required"></textarea>                    
                     </div>
                  </div>
               </div>
               <script type="text/javascript">
                  CKEDITOR.replace('message');
               </script> 
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
<div id="myModals1" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Send Email</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{route('gamer.sendallgameremail')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
               @csrf 
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>To : <em>*</em></label> <br>
                        <textarea class="form-control" name="to" id="to" autocomplete="off" required="required"></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Subject : <em>*</em></label> <br>
                        <input type="text" name="subject" id="subject" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Message : <em>*</em></label> <br>
                        <textarea class="form-control" name="message1" id="message1" autocomplete="off" required="required"></textarea>
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


