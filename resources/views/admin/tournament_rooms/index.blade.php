@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Tournament Rooms List </h5>
         <div class="header-elements">

         </div>
      </div>
      <div class="table-responsive">
         <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th>Tournament</th>
                  <th>Game Room Id</th>
                  <th>Room Code</th>
                  <th>status Money</th>
                  @can('Tournaments-Edit')
                  <th>Status</th>
                  @endcan
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($tournamentrooms)
               @foreach($tournamentrooms as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->tournaments}}</td>
                  <td>{{$data->game_room_id}}</td>
                  <td> {{$data->room_code}}</td>
                  <td> {{$data->status}}</td>
                  @can('Tournaments-Edit')
                  <td> 
                     @if($data->is_active == 0)
                     <a class="badge bg-danger" href="{{ URL::to('tournamentrooms/change-status/'.$data->id) }}">Inactive</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('tournamentrooms/change-status/'.$data->id) }}">Active</a>
                  </td>
                  @endif @endcan
                  <td>
                     <div class="list-icons">
                        @can('Tournaments-Read')
                        <a class="badge bg-success" href="{{route('tournamentrooms.show',$data->id)}}">Show</a>
                        @endcan @can('Tournaments-Edit')
                        <a class="badge bg-primary"href="{{ route('tournamentrooms.edit',$data->id) }}">Edit</a>
                        @endcan
                        @can('Tournaments-Delete')                                               
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
                                 {!! Form::open(['method' => 'delete','route' => ['tournamentrooms.destroy', $data->id],'style'=>'display:inline']) !!}
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

