<!doctype html>
<html lang="en">
<head>
    @include("website.layouts.flipkart.flipkart-header")
</head>
<body>
<section class="register__area">
    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-sm-6 text-center p-3">
                <a href="{{route('flipkart.gaming')}}">
                    <img src="{!!asset('flipkart/images/logo/flipkart-s-fleet-of-gamers-logo.png')!!}" class="mb-3" data-aos="fade-down"
                         data-aos-duration="1000" width="100px"></a>



                <div class="login__block">

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

                    <form id="tab-1" method="post" action="{{route('flipkart.register.submit')}}"
                          class="tab-content login__form current" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="text" name="fname" value="{{old('fname','')}}" placeholder="Enter your First Name"
                                           required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="text" name="lname" value="{{old('lname','')}}" placeholder="Enter your Last Name"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="text" name="username" value="{{old('username','')}}" placeholder="Enter username"
                                           required="">
                                </div>
                            </div>
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"--}}
{{--                                     data-aos-duration="1000">--}}
{{--                                    <input type="tel" name="mobile" value="" placeholder="Enter your Mobile No"--}}
{{--                                           required="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="email" name="email" value="{{old('email','')}}" placeholder="Enter your Email ID"
                                           required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="tel" name="mobile" value="{{old('mobile','')}}" placeholder="Enter your Mobile No"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="password" name="password" id="password" value="" placeholder="Password"
                                           required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="password" name="password_confirmation" id="password_confirmation" value="" placeholder="Retype Password"
                                           required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <select name="gender" id="gender" required>
                                        <option value="Male"@if (old('gender') == "Male") selected @endif>Male</option>
                                        <option value="Female"@if (old('gender') == "Female") selected @endif>Female</option>
                                        <option value="Other"@if (old('gender') == "Other") selected @endif>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input name="dob" placeholder="Enter your DOB" type="text"
                                           onfocus="(this.type='date')" id="date" value="{{old('dob','')}}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <select name='country_id'>
                                        @foreach($country as $c)
                                            <option value="{{$c->id}}" {{ ($c->id == 99) ? 'selected' : '' }} @if (old('country_id') == $c->id) selected @endif>{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"--}}
{{--                                     data-aos-duration="1000">--}}
{{--                                    <input type="file" class="custom-file-input" name="id_proof" id="id_proof" aria-describedby="id_proof" required="" accept=--}}
{{--                                    "image/*">--}}
{{--                                    <label class="custom-file-label" for="id_proof" style="background-color:rgba(255,255,255,0.7); border: 0px; border-radius: 0">Upload ID Proof</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                                     data-aos-duration="1000">
                                    <input type="text" name="reg_ref_code" value="{{old('reg_ref_code', $ref_code ?? '' )}}" placeholder="Enter referral code">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        </div>
                        <div class="custom-control custom-checkbox text-left mb-3" data-aos="fade-zoom-in"
                             data-aos-easing="ease-in-back" data-aos-duration="1000">
                            <input type="checkbox" id="customRadioInline1" name="customRadioInline1"
                                   class="custom-control-input" required="">
                            <label class="custom-control-label" for="customRadioInline1"><small>Please accept the terms
                                    and conditions by checking the checkbox.</small></label>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="" data-aos="fade-right" data-aos-duration="1000"
                                            data-aos-easing="ease-in-sine">Register
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm-6 text-left">
                                <p data-aos="fade-top" data-aos-duration="1000" data-aos-easing="ease-in-sine"
                                   data-aos-offset="10"><a href="{{route('flipkart.login')}}">Have an Account?</a></p>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group justify-content-end">
                                    <a href="{{route('flipkart.login')}}" class="signin__btn" data-aos="fade-left"
                                       data-aos-duration="1000" data-aos-easing="ease-in-sine">Login Now</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script type="text/javascript"
        src="{!! asset('letsgamenow/js/bootstrap.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/bootstrap.min.js')) }}"></script>
<script type="text/javascript"
        src="{!! asset('letsgamenow/js/slick.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/slick.min.js')) }}"></script>
<script type="text/javascript"
        src="{!! asset('letsgamenow/js/jquery.carouselTicker.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/jquery.carouselTicker.min.js')) }}"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript">
    $(window).on("load", function () {
        $("#carouselTicker").carouselTicker();
    });
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 104) {
            $("header").addClass("top");
        } else {
            $("header").removeClass("top");
        }
    });
</script>
<script>
    AOS.init();
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.slide__wrapper').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 6,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $(document).on('click', '.filter-option a', function () {
            $('.filter-option a').removeClass('active');
            $(this).addClass('active');

            var cat = $(this).attr('data-category');
            if (cat !== 'all') {
                $('.slide__wrapper').slick('slickUnfilter');
                $('.slide__wrapper li').each(function () {
                    $(this).removeClass('slide-shown');
                });
                $('.slide__wrapper li[data-match=' + cat + ']').addClass('slide-shown');
                $('.slide__wrapper').slick('slickFilter', '.slide-shown');
            } else {
                $('.slide__wrapper li').each(function () {
                    $(this).removeClass('slide-shown');
                });
                $('.slide__wrapper').slick('slickUnfilter');
            }
        });
        $('.news__list__horizon').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.news__list'
        });

        $('.news__list').slick({
            vertical: true,
            infinite: true,
            verticalSwiping: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: false,
            focusOnSelect: true,
            asNavFor: '.news__list__horizon'
        });

        $('.video__list').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.testimonials').slick({
            dots: false,
            infinite: true,
            speed: 300,
            centerMode: true,
            arrows: false,
            centerPadding: '60px',
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });


        $('ul.register__list li').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.register__list li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });

    });
</script>

</body>
</html>