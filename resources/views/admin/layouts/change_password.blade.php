@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('dashboard') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('save_pwd')}}" enctype="multipart/form-data">
            @csrf
			<div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Current Password : <em>*</em></label>
                <input type="text" name="current_password" class="form-control" placeholder="Enter Current Password">
              </div>
              <div class="form-group">
                <label>New Password : <em>*</em></label>
                <input type="text" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password">
              </div>
              <div class="form-group">
                <label>Confirm Password : <em>*</em></label>
                <input type="text" name="re_password" class="form-control" placeholder="Enter Confirm Password">
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn bg-teal-400" value="Change Password">
          </div>

          </div>
	 </div>
</div>
@endsection