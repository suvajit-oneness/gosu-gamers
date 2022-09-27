@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:50px; margin-top:25px "  href="{{ route('role.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <h3 style="float:right;margin-left:20px; margin-top:10px " ><i class="fa fa-key"></i> Edit Role {{$role->name}} </h3>
      <br>
      <div class="card-body">
         {{ Form::model($role, array('route' => array('role.update', $role->id), 'method' => 'PUT')) }}
         <div class="form-group">
            {{ Form::label('name', 'Role Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
         </div>
         <h5><b>Assign Permissions</b></h5>
         @foreach ($permissions as $permission)
         {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
         {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
         @endforeach
         <br>
         <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Edit</button>
         {{ Form::close() }}    
      </div>
   </div>
</div>
@endsection

