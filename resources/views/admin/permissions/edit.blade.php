@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:50px; margin-top:25px "  href="{{ route('permissions.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <h3 style="float:right;margin-left:20px; margin-top:10px " ><i class="fa fa-key"></i> Add Permissions</h3>
      <br>
      <div class="card-body">
         {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}
         <div class="form-group">
            {{ Form::label('name', 'Permission Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
         </div>
         <br>
         <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Edit</button>
         {{ Form::close() }}
      </div>
   </div>
</div>
@endsection

