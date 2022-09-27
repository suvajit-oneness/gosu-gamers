@if(Auth::guard('web')->check())
   @php $user =Auth::guard('web')->user(); @endphp
   @foreach ($user->roles->pluck('name') as $rolename)   
   @endforeach
@endif
@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('dashboard') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('saveprofile')}}" enctype="multipart/form-data">
            @csrf
           <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>My Role :</label>
                <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="{{$rolename}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name : <em>*</em></label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{Auth::guard('web')->user()->name }}">
              </div>
            </div>
          </div>
           <input type="hidden" name="id" class="form-control" value="{{Auth::guard('web')->user()->id }}">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email-id : <em>*</em></label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email-Id" value="{{ Auth::user()->email }}">
                @if($errors->has('email'))
                <span class="roy-vali-error"><small>{{$errors->first('email')}}</small></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Number : </label>
                <input type="text" name="contact_no" class="form-control onlyNumber" placeholder="Enter Contact Number" value="{{ Auth::user()->mobile }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Address :</label>
                <textarea name="address" class="form-control" placeholder="Enter Address...">{{ Auth::user()->address }}</textarea>
              </div>

            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>User Image :</label>
                    <input type="file" name="image" id="user_image">
                    <span class="roy-vali-error" id="ar-user_image-err"></span>
                  </div>
                </div>
                <div class="col-md-6" style="text-align: right;">
                  <div class="form-group">
                    @if(Auth::user()->image != '' && Auth::user()->image != null)
                      @php
                      $imageURL = Auth::user()->image;
                      @endphp
                      <img src="{{ $imageURL }}" id="user_image_preview" class="ar_img_preview" data="{{ $imageURL }}">
                    @else
                      <img src="{{ asset('public/images/user-avatar.png') }}" id="user_image_preview" class="ar_img_preview" 
                      data="{{ asset('public/images/user-avatar.png') }}">
                    @endif
                    <i class="fa fa-times base-red libtn" id="user_image_rm"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn bg-teal-400" value="Save Changes">
          </div>
         </form>
      </div>
   </div>
</div>

@endsection