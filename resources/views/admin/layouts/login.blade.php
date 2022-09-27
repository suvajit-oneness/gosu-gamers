<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <link rel="icon" type="image/png" href="{{asset('new-theme/images/logo.png')}}">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Gosu Gamers</title>
      <!-- Global stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
      <link href="{{ asset('new-theme/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('new-theme/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('new-theme/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('new-theme/css/layout.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('new-theme/css/components.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('new-theme/css/colors.min.css')}}" rel="stylesheet" type="text/css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      <!-- /global stylesheets -->
      <!-- Core JS files -->
      <script src="{{ asset('new-theme/js/main/jquery.min.js')}}"></script>
      <script src="{{ asset('new-theme/js/main/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset('new-theme/js/plugins/loaders/blockui.min.js')}}"></script>
      <!-- /core JS files -->
      <!-- Theme JS files -->
      <script src="{{ asset('new-theme/js/plugins/visualization/d3/d3.min.js')}}"></script>
      <script src="{{ asset('new-theme/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
      <script src="{{ asset('new-theme/js/plugins/forms/styling/switchery.min.js')}}"></script>
      <script src="{{ asset('new-theme/js/plugins/ui/moment/moment.min.js')}}"></script>
      <script src="{{ asset('new-theme/js/plugins/pickers/daterangepicker.js')}}"></script>
      <script src="{{ asset('new-theme/js/app.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_pages/dashboard.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/streamgraph.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/sparklines.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/lines.js')}}"></script>	
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/areas.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/donuts.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/bars.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/progress.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/heatmaps.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/pies.js')}}"></script>
      <script src="{{ asset('new-theme/js/demo_charts/pages/dashboard/light/bullets.js')}}"></script>
      <!-- /theme JS files -->
   </head>
   <body>
      <style type="text/css">
         body {
            font-family: 'Poppins', sans-serif;
         }
         .login_page_wrap{  
            position: relative;                      
            background: url("{!!asset("new-theme/images/login_banner.jpg")!!}");
            background-size: cover;
            background-position: 52% center;
         }
         .login_page_wrap:before {
            position: absolute;
            content: "";
            background-color: rgba(239, 63, 67, 0.30);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            mix-blend-mode: color;
         }
         .login_form{
         width: 100%;
         max-width: 400px;
         background: rgba(255,255,255,0.45);
         padding: 30px;
         border-radius: 10px;
         z-index: 9;
         }
         .login_logo{
         width: 180px;
         margin: 0 auto 15px;
         }
         .login_body input{
         height: 50px;
         }
         .form-control-feedback{
         line-height: calc(2.5385em + .875rem + 2px);
         }
         .login_btn{
         background: #e8233a;
         height: 50px;
         color: #fff;
         font-size: 14px;
         font-weight: 400;
         }
         .fotget_text{
         color: #000;
         font-size: 14px;
         letter-spacing: 0.4px;
         font-weight: 500;
         }
         .fotget_text:hover{
         color: #e8233a;
         }
      </style>
      <!-- Page content -->
      <div class="page-content login_page_wrap">
         <!-- Main content -->
         <div class="content-wrapper">
            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">
               <!-- Login form -->
               <form class="login-form login_form"  method="post" action="{{ route('login/admins') }}">
                  @csrf
                  <div class="login_body">
                     <div class="login_logo">
                        <img class="img-fluid" src="{{url('new-theme/images/logo.png')}}">
                     </div>
                     <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="text"  value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-control-feedback">
                           <i class="icon-user text-muted"></i>
                        </div>
                     </div>
                     <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-control-feedback">
                           <i class="icon-lock2 text-muted"></i>
                        </div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-block login_btn text-uppercase">Sign in</button>
                     </div>
                     <div class="text-center">
                        <a class="fotget_text" href="#">Forgot password?</a>
                     </div>
                  </div>
               </form>
               <!-- /login form -->
            </div>
            <!-- /content area -->
         </div>
         <!-- /main content -->
      </div>
      <!-- /page content -->
      {{--include sweetalert--}}
      @include('sweetalert::alert')
   </body>
</html>

