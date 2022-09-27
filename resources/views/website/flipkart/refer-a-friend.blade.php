@if(Auth::guard('gamer')->check())
    @php $user =Auth::guard('gamer')->user(); @endphp
@endif

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
                <div class="section__title">Refer A Friend</div>
            </div>

            <div class="clearfix"></div>

            <div class="container-fluid mt-5">
@php
    $reg_referrer_count = DB::table('gamer_points')->where('gamer_id', '=', $user->id)->where('trigger_event', '=', 'registration_referrer')->count();
@endphp
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="text-white-fk">Refer someone and earn 50 Points when they register using your referral code!
                            <br><br>Your referral code is <b><u>{{ $user_ref_code }}</u></b>
                            <br><br>Maximum refferal 10,
                            @if( $reg_referrer_count == 0 )
                            <span> join using your referral - <b class="text-warning">{{$reg_referrer_count}} join</b> </span>
                            @else
                            <span>already Added using your referral - <b class="text-warning">{{$reg_referrer_count}} join</b> </span>
                            @endif
                            <br>Total 500 coupons only added if all 10 referrals joins, if less than 10 join no point will be added.
                            <br><br>Alternatively you can copy the referral code embedded link below by clicking on the box, and share the link directly.
                        </h4>
                    </div>

                    <!-- ref code -->
                    <div class="container mt-5">
                        <div class="d-flex justify-content-center row">
                            <div class="col-md-6">
                                <div class="coupon-fk p-3 bg-white">
                                    <div class="row no-gutters">
                                        <div class="col-md-4 border-right d-flex align-items-center">
                                            <img src="{!! asset('flipkart/images/logo/flipkart-s-fleet-of-gamers-logo.png')!!}" width="140px">
                                        </div>
                                        <div class="col-md-8">
                                            <div>
                                                <div class="d-flex flex-row justify-content-end off">
                                                    <h1>Click below to copy</h1>
                                                </div>
                                                <div class="d-flex flex-row justify-content-between off px-3 p-2"><span class="border border-success px-3 rounded coupon-code-fk" id="referral_link">{{ $referral_link }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </section>



    <script type="text/javascript">
        document.getElementById("referral_link").addEventListener("click", copy_referral_link);

        function copy_referral_link() {
            var copyText = document.getElementById("referral_link");
            var textArea = document.createElement("textarea");
            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("Copy");
            textArea.remove();
        }
    </script>

@endsection
