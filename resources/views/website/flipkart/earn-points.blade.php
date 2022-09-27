@if(Auth::guard('gamer')->check())
    @php $user = Auth::guard('gamer')->user(); @endphp
@endif
@php
    if (Auth::guard('gamer')->user()) {
        $reg_referrer_count = DB::table('gamer_points')->where('gamer_id', '=', $user->id)->where('trigger_event', '=', 'registration_referrer')->count();
    } else {
        $reg_referrer_count = 'not_logged_in';
    }
    
@endphp
@extends("website.layouts.flipkart.flipkart-master")
@section("content")
    <style type="text/css">
        .videoWrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
        }

        .videoWrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>


    <section class="testimonial_bg pt-5 pb-5">

        <section class="bluedark_bg pt-5 pb-5">
            <div class="title__area text-center">
            </div>
        </section>


        <div class="container">

            <div class="title__area text-center">
                <div class="section__title text-white-fk">Earn Points</div>
                <h4 class="text-white-fk">Each point is equivalent to Flipkart gift coupon of value Rs. 1
                    <br>e.g. 500 points equivalent to Rs. 500 gift voucher
                </h4>
                <h7 class="text-white-fk">t&c apply</h7>
            </div>

            <div class="clearfix"></div>

            <div class="container-fluid mt-5">

                <div class="row" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.register')}}"><img src="{!!asset('flipkart/images/earn-points/1a.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Register to earn 500 points.</h4>

                        <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.register')}}" role="button">Register Now</a>
                    </div>
                </div>

                {{-- <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.register')}}"><img src="{!!asset('flipkart/images/earn-points/2a.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Use referral code during registration to earn 50 points.</h4>

                        <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.register')}}" role="button">Register Now</a>
                    </div>
                </div> --}}

                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.coming.soon')}}"><img src="{!!asset('flipkart/images/earn-points/3a.jpg')!!}" class="img-fluid"></a>
                    </div>
                    @if( $reg_referrer_count == 10 )
                        <div class="col-sm-8 card-body d-flex flex-column">
                            <h4 class="text-white-fk">Sorry your referrer code is already used 10 time !</h4>

                            <div class="btn btn-lg btn-block btn-secondary mt-auto" disabled style="cursor: not-allowed;">Refer a Friend</div>
                        </div>
                    @elseif( $reg_referrer_count == 'not_logged_in' )
                        {{-- <div class="col-sm-8 card-body d-flex flex-column">
                            <h4 class="text-white-fk">Refer your friends to earn 50 points, when they register and verify their account. !</h4>

                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.register')}}" role="button">Register Now</a>
                        </div> --}}
                        <div class="col-sm-8 card-body d-flex flex-column">
                            <h4 class="text-white-fk">Refer your friends to earn 50 points, when they register and verify their account.</h4>

                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.refer.a.friend')}}" role="button">Refer a Friend</a>
                        </div>
                    @else
                        <div class="col-sm-8 card-body d-flex flex-column">
                            <h4 class="text-white-fk">Refer your friends to earn 50 points, when they register and verify their account.</h4>

                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.refer.a.friend')}}" role="button">Refer a Friend</a>
                        </div> 
                    @endif
                </div>

                {{-- <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.upcoming-tournaments')}}"><img src="{!!asset('flipkart/images/earn-points/4a.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Participate in tournaments to earn 250 points.</h4>

                        <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.upcoming-tournaments')}}" role="button">Join Tournament</a>
                    </div>
                </div> --}}

                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.coming.soon')}}"><img src="{!!asset('flipkart/images/earn-points/6A.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Be involved in Social Media and earn 100 points.</h4>
                    @if(Auth::guard('gamer')->user())
                        <a class="btn btn-lg btn-block btn-info mt-auto" href="{{route('flipkart.spread.the.word')}}" role="button">Spread the Word</a>
                    @else
                    <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.register')}}" role="button">Register Now</a>
                    @endif
                    </div>
                </div>

                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.upcoming-tournaments')}}"><img src="{!!asset('flipkart/images/earn-points/5a.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Win Tournament and get goodies worth upto Rs 1 Lakh !!!</h4>

                        <a class="btn btn-lg btn-block btn-danger mt-auto" href="{{route('flipkart.upcoming-tournaments')}}" role="button">Win Tournament</a>
                    </div>
                </div>

            </div>
        </div>


    </section>





@endsection
