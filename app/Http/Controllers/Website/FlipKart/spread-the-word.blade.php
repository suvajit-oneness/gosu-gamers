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
                <div class="section__title">Spread The Word...</div>
            </div>

            <div class="clearfix"></div>

            <div class="container-fluid mt-5">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="text-white-fk">Spread the word & earn 250 Points! Copy the below text and download the image to share it on your social media handle. Don't forget to use the hashtag.
                            <br><br>Be a part of Flipkart's Fleet Of Gamers & earn 500 Off Coupon Code upon registration. *T&C Apply #FlipkartFleetOfGamers<br>Link URL: https://letsgamenow.com/flipkart-gaming/register
                        </h4>
                        <br>
                        {{-- <a href="{!!asset('flipkart/images/banners/join-flipkart-gaming-conclave-lgn-banner.jpg')!!}" download="FlipkartFleetOfGamers.jpg"><img src="{!!asset('flipkart/images/banners/join-flipkart-gaming-conclave-lgn-banner.jpg')!!}" class="img-fluid"></a> --}}
                        <a href="javascript: void(0)" class="buy_btn">
                            <img src="{!!asset('flipkart/images/banners/join-flipkart-social-share-image.jpeg')!!}" class="img-fluid">
                            <input type='hidden' name='userid' id='userid' value='{{$user->id}}'/>
                        </a>
                        {{-- <div class="a2a_kit a2a_kit_size_64 a2a_default_style mt-2">
                            <a class="a2a_button_facebook a2a_counter counter" id="facebook" data-value="Facebook"></a>
                            <a class="a2a_button_whatsapp a2a_counter counter" id="whatsapp" data-value="Whatsapp"></a>
                            <a class="a2a_button_google_gmail a2a_counter counter" id="email" data-value="Gmail"></a>
                            <a class="a2a_button_linkedin a2a_counter counter" id="linkedin" data-value="Linkedin"></a>
                        </div>
                        
                        <script async src="https://static.addtoany.com/menu/page.js"></script> --}}
                        <script>
                            var a2a_config = a2a_config || {};
                            a2a_config.overlays = a2a_config.overlays || [];
                            a2a_config.overlays.push({
                                services: ['pinterest', 'facebook', 'whatsapp', 'tumblr'],
                                size: '50',
                                style: 'horizontal',
                                position: 'top center',
                                // target: 'img.share-image',
                                useImage: true,
                            });
                            </script>
                            
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            
                            <img src="{!!asset('flipkart/images/banners/join-flipkart-social-share-image.jpeg')!!}" class="img-fluid" alt="Be a part of Flipkart's Fleet Of Gamers & earn 500 Off Coupon Code upon registration. *T&C Apply #FlipkartFleetOfGamers" longdesc="https://letsgamenow.com/flipkart-gaming/register" height="291" width="440">

                        {{-- <script>
                            var a2a_config = a2a_config || {};
                            a2a_config.overlays = a2a_config.overlays || [];
                            a2a_config.overlays.push({
                                services: ['pinterest', 'facebook', 'whatsapp', 'tumblr'],
                                size: '50',
                                style: 'horizontal',
                                position: 'top center',
                                useImage: true,
                            });
                            </script>
                            
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            
                            <img src="{!!asset('flipkart/images/banners/join-flipkart-social-share-image.jpeg')!!}" class="img-fluid"> --}}

                    </div>
                </div>


            </div>
        </div>


    </section>





@endsection
