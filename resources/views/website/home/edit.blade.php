@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); @endphp
@endif
@extends("website.layouts.master")
@section("content")

<section class="banner__area inner">
    <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->
    <h2 class="text-center">Profile</h2>
</section>
<form action="{{route('gamer.edit.save')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
    @csrf
    <section class="sponser_bg pt-5 pb-5">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-4">
                    <div class="profile_picture_wrap profile mb-5">
                        <div class="profile_picture"><img class="img-fluid" src="{{$user->image ? URL::asset($user->image) : asset('new-theme/images/user_logo.png')}}"></div>
                        <div class="uploadbtn"><span><img src="{!!asset('letsgamenow/images/camera.svg')!!}"></span>
                            <input type="file" name="image"></div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="profile_upadate_fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="upadate_field custom_layout mb-4"><label>First Name*</label> <input class="form-control" value="{{$user->fname}}" type="text" name="fname"> <input class="form-control" value="{{$user->id}}" type="hidden" name="id"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="upadate_field custom_layout mb-4"><label>Last Name*</label> <input class="form-control" type="text" value="{{$user->lname}}" name="lname"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="upadate_field custom_layout mb-4"><label>Email*</label> <input class="form-control" type="text" value="{{$user->email}}" name="email"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="upadate_field custom_layout update_mobile_number position-relative mb-4"><label>Mobile Number*</label> <input class="form-control" type="text" value="{{$user->mobile}}" name="mobile">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="upadate_field custom_layout position-relative mb-4"><label>Date of Birth*</label> <input class="form-control" type="text" value="{{$user->dob}}" name="dob"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="upadate_field custom_layout position-relative">
                                    <button type="submit" class="">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

@include("website.layouts.scripts")
@endsection
