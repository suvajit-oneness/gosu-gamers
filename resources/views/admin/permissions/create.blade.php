@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:50px; margin-top:25px "  href="{{ route('permissions.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <h3 style="float:right;margin-left:20px; margin-top:10px " ><i class="fa fa-key"></i> Add Permissions</h3>
      <br>
      <div class="card-body">
         {{ Form::open(array('url' => 'permissions')) }}
         <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
         </div>
         <br>
         @if(!$roles->isEmpty()) 
         <h4>Assign Permission to Roles</h4>
         @foreach ($roles as $role) 
         {{ Form::checkbox('roles[]',  $role->id ) }}
         {{ Form::label($role->name, ucfirst($role->name)) }}<br>
         @endforeach
         @endif
         <br>
          <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
         {{ Form::close() }}
      </div>
   </div>
</div>
@endsection

