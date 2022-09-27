@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); @endphp
@endif
   <header class="d-block" data-aos="zoom-out-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
        <div class="container">
          <div class="top__bar">
          <div class="row justify-content-end">
            <div class="col-12 col-sm-6">
              <ul class="navbar-nav mr-auto login_text">
              @if(!Auth::guard('gamer')->check() )
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('home.login')}}"><i class="fas fa-user mr-1"></i> LOGIN / REGISTER</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="{{route('gamer.register')}}">REGISTER</a>
                </li> -->
             @endif
             @if(Auth::guard('gamer')->check())
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('gamer.logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">LOGOUT</a>
                </li>
                <form id="logout-form" action="{{ route('gamer.logout') }}" method="POST" style="display: none;">
                 @csrf
                   </form>  
                <li class="nav-item">
                  <a class="nav-link" href="{{route('gamer.profile',$user->id)}}">PROFILE</a>
                </li>
                @endif
              </ul>
            </div>
            {{-- <div class="col-6 col-sm-6"> --}}
              {{-- <ul class="navbar-nav flex-row-reverse mr-auto"> --}}
{{--                <li class="nav-item active">--}}
{{--                  <a class="nav-link" href="https://www.facebook.com/lgnindia"><i class="fab fa-facebook-f"></i></a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                  <a class="nav-link" href="https://twitter.com/lets_game_now"><i class="fab fa-twitter"></i></a>--}}
{{--                </li>--}}
              {{-- </ul> --}}
            {{-- </div> --}}
          </div>
        </div>
      </div>
      <?php
      $url_segments = request()->segments();
      $segment = (is_array($url_segments) && count($url_segments)>0)?$url_segments[0]:'';
      //echo $segment;
      //die();
      ?>
      <div class="container bottom__bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="{{ url('/') }}" data-aos="fade-down" data-aos-easing="ease-in-back" data-aos-duration="1000" data-aos-delay="500"><img src="{!! asset('letsgamenow/images/logo.png')!!}" width="140px"></a>
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item <?php if($segment==''){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('/') !!}">Home</a>
              </li>
              <li class="nav-item <?php if($segment=='games'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('games') !!}">Games</a>
              </li>
              <li class="system-menu dropdown nav-item <?php if($segment=='upcoming-tournaments'){echo "active";} ?>">
                <a class="nav-link" href="#"  aria-labelledby="dropdownMenuLink" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Upcoming Tournaments</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{!! URL::to('upcoming-tournaments') !!}">Gosugamers IN</a>
                  <a class="dropdown-item" href="{!! URL::to('user-created-tournaments') !!}">User Created</a>
                </div>
              </li>
              <li class="nav-item">
                @if(!Auth::guard('gamer')->check() )
                <a class="nav-link" href="{{route('home.login')}}">Create Tournaments</a>
                @else
                <a class="nav-link" href="{{route('gamer.tournaments.show',$user->id)}}">Create Tournaments</a>
                @endif
              </li>
              <li class="nav-item <?php if($segment=='completed-tournaments'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('completed-tournaments') !!}">Completed Tournaments</a>
              </li>
              <li class="nav-item <?php if($segment=='leaderboards'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('leaderboards') !!}">Leaderboards</a>
              </li>
              <!-- <li class="nav-item <?php if($segment=='site-news'){echo "active";} ?>">
                <a class="nav-link" href="{!! URL::to('site-news') !!}">News</a>
              </li> -->
            </ul>
          </div>
        </nav>
      </div>
    </header>
