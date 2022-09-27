@extends("admin.layouts.master")
@section("content")
<div class="content">
<div class="card">
<div class="card-header header-elements-inline">
<h3 class="card-title"><i class="fa fa-key"></i> Available Permissions</h3>
<div class="header-elements">
<div class="list-icons">
<a class="btn bg-teal-400"  href="{{ route('role.index') }}"><i class="icon-user"></i> Role</a>
<a class="btn bg-teal-400" href="{{URL('permissions/create')}}"><i class="icon-key"></i>Create Permissions</a>
</div>
</div>
</div>
   <div class="table-responsive">
      <table id="example1" class="table table-striped datatable-responsive">
         <thead>
            <tr class="bg-teal-400">
               <th>Permissions</th>
               <th width="10%">Operation</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($permissions as $permission)
            <tr>
               <td>{{ $permission->name }}</td>
               <td>
                  <div class="list-icons">
                     <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="badge bg-primary" style="margin-right: 3px;">Edit</a>
                     <a href="#" data-toggle="modal" data-target="#confirm-delete{{$permission->id}}" class="badge bg-danger">Delete</a>
                  </div>
                  <div class="modal fade" id="confirm-delete{{$permission->id}}" role="dialog" style="text-align: left;">
                     <div class="modal-dialog" style="width: 35%;">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Confirm Delete</h4>
                           </div>
                        </div>
                        <div class="modal-body">
                           <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                           <p>Do you want to proceed?</p>
                        </div>
                        <div class="modal-footer">
                           {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                           {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-fill btn-sm']) !!}
                           <button type="button" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Cancel</button>
                           {!! Form::close() !!}
                        </div>
                     </div>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
      </div>
   </div>
</div>
@endsection

