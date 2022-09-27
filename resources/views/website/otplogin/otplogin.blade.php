<!doctype html>
<html lang="en">
  <head>
@include("website.layouts.header")
<style type="text/css">
  .abcRioButtonBlue {
    width: 100% !important;
  }
</style>
  </head>
  <body>
  <section class="login__area">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 login_image">
          </div>
          <div class="col-sm-6 login_wrapper text-center">
            <a href="{{route('home.index')}}" >
            <img src="{!!asset('letsgamenow/images/logo.png')!!}" class="mb-5" data-aos="fade-down" data-aos-duration="1000" width="100px"> </a>
            <h4>Login / Register</h4>
             @if(Session::has('message'))
            <!--<div class="alert {{ Session::get('alert-class', 'alert-info') }}">-->
            <!--    <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>-->
            <!--    {{ Session::get('message') }}-->
            <!--</div>-->
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="login__block">
               <form action="{{route('gamer.sociallogin.submit')}}" method="post" id="fblogin1">
                  @csrf
                    <input type="hidden" name="fname" id="fblogin-fname">
                    <input type="hidden" name="lname" id="fblogin-lname">
                    <input type="hidden" name="email" id="fblogin-email1">
                    <input type="hidden" name="password" value="12345" >
                </form>
              <form class="login__form" method="post"onsubmit="return ValidateReqForm();" action="{{route('optloginpost')}}">
                @csrf

                <div class="login_field">
                  <div class="form-group email_field" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <!-- <button type="button" class=""><span class="fas fa-envelope"></span></button> -->
                    <input type="text" name="email" id="email" placeholder="Please enter your Email" >
                  </div>
                  <span>or</span>
                  <!-- <input type="hidden" name="email" id="email" value="">  -->
                  <div class="form-group mobile_field" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <!-- <button type="button" class=""><span class="fas fa-mobile"></span></button> -->
                    <input type="text" name="mobile" id="mobile" placeholder="Please enter your Mobile" >
                  </div>
                </div>
                <div class="row align-items-center justify-content-end">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="submit" class="w-100" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-in-sine">Submit Now</button>
                    </div>
                  </div> 
                </div> 
                <center><p style="color: white;text-align: center; margin-bottom: 1rem;">or via social network</p></center>
                <div class="row align-items-center">
                  <div class="col-sm-12 d-flex justify-content-center">
                    <button type="button" class="login_facebook" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-in-sine" onclick="fbLogin()">
                      <img src="{!! asset('letsgamenow/images/facebook.png')!!}">
                    </button>
                    <!-- <button type="button" class="" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-in-sine" onclick="googleLogin()">Login With Google</button> -->
                    <div id="gSignIn"></div>
                  </div> 
                </div> 
              </form>
              <p style="color: #fff;">* SMS may take some time to reach</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/bootstrap.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/bootstrap.min.js')) }}"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/slick.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/slick.min.js')) }}"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/jquery.carouselTicker.min.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/jquery.carouselTicker.min.js')) }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript">
      $(window).on("load", function() {
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
      $(document).ready(function(){

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

         $(document).on('click', '.filter-option a', function(){
          $('.filter-option a').removeClass('active');
            $(this).addClass('active');

            var cat = $(this).attr('data-category');
            if(cat !== 'all'){
              $('.slide__wrapper').slick('slickUnfilter');
              $('.slide__wrapper li').each(function(){
                $(this).removeClass('slide-shown');
              });
              $('.slide__wrapper li[data-match='+ cat +']').addClass('slide-shown');
              $('.slide__wrapper').slick('slickFilter', '.slide-shown');
            }
        
            else{
              $('.slide__wrapper li').each(function(){
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


          $('ul.register__list li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.register__list li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
          });

          signOut();
      });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
         $("#mobile").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
                }
            });
     });

     function ValidateReqForm(){
        var email = $("#email").val();
        var mobile = $("#mobile").val();
        var mobilelen= mobile.length;
        if(email!=""){
            if(IsEmail(email)==false){
                $("#email1").css('border-color','red');
                swal('Please Enter Valid Email id');
                return errorflag = false;
            }

            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(!regex.test(email)) {
                        return false;
                        }else{
                        return true;
                        }
                }
        }
        if(mobile!=""){
            if( mobilelen != 10){
                $("#mobile").css('border-color','red');
                swal('Please Enter Valid MOBILE No. ');
                return errorflag = false;
            }
        }
     }

          window.fbAsyncInit = function() {
          FB.init({
            appId      : '213080787698127',
            cookie     : true,
            xfbml      : true,
            version    : 'v11.0'
          });

          FB.AppEvents.logPageView();

        };

          (function(d, s, id){
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {return;}
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/en_US/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


      function fbLogin() {

        FB.login(function(response) {
            if (response.authResponse) {

                FB.api('/me?fields=id,first_name,last_name,email,link', function(response) {
                  //alert(JSON.stringify(response));
                    //console.log(response); return;
                    if(response) {
                        //alert(JSON.stringify(response));
                        $("#fblogin-fname").val(response.first_name);
                        $("#fblogin-lname").val(response.last_name);
                        $("#fblogin-email1").val(response.email);
                        $("#fblogin1").submit();

                    }
                    //console.log(response);
                });
            } else {
                //console.log('User cancelled login or did not fully authorize.');
            }
        },{scope:'email'});
    }
    </script>

    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
    <meta name="google-signin-client_id" content="502734386263-koae0fcv0m5iqiqfdp5585dtd81cueqa.apps.googleusercontent.com">
    <script type="text/javascript">
      $(document).ready(function(){


      })
    </script>
<script>

function googleLogin(){
  gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}
// Render Google Sign-in button
function renderButton() {
    // var auth2 = gapi.auth2.getAuthInstance();
    //     auth2.signOut().then(function () {
    //       console.log('User signed out.');

    //     });
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });

    
}

