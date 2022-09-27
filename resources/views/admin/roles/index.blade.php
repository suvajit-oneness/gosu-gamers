@extends("admin.layouts.master")
@section("content")
<div class="content">
<div class="card">
<div class="card-header header-elements-inline">
<h3 class="card-title"><i class="fa fa-key"></i> Available roles</h3>
<div class="header-elements">
<div class="list-icons">
  <a class="btn bg-teal-400" href="{{ route('permissions.index') }}"><i class="icon-key"></i> Permissions</a>
  <a class="btn bg-teal-400" href="{{URL('role/create')}}"><i class="icon-users "></i>Create Role</a>
</div>
</div>
</div>
<div class="table-responsive">
<table id="example1" class="table table-striped datatable-responsive">
   <thead>
      <tr class="bg-teal-400">
         <th>Role</th>
         <th>Permissions</th>
         <th width="10%">Action</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($roles as $role)
      <tr>
         <td>{{ $role->name }}</td>
         <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
         <td>
            <div class="list-icons">
               <a href="{{ URL::to('role/'.$role->id.'/edit') }}" class="badge bg-primary">Edit</a>
               <a href="#" data-toggle="modal" data-target="#confirm-delete{{$role->id}}" class="badge bg-danger">Delete</a>
            </div>
            <div class="modal fade" id="confirm-delete{{$role->id}}" role="dialog" style="text-align: left;">
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
                     {!! Form::open(['method' => 'DELETE', 'route' => ['role.destroy', $role->id] ]) !!}
                     {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-fill btn-sm']) !!}
                     <button type="button" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Cancel</button>
                     {!! Form::close() !!}
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
</div>
<!-- </div>
   </div>
   
   <div class="content">
   <div class="card">
   <h3 style="float:right;margin-left:20px; margin-top:10px " ><i class="fa fa-key"></i> Assign Role</h3>
   <div class="card-body">
    <form method="post" action="{{route('role.assign')}}" enctype="multipart/form-data">
      @csrf
      <tr>
       <td width="15%" class="text-right border-right text-uppercase">Role *</td>
         <td>
           <select class='form-control' id='roles' name='role'>
            @if($role)
             @foreach($roles as $index => $roles)
              <option value="{{ $roles->name }}">{{ ucfirst($roles->name) }}</option>
             @endforeach
            @endif
          </select>
       </td>
       <br>
     </tr>
       <tr>
       <td width="15%" class="text-right border-right text-uppercase">User Name *</td>
         <td>
           <select class='form-control' id='user' name='user_id'>
            @if($user)
             @foreach($user as $index => $user)
              <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
             @endforeach
            @endif
          </select>
       </td>
     </tr>
     <div  class="text-left">
       <div class="header-elements">
         <button style= "margin-top:10px" type="submit" class="btn bg-teal-400"></i> Save</button>
   
     </div>
    </div>           
   </form>
   </div>-->
</div>
</div> 
@endsection

