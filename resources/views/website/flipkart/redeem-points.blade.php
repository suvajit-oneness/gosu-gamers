@php
    $logged_in = 0;
@endphp

@if(Auth::guard('gamer')->check())
    @php
        $user = Auth::guard('gamer')->user();
        $logged_in = 1;
    @endphp
@endif
@inject('fkController', 'App\Http\Controllers\Website\FlipKart\FlipKartController')

@php
$my_points = $fkController->getUserPoints();
$my_redeem_count = $fkController->getRedeemCount();
//$my_points = 1800;
@endphp


@extends("website.layouts.flipkart.flipkart-master")
@section("content")

    <section class="testimonial_bg pt-5 pb-5">

        <section class="bluedark_bg pt-5 pb-5">
            <div class="title__area text-center">
            </div>
        </section>


        <div class="container">

            <div class="title__area text-center">
                <div class="section__title text-white-fk">Redeem Points</div>
                <h4 class="text-white-fk">Points: {{ $my_points }}</h4>
            </div>

            <div class="clearfix"></div>





            <!-- voucher code -->
            @isset($assinged_coupon[0])
                <div class="container mt-5">
                    <div class="d-flex justify-content-center row">
                        <div class="col-md-6 d-flex align-items-center align-content-center">
                            <h5 class="text-white-fk">Congratulations! Please find below your Voucher Code.<br>Please click on the code to copy the code and scroll down to see the redemption options.</h5>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center row">
                        <div class="col-md-6">
                            <div class="coupon-fk p-3 bg-white">
                                <div class="row no-gutters">
                                    <div class="col-md-4 border-right d-flex align-items-center">
                                        <img src="{!! asset('flipkart/images/logo/flipkart-logo.png')!!}" width="150px">
                                    </div>
                                    <div class="col-md-8">
                                        <div>
                                            <div class="d-flex flex-row justify-content-end off">
                                                <h1>Rs. {{ $assinged_coupon[0]->amount }}</h1><span>OFF</span>
                                            </div>
                                            <div class="d-flex flex-row justify-content-between off px-3 p-2"><span>Voucher code:</span><span class="border border-success px-3 rounded coupon-code-fk" id="voucher_code_id">{{ $assinged_coupon[0]->voucher }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset





            <div class="container-fluid mt-5">

                <!-- redeem in 2 cols per row -->
                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-6 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Redeem 500 points for gift voucher worth of Rs. 500.</h4>

                        @if($logged_in == 1 && $my_points >= 500 && $my_redeem_count < 1)
                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.redeem.points.do',500)}}" role="button">Redeem 500 points</a>
                        @else
                            <button type="button" class="btn btn-secondary btn-lg" disabled>Redeem 500 points</button>
                        @endif

                    </div>

                    {{-- <div class="col-sm-6 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Redeem 750 points for gift voucher worth of Rs. 750.</h4>

                        @if($logged_in == 1 && $my_points >= 750 && $my_redeem_count < 1)
                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.redeem.points.do',750)}}" role="button">Redeem 750 points</a>
                        @else
                            <button type="button" class="btn btn-secondary btn-lg" disabled>Redeem 750 points</button>
                        @endif

                    </div> --}}
                    <div class="col-sm-6 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Redeem 800 points for gift voucher worth of Rs. 800.</h4>

                        @if($logged_in == 1 && $my_points >= 800 && $my_redeem_count < 1)
                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.redeem.points.do',800)}}" role="button">Redeem 800 points</a>
                        @else
                            <button type="button" class="btn btn-secondary btn-lg" disabled>Redeem 800 points</button>
                        @endif

                    </div>
                </div>

                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-6 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Redeem 1000 points for gift voucher worth of Rs. 1000.</h4>

                        @if($logged_in == 1 && $my_points >= 1000 && $my_redeem_count < 1)
                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.redeem.points.do',1000)}}" role="button">Redeem 1000 points</a>
                        @else
                            <button type="button" class="btn btn-secondary btn-lg" disabled>Redeem 1000 points</button>
                        @endif
                    </div>

                    {{-- <div class="col-sm-6 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Redeem 1500 points for gift voucher worth of Rs. 1500.</h4>

                        @if($logged_in == 1 && $my_points >= 1500 && $my_redeem_count < 1)
                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.redeem.points.do',1500)}}" role="button">Redeem 1500 points</a>
                        @else
                            <button type="button" class="btn btn-secondary btn-lg" disabled>Redeem 1500 points</button>
                        @endif
                    </div> --}}
                    <div class="col-sm-6 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Redeem 1300 points for gift voucher worth of Rs. 1300.</h4>

                        @if($logged_in == 1 && $my_points >= 1300 && $my_redeem_count < 1)
                            <a class="btn btn-lg btn-block btn-primary mt-auto" href="{{route('flipkart.redeem.points.do',1300)}}" role="button">Redeem 1300 points</a>
                        @else
                            <button type="button" class="btn btn-secondary btn-lg" disabled>Redeem 1300 points</button>
                        @endif
                    </div>
                </div>



                <!-- redeem section label -->
                <div class="row top-buffer-fk-100" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-12">
                        <h4 class="text-white-fk">Vouchers can be used to purchase below products ranges from Flipkart. Please copy the code and use during actual checkout.
                            <br>
                            <b><i><u>Please note, only one voucher can be redeemed which can be used to avail below discounts on Laptops.</u></i></b></h4>
                    </div>
                </div>



                <!-- product range -->
                <!-- 500 rs ramge -->
                <div class="row top-buffer-fk-100" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.register')}}"><img src="{!!asset('flipkart/images/redeem-points/get-500-off-on-select-laptops.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Use 500 points and get 500 off on Select Laptops.</h4>

                        <a class="btn btn-lg btn-block btn-primary mt-auto" href="https://www.flipkart.com/laptops/~cs-umco268qus/pr?sid=6bo%2Cb5g&collection-tab-name=laptops" target="_blank" role="button">Use 500 points and get 500 off on Select Laptops</a>
                    </div>
                </div>



                <!-- 750 rs ramge -->
                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.register')}}"><img src="{!!asset('flipkart/images/redeem-points/get-750-off-on-select-laptops.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Use 750 points and get 750 off on Select Laptops.</h4>

                        <a class="btn btn-lg btn-block btn-primary mt-auto" href="https://www.flipkart.com/laptops/~cs-9ajw77wdfu/pr?sid=6bo%2Cb5g&collection-tab-name=laptops" target="_blank" role="button">Use 750 points and get 750 off on Select Laptops</a>
                    </div>
                </div>


                <!-- 1000 rs ramge -->
                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.register')}}"><img src="{!!asset('flipkart/images/redeem-points/get-750-off-on-select-laptops.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Use 1000 points and get 1000 off on Select Laptops.</h4>

                        <a class="btn btn-lg btn-block btn-primary mt-auto" href="https://www.flipkart.com/6bo/b5g/~cs-kqhltxpbg1/pr?sid=6bo,b5g&collection-tab-name=laptops" target="_blank" role="button">Use 1000 points and get 1000 off on Select Laptops</a>
                    </div>
                </div>


                <!-- 1500 rs ramge -->
                <div class="row top-buffer-fk-20" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <div class="col-sm-4 card-body d-flex flex-column">
                        <a href="{{route('flipkart.register')}}"><img src="{!!asset('flipkart/images/redeem-points/get-750-off-on-select-laptops.jpg')!!}" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8 card-body d-flex flex-column">
                        <h4 class="text-white-fk">Use 1500 points and get 1500 off on Select Laptops.</h4>

                        <a class="btn btn-lg btn-block btn-primary mt-auto" href="https://www.flipkart.com/laptops/~cs-wfiso7klky/pr?sid=6bo%2Cb5g&collection-tab-name=laptops" target="_blank" role="button">Use 1500 points and get 1500 off on Select Laptops</a>
                    </div>
                </div>


            </div>
        </div>


    </section>



    <script type="text/javascript">
        document.getElementById("voucher_code_id").addEventListener("click", copy_voucher_code);

        function copy_voucher_code() {
            var copyText = document.getElementById("voucher_code_id");
            var textArea = document.createElement("textarea");
            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("Copy");
            textArea.remove();
        }
    </script>

@endsection
