@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">News Details</h5>
         <div class="header-elements">
            @can('News-Create')
            <div class="list-icons">
               <a href="{{route('news.create')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Add News</a>
            </div>
            @endcan
         </div>
      </div>
      <div class="table-responsive">
         <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  {{-- <th width="3%">ID</th> --}}
                  <th>Title</th>
                  <th>Content</th>
                  <th>Image</th>
                  <th>Partner</th>
                  <th>Post Date</th>
                  <th>Uploaded By</th>
                  <th>Total View</th>
                  @can('News-Edit')
                  <th>Status</th>
                  @endcan
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @if($news)
               @foreach($news as $data)
               <tr>
                  {{-- <td>{{ $key+1 }}</td> --}}
                  <td>{{$data->title}}</td>
                  <td>{{substr($data->content,3,150)}}...</td>
                  <td><img src="{{URL::asset($data->image)}}" style="width:50px; height:50px; float:left; 
                     border-radius:50%; margin-right:25px;"></td>
                  <td>{{$data->partner}}</td>
                  <td>{{$data->post_date}}</td>
                  <td>{{$data->uploaded_by}}</td>
                  <td>{{$data->view_count ? $data->view_count : 'No'}}</td>
                  @can('News-Edit') 
                  <td> 
                     @if($data->is_active == 0)
                     <a class="badge bg-danger" href="{{ URL::to('news/change-status/'.$data->id) }}">Inactive</a>
                     @else
                     <a class="badge bg-success" href="{{ URL::to('news/change-status/'.$data->id) }}">Active</a>
                  </td>
                  @endif  @endcan
                  <td>
                     <div class="list-icons">
                        @can('News-Read')
                        <a class="badge bg-success" href="{{route('news.show',$data->id)}}">Show</a>
                        @endcan
                        @can('News-Edit')
                        <a class="badge bg-primary"href="{{ route('news.edit',$data->id) }}">Edit</i></a> 
                        @endcan
                        @can('News-Delete')                                           
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
                                 {!! Form::open(['method' => 'delete','route' => ['news.destroy', $data->id],'style'=>'display:inline']) !!}
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

