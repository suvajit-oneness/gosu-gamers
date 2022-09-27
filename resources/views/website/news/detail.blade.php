<!doctype html>
<html lang="en">
   <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/bootstrap.min.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/bootstrap.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/carouselTicker.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/carouselTicker.css')) }}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/slick.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/slick.css')) }}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/slick-theme.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/slick-theme.css')) }}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/style.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/style.css')) }}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/responsive.css')!!}?ver={{ filemtime(public_path('letsgamenow/css/responsive.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <title>{{$news->title}}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta property="og:image" content="{{URL::asset($news->image)}}"/>
    <meta property="og:site_name" content="LetsGameNow"/>
    <meta property="og:title" content="{{$news->title}}" />
    <meta property="og:description" content="{{$news->title}}" />
    <meta property="og:type" content="{{URL::asset($news->image)}}">
    <style type="text/css">
      li{
        color: #000;
      }
      .news_details_content{
        color: #000 !important;
      }
      .news_details_content p{
        color: #000 !important;
      }
    </style>
  </head>
  <body>
   @include("website.layouts.sub-header")
    <section class="banner__area game inner">
      <img src="{!!asset('letsgamenow/images/game_details.jpg')!!}" class="img-fluid">
      <h2 class="text-center">News Details</h2>
    </section>
    <section class="overflow_show pt-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 game_banner game_banner-mod mb-5">
            <img  data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" src="{{URL::asset($news->image)}}" class="img-fluid">
            <div class="game__details_area mb-5">
              <div class="row align-items-center justify-content-between game__details">
                <div class="col-sm-6">
                  <h4>{{$news->title}}</h4>
                </div>
                <div class="col-sm-5">
                  <div class="row">
                    <div class="col border-right">
                      <h5>Author</h5>
                      <p>{{$news->uploaded_by}}</p>
                    </div>
                    <div class="col">
                      <h5>Date</h5>
                      <p>{{date("M, d.Y",strtotime($news->post_date))}}</p>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
            <div class="clearfix"></div>
            <div class="news_details_content">
              <p>{!! $news->content !!}</p>
            </div>
             <div class="clearfix"></div>
            <!-- AddToAny BEGIN -->
            <div class="news_details_content">
              <p></p>
              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
              <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
              <a class="a2a_button_whatsapp"></a>
              <a class="a2a_button_facebook"></a>
              <a class="a2a_button_twitter"></a>
              <a class="a2a_button_pinterest"></a>
              <a class="a2a_button_linkedin"></a>
              <a class="a2a_button_google_gmail"></a>
              </div>
              <script async src="https://static.addtoany.com/menu/page.js"></script>
              <!-- AddToAny END -->
            </div>
          </div>
        </div>
      </div>
    </section>
    @include("website.layouts.footer")
   @include("website.layouts.scripts")
   @include('sweetalert::alert')
  </body>
</html>