// Sign-in success callback
function onSuccess(googleUser) {
    // Get the Google profile data (basic)
    //var profile = googleUser.getBasicProfile();
    
    // Retrieve the Google account data
    gapi.client.load('oauth2', 'v2', function () {
        var request = gapi.client.oauth2.userinfo.get({
            'userId': 'me'
        });
        request.execute(function (resp) {
          //alert(JSON.stringify(resp));
            // Display the user details

              //   var url = "http://disciplebay.com/website/Auth/google_login";

              //   var email = resp.email;
              //   var name = resp.name;
              // var profileHTML = '';
              // window.location = url+'?username='+email+'&name='+name;
            // var profileHTML = '<h3>Welcome '+resp.given_name+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></h3>';
            // profileHTML += '<img src="'+resp.picture+'"/><p><b>Google ID: </b>'+resp.id+'</p><p><b>Name: </b>'+resp.name+'</p><p><b>Email: </b>'+resp.email+'</p><p><b>Gender: </b>'+resp.gender+'</p><p><b>Locale: </b>'+resp.locale+'</p><p><b>Google Profile:</b> <a target="_blank" href="'+resp.link+'">click to view profile</a></p>';
            // document.getElementsByClassName("userContent")[0].innerHTML = profileHTML;
            
            // document.getElementById("gSignIn").style.display = "none";
            // document.getElementsByClassName("userContent")[0].style.display = "block";
            $("#fblogin-fname").val(resp.given_name);
            $("#fblogin-lname").val(resp.family_name);
            $("#fblogin-email1").val(resp.email);
            $("#fblogin1").submit();

            document.getElementById("gSignIn").style.display = "none";
            document.getElementsByClassName("userContent")[0].style.display = "block";
        });
    });
}

// Sign-in failure callback
function onFailure(error) {
    alert(error);
}

// Sign out the user
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        document.getElementsByClassName("userContent")[0].innerHTML = '';
        document.getElementsByClassName("userContent")[0].style.display = "none";
        document.getElementById("gSignIn").style.display = "block";
    });
    
    auth2.disconnect();
}
</script>

  </body>
</html>