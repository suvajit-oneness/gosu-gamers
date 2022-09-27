@if(Auth::guard('gamer')->check())
    @php $user =Auth::guard('gamer')->user(); @endphp
@endif
@inject('fkController', 'App\Http\Controllers\Website\FlipKart\FlipKartController')

<header class="d-block" data-aos="zoom-out-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
    <div class="top__bar">
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-6">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                </div>
                <div class="col-6 col-sm-6">
                    <ul class="navbar-nav flex-row-reverse mr-auto">
                        {{--                <li class="nav-item active">--}}
                        {{--                  <a class="nav-link" href="https://www.facebook.com/lgnindia"><i class="fab fa-facebook-f"></i></a>--}}
                        {{--                </li>--}}
                        {{--                <li class="nav-item">--}}
                        {{--                  <a class="nav-link" href="https://twitter.com/lets_game_now"><i class="fab fa-twitter"></i></a>--}}
                        {{--                </li>--}}
                        @if(!Auth::guard('gamer')->check() )
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('flipkart.login')}}">LOGIN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('flipkart.register')}}">REGISTER</a>
                            </li>
                        @else
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('flipkart.logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">LOGOUT</a>
                            </li>
                            <form id="logout-form" action="{{ route('flipkart.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('flipkart.profile', $user->id)}}">PROFILE</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    $url_segments = request()->segments();
    $segment = (is_array($url_segments) && count($url_segments) > 1) ? $url_segments[1] : '';
//    echo $segment;
//    die();
    ?>
    <div class="container bottom__bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand navbar-brand-fk" href="{{ route('flipkart.gaming') }}" data-aos="fade-down"
               data-aos-easing="ease-in-back"
               data-aos-duration="1000" data-aos-delay="500"><img
                        src="{!! asset('flipkart/images/logo/flipkart-s-fleet-of-gamers-logo.png')!!}"
                        width="140px"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if ($segment == '') {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="{{ route('flipkart.gaming') }}">Home</a>
                    </li>
                    <li class="nav-item <?php if ($segment == 'games') {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="{!! URL::to('games') !!}">Games</a>
                    </li>
                    <li class="nav-item <?php if ($segment == 'upcoming-tournaments') {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="{{ route('flipkart.upcoming-tournaments') }}">Upcoming Tournaments</a>
                    </li>
                    <li class="nav-item">
                        @if(!Auth::guard('gamer')->check() )
                            <a class="nav-link" href="{{route('flipkart.login')}}">Create Tournaments</a>
                        @else
                            <a class="nav-link" href="{{route('gamer.tournaments.show',$user->id)}}">Create Tournaments</a>
                        @endif
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php if ($segment == 'completed-tournaments') {
                        echo "active";
                    } ?>">
{{--                        <a class="nav-link" href="{{ route('flipkart.completed-tournaments') }}">Completed Tournaments</a>--}}
                        <a class="nav-link" href="{{ route('flipkart.earn.points') }}">Points: {{ $fkController->getUserPoints() }}</a>
                    </li>
                    <li class="nav-item <?php if ($segment == 'leaderboards') {
                        echo "active";
                    } ?>">
{{--                        <a class="nav-link" href="{!! URL::to('leaderboards') !!}">Leaderboards</a>--}}
                        <a class="nav-link" href="{{ route('flipkart.earn.points') }}">Earn Points</a>
                    </li>
                    <li class="nav-item <?php if ($segment == 'site-news') {
                        echo "active";
                    } ?>">
{{--                        <a class="nav-link" href="{{route('flipkart.news')}}">News</a>--}}
                        <a class="nav-link" href="{{ route('flipkart.redeem.points') }}">Redeem Points</a>
                    </li>
                    <li class="system-menu dropdown nav-item">
                        <a class="nav-link" href="#"  aria-labelledby="dropdownMenuLink" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Shop<i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{route('products.pc')}}">PCs</a>
                        <a class="dropdown-item" href="{{route('products.laptop')}}">Laptops</a>
                         <a class="dropdown-item" href="{{route('products.savings')}}">Big Saving Day</a>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="#"><i class="fas fa-search"></i> SEARCH</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </div>
</header>
