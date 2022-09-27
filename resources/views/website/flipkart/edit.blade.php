@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); @endphp
@endif

        <!doctype html>
<html lang="en">
@include("website.layouts.flipkart.flipkart-header")
<body>
{{--include styles--}}
@include("website.layouts.flipkart.flipkart-sub-header")

<section class="banner__area inner">
    <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">
    <h2 class="text-center">Profile</h2>
    <div class="news__ticker" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-delay="500"
         data-aos-duration="1000">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                @foreach($upcoming_tournaments as $upcoming_tournament)
                    <li class="carouselTicker__item">
                        <a href="" class="ticker_cat bg-primary">{{$upcoming_tournament->game_name}}</a><a
                                href="#">{{$upcoming_tournament->name}} is starting
                            from {{date("M.d.Y",strtotime($upcoming_tournament->start_date))}}. Register today to
                            participate.</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<form action="{{route('flipkart.profile-edit.submit')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
    @csrf
    <section class="sponser_bg pt-5 pb-5">
        <div class="container">

            @if ($errors->any())
                <div class="row">
                    <div class="col-sm-12 alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="profile_picture_wrap mb-4">
                        <div class="profile_picture"><img class="img-fluid" src="{{URL::asset($user->image)}}"></div>
                        <div class="uploadbtn"><span><img src="{!!asset('letsgamenow/images/camera.svg')!!}"></span>
                            <input type="file" name="image"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile_upadate_fields">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="upadate_field mb-4">
                                    <label>First Name*</label>
                                    <input class="form-control" value="{{$user->fname}}" type="text" name="fname">
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="upadate_field mb-4">
                                    <label>First Name*</label>
                                    <input class="form-control" type="text" value="{{$user->lname}}" name="lname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="upadate_field mb-4">
                                    <label>Username*</label>
                                    <input class="form-control" value="{{$user->username}}" type="text" name="username" style="background: rgba(255,255,255,0.2);" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="upadate_field mb-4">
                                    <label>Email*</label>
                                    <input class="form-control" type="text" value="{{$user->email}}" name="email">
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="upadate_field update_mobile_number position-relative mb-4">
                                    <label>Mobile Number*</label>
                                    <span>+91</span>
                                    <input class="form-control" type="text" value="{{$user->mobile}}" name="mobile">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="upadate_field mb-4">
                                    <label>Password (leave empty to keep the existing one)</label>
                                    <input class="form-control" type="password" value="" name="password">
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="upadate_field mb-4">
                                    <label>Retype Password (leave empty to keep the existing one)</label>
                                    <input class="form-control" type="password" value="" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="upadate_field position-relative mb-4">
                                    <label>Gender*</label>
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option value="Male"@if ($user->gender == "Male") selected @endif>Male</option>
                                        <option value="Female"@if ($user->gender == "Female") selected @endif>Female</option>
                                        <option value="Other"@if ($user->gender == "Other") selected @endif>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="upadate_field position-relative mb-4">
                                    <label>Date of Birth*</label>
                                    <input class="form-control" type="text" value="{{$user->dob}}" name="dob" onfocus="(this.type='date')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="upadate_field position-relative">
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
<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-4" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-7">
                        <h3>CONTACT US</h3>
                        <ul class="contact__list">
                            <li>5001 BEACH ROAD #08-11 GOLDEN MILE COMPLEX, Singapore 199588</li>
                            <li><a href="mailto:info@letsgamenow.com">info@letsgamenow.com</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-5"><img src="{!!asset('letsgamenow/images/logo.png')!!}" class="img-fluid"></div>
                </div>
            </div>
            <div class="col-sm-4" data-aos="fade-down" data-aos-easing="ease-in-back" data-aos-duration="1500">
                <h3>Links</h3>
                <ul class="footer__links">
                    <li><a href="{{route('home.about')}}">About</a></li>
                    <li><a href="{{route('home.contact')}}">Contact Us</a></li>
                    <li><a href="{{route('home.faqs')}}">FAQs</a></li>
                    <li><a href="{{route('home.terms.conditions')}}">Terms & Conditions</a></li>
                    <li><a href="{{route('home.privacy.policy')}}">Privacy Policy</a></li>
                    <li><a href="{{route('home.refund.cancel')}}">Refund & Cancellation</a></li>
                </ul>
            </div>
            <div class="col-sm-4" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="2000">
                <h3>NEWSLETTER</h3>
                <p>Subsrcibe us now to get the latest news and updates</p>
                <div class="newsletter__form">
                    <form>
                        <div class="form-group clearfix"><input type="email" name="email" value=""
                                                                placeholder="Email address" required="">
                            <button type="submit" class="newsletter__btn"><span class="fas fa-envelope"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom__footer mt-5 pt-5 pb-5">
        <p class="text-center">© 2019 Copyright: Letsgamenow.com</p>
    </div>
</footer>
<div class="left_bar_social">
    <ul class="mb-0 social_list">
        <li class="facebook"><a target="_blanck" href="https://www.facebook.com/lgnindia"><i
                        class="fab fa-facebook-f"></i></a></li>
        <li class="twitter"><a target="_blanck" href="https://twitter.com/lets_game_now"><i class="fab fa-twitter"></i></a>
        </li>
        <li class="instagram"><a target="_blanck" href="https://instagram.com/lets_game_now"><i
                        class="fab fa-instagram"></i></a></li>
        <li class="linkedin"><a target="_blanck" href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
        <li class="youtube"><a target="_blanck" href="https://youtube.com"><i class="fab fa-youtube"></i></a></li>
    </ul>
    <!-- <a class="sharethis_btn" href="#"><i class="ti-sharethis"></i></a> -->
</div>
@include("website.layouts.scripts")

</body>
</html>
