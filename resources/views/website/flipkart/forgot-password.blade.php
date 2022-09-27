<!doctype html>
<html lang="en">
<head>
    @include("website.layouts.flipkart.flipkart-header")
</head>
<body>
<section class="login__area">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6 text-center p-4 p-sm-5">
                <a href="{{route('flipkart.gaming')}}">
                    <img src="{!!asset('flipkart/images/logo/flipkart-s-fleet-of-gamers-logo.png')!!}" class="mb-5"
                         data-aos="fade-down"
                         data-aos-duration="1000" width="100px"> </a>

                <div class="login__block">

                    @if(Session::has('message'))
                        <div class="col-sm-12 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show"
                             role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

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


                    <form class="login__form" method="post" onsubmit="return ValidateReqForm();"
                          action="{{route('flipkart.forgot.password.submit')}}">
                        @csrf
                        <div class="form-group" data-aos="fade-zoom-in" data-aos-easing="ease-in-back"
                             data-aos-duration="1000">
                            <button type="button" class=""><span class="fas fa-envelope"></span></button>
                            <input type="text" name="identity" id="identity"
                                   placeholder="Please enter Username / Email / Mobile">
                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="" data-aos="fade-right" data-aos-duration="1000"
                                            data-aos-easing="ease-in-sine">Reset
                                    </button>
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
<script src="{!! asset('letsgamenow/js/jquery-3.4.1.slim.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/jquery-3.4.1.slim.min.js')) }}"></script>
<script src="{!! asset('letsgamenow/js/popper.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/popper.min.js')) }}"></script>

{{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>--}}

<script type="text/javascript"
        src="{!! asset('letsgamenow/js/bootstrap.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/bootstrap.min.js')) }}"></script>
<script type="text/javascript"
        src="{!! asset('letsgamenow/js/slick.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/slick.min.js')) }}"></script>
<script type="text/javascript"
        src="{!! asset('letsgamenow/js/jquery.carouselTicker.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/jquery.carouselTicker.min.js')) }}"></script>

<script src="{!! asset('letsgamenow/js/jquery.fancybox.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/jquery.fancybox.min.js')) }}"></script>
<script src="{!! asset('letsgamenow/js/aos.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/aos.js')) }}"></script>

{{--<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>--}}
{{--<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>--}}

<script type="text/javascript">
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

<link rel="stylesheet" href="{!! asset('letsgamenow/css/sweetalert.min.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/sweetalert.min.css')) }}">
<script src="{!! asset('letsgamenow/js/sweetalert.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/sweetalert.min.js')) }}"></script>

{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>--}}

<script>
    $(document).ready(function () {
        $("#mobile").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });

    function ValidateReqForm() {
        var identity = $("#identity").val();
        if (identity == "") {
            $("#identity").css('border-color', 'red');
            swal('Please Enter Username / Email / Mobile ');
            return errorflag = false;
        }
    }

</script>

@include('sweetalert::alert')

</body>
</html>