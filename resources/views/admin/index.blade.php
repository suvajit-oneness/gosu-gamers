@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
       <form action="">
      <div class="card-header header-elements-inline">
         
            <div class="col-md-12">
               <div class="col-md-6">
                  <input type="text" class="form-control" name="tournament" placeholder="Search">
               </div>
               <div class="col-md-3">
                  <button type="submit" class="btn bg-teal-400"> Search</button>
               </div>
            </div>
        
      </div>
      </form>
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Tournaments  List </h5>
         <div class="header-elements">
            @can('Tournaments-Create')
            <div class="list-icons">
               <a href="{{route('tournaments.create')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Add Tournaments </a>
            </div>
            @endcan
         </div>
      </div>
      <div class="table-responsive">
        <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th>Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Prize Money</th>
                  @can('Tournaments-Edit')
                  <th>Status</th>
                  @endcan
                  <th width="10%">Action</th>
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($tournaments)
               @foreach($tournaments as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->name}}</td>
                  <td>{{$data->start_date}}</td>
                  <td> {{$data->end_date}}</td>
                  <td> {{$data->prize_money}}</td>
                  @can('Tournaments-Edit')
                  <td> 
                  <div class="list-icons"> 
                     @if($data->is_active == 0)
                     <a class="badge bg-danger" href="{{ URL::to('tournaments/change-status/'.$data->id) }}">Inactive</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('tournaments/change-status/'.$data->id) }}">Active</a>
                     @endif
                     <a href="#" data-toggle="modal" data-target="#confirm-delete{{$data->id}}" class="badge bg-danger">Delete</a>
                     @if($data->stop_joining == 1)
                     <a class="badge bg-danger" href="{{ URL::to('tournaments/stop-joining/'.$data->id) }}">Joining Stopped</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('tournaments/stop-joining/'.$data->id) }}">Can Join</a>
                     @endif                     
                  </div>   
                  </td>
                   @endcan
                  <td>
                     <div class="list-icons">
                        @can('Tournaments-Edit')
                        <a class="badge bg-primary"href="{{ route('tournaments.edit',$data->id) }}">Edit</a>
                        @endcan
                        @can('Tournaments-Read')
                        <a class="badge bg-success" href="{{route('view_tournament_rooms',$data->id)}}">Room</a>
                        @endcan
                        @can('Tournaments-Read')
                        <a class="badge bg-success" href="{{route('gamerteam',$data->id)}}">Gamer</a>
                          @endcan
                         <a class="badge bg-success" href="{{ URL::to('gamertournamentschedule-details/'.$data->id) }}">Full Schedule</a>  
                         @can('Tournaments-Read')
                        <a class="badge bg-primary" href="{{route('tournament_user_list',$data->id)}}">Make Schedule</a>
                          @endcan
                           @can('Tournaments-Delete')                        
                     </div>
                     <div class="modal fade" id="confirm-delete{{$data->id}}" role="dialog" style="text-align: left;">
                        <div class="modal-dialog" style="width: 35%;">
                           <!-- Modal content-->
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h4 class="modal-title">Confirm Delete</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                 <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                                 <p>Do you want to proceed?</p>
                              </div>
                              <div class="modal-footer">
                                 {!! Form::open(['method' => 'delete','route' => ['tournaments.destroy', $data->id],'style'=>'display:inline']) !!}
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
         <div>
         </div>
      </div>
   </div>
</div>
@endsection

