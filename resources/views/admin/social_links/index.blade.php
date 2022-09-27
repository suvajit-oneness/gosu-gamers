@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Social Links Details</h5>
         <div class="header-elements">

            <div class="list-icons">
               <a href="{{route('sociallinks.create')}}" class="btn bg-teal-400 list-icons-item text-primary-600 text-uppercase"><i class="fas fa-plus mr-1"></i>
               Add Social Links </a>
            </div>

         </div>
      </div>
      <div class="table-responsive">
           <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th>Images</th>
                  <th>Link</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($sociallinks)
               @foreach($sociallinks as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td><img src="{{URL::asset($data->image)}}" style="width:50px; height:50px; float:left; 
                     border-radius:50%; margin-right:25px;"></td>
                  <td>{{strip_tags(html_entity_decode($data->link))}}</td>
                  <td>{{strip_tags(html_entity_decode($data->name))}}</td>
                
                  <td> 
                     @if($data->is_active == 0)
                     <a class="badge bg-danger" href="{{ URL::to('sociallinks/change-status/'.$data->id) }}">Inactive</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('sociallinks/change-status/'.$data->id) }}">Active</a>
                  </td>
                  @endif  
                  <td>
                     <div class="list-icons">

                        <a class="badge bg-success" href="{{route('sociallinks.show',$data->id)}}">Show</a>

                        <a class="badge bg-primary"href="{{ route('sociallinks.edit',$data->id) }}">Edit</a>
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
                                 {!! Form::open(['method' => 'delete','route' => ['sociallinks.destroy', $data->id],'style'=>'display:inline']) !!}
                                 {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-fill btn-sm']) !!}
                                 <button type="button" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Cancel</button>
                                 {!! Form::close() !!}
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
@endsection