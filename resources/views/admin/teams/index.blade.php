@extends("admin.layouts.master")
@section("content")
<?php
$page = (isset($_GET['page']) && $_GET['page']!='')?$_GET['page']:0; 
?>
<div class="content">
   <div class="card">
      <form action="">
      <div class="card-header header-elements-inline">
         
            <div class="col-md-12">
               <div class="col-md-6">
                  <input type="text" class="form-control" name="team_name" placeholder="Search Team Name Here">
               </div>
               <div class="col-md-3">
                  <button type="submit" class="btn bg-teal-400"> Search</button>
               </div>
            </div>
        
      </div>
      </form>
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Team Details</h5>
         <div class="header-elements">
            @can('Gamer-Create')
            <div class="list-icons">
               <input type="checkbox" id="checkAll">Check All Gamers
               <button class="btn bg-teal-400 text-uppercase" id="sendEmail"><i class="fas fa-plus mr-1"></i>Send Email</button>
               <a href="{{route('teams.create')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Add Team </a>
            </div>
            @endcan
         </div>
      </div>
      <div class="table-responsive">
         <table  class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th>SL No</th>
                  <th>Team Name</th>
                  <th>Captain Name</th>
                  <th>Captain Email</th>
                  <th>Captain Mobile No</th>
                  <th>Creation Date</th>
                  @can('Gamer-Edit')
                  <th>Status</th>
                  @endcan
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               if($page!=0){
                   $slno = (($page-1)*100)+1;
               }else{
                   $slno = 1;
               }
               
               ?>
               @if($teams)
               @foreach($teams as $data)
               <tr>
                  <td><input type="checkbox" class="chkService" id="customCheck{{$data->id}}" value="{{$data->email}}"> {{$slno}}</td>
                  <td> {{$data->team_name}}</td>
                  <td> {{$data->fname}} {{$data->lname}}</td>
                  <!-- <td><img src="{{URL::asset($data->image)}}" style="width:50px; height:50px; float:left; 
                     border-radius:50%; margin-right:25px;"></td> -->
                  <td> {{$data->email}}</td>
                  <td> {{$data->mobile}}</td>
                  <td>{{date("d-M-Y h:i a",strtotime($data->created_at))}}</td>
                  @can('Gamer-Edit') 
                  <td> 
                     @if($data->is_active == 0)
                     <a class="badge bg-danger" href="{{ URL::to('teams/change-status/'.$data->id) }}">Inactive</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('teams/change-status/'.$data->id) }}">Active</a>
                  </td>
                  @endif  @endcan
                  <td>
                     <div class="list-icons">
                     	<a class="badge bg-primary" href="{{ URL::to('teams/edit/'.$data->id) }}"></i>Edit </a>
                        @can('Gamer-Read')
                        <a class="badge bg-success" href="{{route('teams.show',$data->id)}}">Show</a>
                        @endcan
                        <a class="badge bg-primary" href="{{route('addteamplayers',$data->id)}}"></i>Add Team Member </a>
                        <a href="#" data-toggle="modal" data-target="#myModal{{$data->id}}" class="badge bg-success">Show Team Member</a>
                        <!-- Modal -->
                    @php
                    $team_id = $data->id;
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
                                 <table  class="table table-striped datatable-responsive">
                                     <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>email</th>
                                       <th>Mobile</th>
                                       <th>In Game Name</th>
                                        <th>In Game Id</th>
                                    </tr>
                                    </thead>
                                    <tbody>                                     
                                     @foreach($teamsplayers as $teamsplayer)
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
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                        @can('Gamer-Delete')                                           
                        <a href="#" data-toggle="modal" data-target="#confirm-delete{{$data->id}}" class="badge bg-danger">Delete</a>
                     </div>
                     <div class="modal fade" id="confirm-delete{{$data->id}}" role="dialog" style="text-align: left;">
                        <div class="modal-dialog" style="width: 35%;">
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Confirm Delete</h4>
                              </div>
                              <div class="modal-body">
                                 <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                                 <p>Do you want to proceed?</p>
                              </div>
                              <div class="modal-footer">
                                 {!! Form::open(['method' => 'delete','route' => ['teams.destroy', $data->id],'style'=>'display:inline']) !!}
                                 {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-fill btn-sm']) !!}
                                 <button type="button" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Cancel</button>
                                 {!! Form::close() !!}
                              </div>
                           </div>
                        </div>
                     </div>
                     @endcan
                  </td>
               </tr>
               <?php $slno = $slno + 1; ?>    
               @endforeach
               @endif
            </tbody>
         </table>
         {{ $teams->links() }}
         <div>
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
            <form action="{{route('sendallgameremail')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
              
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
                      <textarea class="form-control" name="message" id="message" autocomplete="off" required="required"></textarea>
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

<script type="text/javascript">
  CKEDITOR.replace('message');
 
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
@endsection
