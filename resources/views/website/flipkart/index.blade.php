@if(Auth::guard('gamer')->check())
    @php $user =Auth::guard('gamer')->user(); @endphp
@endif
@inject('fkController', 'App\Http\Controllers\Website\FlipKart\FlipKartController')

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


    <!-- banners -->
    @if($banners->count() > 0)
        <div class="dark_bg col-xs-12 d-none d-md-block" style="height:100px;"></div>

        <section class="banner__area" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-offset="0">
            <ul class="banner">
                @foreach($banners as $banner)
                    <li><a href="{{$banner->description}}"><img src="{{URL::asset($banner->image)}}?ver={{ filemtime(public_path($banner->image)) }}" class="img-fluid"></a>
                    </li>
                @endforeach

            </ul>
        </section>
    @else
        <div class="dark_bg col-xs-12" style="height:100px;"></div>
    @endif

    <!-- single coming soon banner -->
    {{-- <section data-aos="fade-zoom-out" data-aos-easing="ease-in-back" data-aos-offset="0" data-aos-duration="1000">
        <div class="row">
            <a href="{{ route('flipkart.upcoming-tournaments') }}"><img
                        src="{!! asset('flipkart/images/banners/bgmi-short.jpg')!!}?ver={{ filemtime(public_path('flipkart/images/banners/bgmi-short.jpg')) }}"
                        class="img-fluid"></a>
        </div>
    </section> --}}

    <!-- action area -->
    <section class="bluedark_bg pt-5 pb-5">
        <div class="clearfix"></div>

        <div class="container mt-5">
            <div class="row align-items-center justify-content-between feature_area" style="margin-bottom: 60px;">
                <div class="col-sm-4 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back"
                     data-aos-duration="1000">
                    <img src="{!!asset('letsgamenow/images/success.png')!!}">
                    <h4>Total Points: {{ $fkController->getUserPoints() }}</h4>
                </div>
                <div class="col-sm-4 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back"
                     data-aos-duration="1000">
                    <img src="{!!asset('letsgamenow/images/success.png')!!}">
                    <h4></h4>
                    <a href="{{ route('flipkart.earn.points') }}" class="white__btn">EARN POINTS</a>
                </div>
                <div class="col-sm-4 text-center" data-aos="zoom-in" data-aos-easing="ease-in-back"
                     data-aos-duration="1000">
                    <img src="{!!asset('letsgamenow/images/success.png')!!}">
                    <h4></h4>
                    <a href="{{ route('flipkart.redeem.points') }}" class="white__btn">REDEEM POINTS</a>
                </div>
            </div>
        </div>

    </section>




    <!-- news section -->
    <section class="bluedark_bg pt-5 pb-5">
        <div class="title__area text-center">
            <div class="section__title">Current Events / Offers / Notices</div>
            <div class="section__subtitle">Latest News</div>
        </div>

        <div class="clearfix"></div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-8 order-sm-12" data-aos="fade-right" data-aos-easing="ease-in-back"
                     data-aos-duration="1000">
                    <ul class="news__list__horizon">
                        @foreach($news as $n)
                            @php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $n->title)); @endphp
                            <li>
                                <div class="news__blocks" style="background-image: url({{URL::asset($n->image)}});">
                                    <div class="news__blocks__body">
                                        <a href="#">{{$n->title}}</a>
                                        <h4>{{$n->post_date}}</h4>
                                    </div>
                                    <div class="news__blocks__footer">
                                        <div class="col d-flex p-0">
                                            <div class="col">
                                                <p>Category</p>
                                                <h4>{{$news_categories_arr[$n->category_id]}}</h4>
                                            </div>
                                            <!--  <div class="col">
                                               <p>Likes</p>
                                               <h4><i class="far fa-eye"></i> 0</h4>
                                             </div> -->
                                            <div class="col">
                                                <!-- <p>View</p>
                                                <h4><i class="fas fa-heart"></i> 0</h4> -->
                                            </div>
                                        </div>
                                        <div class="col-5 col-sm-3 ml-auto p-0">
                                            <a href="{!! URL::to('news-details/'.$n->id.'/'.$key) !!}"
                                               class="news__button">More Details <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-4 order-sm-1" data-aos="fade-left" data-aos-easing="ease-in-back"
                     data-aos-duration="1000">
                    <ul class="news__list">
                        @foreach($news as $n)

                            <li>
                                <div class="news__image">
                                    <img src="{{URL::asset($n->image)}}">
                                </div>
                                <div class="news__content">
                                    <h2>{{$n->title}}</h2>
                                    <!-- <p>Na'Vi moves to second in European ESL Pro League</p> -->
                                    <h4><a href="" class="badge badge-primary">{{$news_categories_arr[$n->category_id]}}</a> {{$n->post_date}}</h4>
{{--                                    <h4>{{$n->post_date}}</h4>--}}
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <br>


                </div>
            </div>

            <div class="row">
                <div class="col-sm-12" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <a class="btn btn-lg btn-block btn-warning mt-auto" href="{{route('flipkart.news')}}" role="button">All
                        News</a>
                </div>
            </div>
        </div>
    </section>




    @if(Auth::guard('gamer')->check() )

        <section class="sponser_bg pt-5 pb-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-4 col-md-4">
                        <div class="profile_picture_wrap mb-4">
                            <div class="profile_picture">
                                <img class="img-fluid" src="{{URL::asset($user->image ?? '')}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-7 col-md-8 col-12">
                        <div class="profile_details">
                            <h3 class="mb-4">  @foreach($teams as $team)
                                    @if($team->gamer_id == $user->id)
                                        {{ $team->team_name }}
                                    @endif
                                @endforeach<a href="{{route('flipkart.profile',$user->id)}}">Edit <i class="fas fa-edit"></i></a>
                            </h3>
                            <ul class="mb-3">
                                <li><i class="fas fa-calendar"></i> Member Since {{substr($user->created_at,0,10)}}</li>
                                <li><i class="fas fa-map-marker-alt"></i>
                                    @foreach($country as $coun)
                                        @if($coun->id == $user->country_id)
                                            {{$coun->name}}
                                        @endif
                                    @endforeach
                                </li>
                                <li><i class="fas fa-envelope"></i> {{$user->email}}</li>
                                <li><i class="fas fa-mobile"></i> {{$user->mobile}}</li>
                                <li><i class="fas fa-user-plus"></i> {{$user->user_ref_code}}</li>
                            </ul>
                            <div class="d-flex justify-content-between mb-2">
                                <div class="add_game_id">
                                    <a href="{{route('mytournament',$user->id)}}">Show My Tournament</a>
                                </div>
                                <div class="add_game_id">
                                    <a href="{{route('tournamentwon',$user->id)}}">Won Tournament</a>
                                </div>
                                <div class="add_game_id">
                                    <a href="{{route('mytransactions',$user->id)}}">My Transactions</a>
                                </div>
                            </div>
                        @if(Session::has('message'))
                            <!--<div class="alert {{ Session::get('alert-class', 'alert-info') }}">-->
                                <!--    <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>-->
                            <!--    {{ Session::get('message') }}-->
                                <!--</div>-->
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show"
                                     role="alert">
                                    {{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{--                    <div class="d-flex justify-content-between mb-3">--}}
                            {{--                        <div class="add_game_id">--}}
                            {{--                            <a data-toggle="modal" data-target="#addTeamMember" href="#addTeamMember">Add Team Member</a>--}}
                            {{--                        </div>--}}
                            {{--                        <div class="add_game_id">--}}
                            {{--                            <a data-toggle="modal" data-target="#addGameId" href="#addGameId">Add Game ID</a>--}}
                            {{--                            (Ingame name for Captain)--}}
                            {{--                        </div>--}}
                            {{--                    </div>--}}
                        </div>
                    </div>
                </div>

            {{--                <div class="row align-items-center justify-content-between feature_area mb-5">--}}
            {{--                    <div class="col-sm-4 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back"--}}
            {{--                         data-aos-duration="1000">--}}
            {{--                        <img src="{!!asset('letsgamenow/images/rank.png')!!}">--}}
            {{--                        <h4>511</h4>--}}
            {{--                        <a href="#" class="red__btn">OVERALL RANK</a>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-sm-4 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back"--}}
            {{--                         data-aos-duration="1000">--}}
            {{--                        <img src="{!!asset('letsgamenow/images/earnings.png')!!}">--}}
            {{--                        <h4>N/A</h4>--}}
            {{--                        <a href="#" class="white__btn">EARNINGS</a>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-sm-4 text-center" data-aos="zoom-in" data-aos-easing="ease-in-back"--}}
            {{--                         data-aos-duration="1000">--}}
            {{--                        <img src="{!!asset('letsgamenow/images/log_point.png')!!}">--}}
            {{--                        <h4>N/A</h4>--}}
            {{--                        <a href="#" class="white__btn">LGN POINTS</a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}


            <!-- cut part -->


            </div>
        </section>




    @endif





    <!-- upcoming tournaments -->
    <section class="banner__area" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-offset="0">
        <div class="" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-delay="500" data-aos-duration="1000">
            {{--            <span>Upcoming Tournaments</span>--}}
            <div id="carouselTicker" class="carouselTicker">
                <ul class="carouselTicker__list">
                    @foreach($upcoming_tournaments as $upcoming_tournament)
                        <li class="carouselTicker__item">
                            <a href="" class="ticker_cat bg-primary">{{$upcoming_tournament->game_name}}</a><a
                                    href="#">{{$upcoming_tournament->name}} is starting
                                from {{date("M.d.Y",strtotime($upcoming_tournament->start_date))}}. Register today to
                                participate.</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>



@endsection
