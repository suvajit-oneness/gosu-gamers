@extends("website.layouts.flipkart.flipkart-master")
@section("content")
    <section class="banner__area game inner">
        <img src="{!!asset('new-theme\images\site banner\news.jpg')!!}" class="img-fluid">
        <h2 class="text-center">News</h2>
    </section>
    <section class="sponser_bg pt-5 pb-5">
        <!-- <div class="title__area mb-3 text-center">
          <div class="section__title">TOURNAMENTS</div>
          <div class="section__subtitle">Game Details</div>
        </div> -->



        <div class="clearfix"></div>
        <div class="container-fluid">
            <ul class="tournament_list news_list big">
                @foreach($news as $data)
                    <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $data->title)); ?>
                    <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                        <div class="news__blocks">
                            <div class="news__blocks_img">
                                <a class="d-block" href="{!! URL::to('news-details/'.$data->id.'/'.$key) !!}"><img
                                            src="{{URL::asset($data->image)}}" alt=""></a>
                            </div>
                            <div class="news__blocks__body">
                                <a class="d-block mb-2"
                                   href="{!! URL::to('news-details/'.$data->id.'/'.$key) !!}">{{$data->title}}</a>
                                <span class="d-block">{{date("M, d.Y",strtotime($data->post_date))}}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $news->links() }}
        </div>
        <div class="clearfix p-5"></div>
        <div class="container mt-5">
            <div class="title__area text-center">
                <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                    <img src="{!!asset('letsgamenow/images/foot-logo.png')!!}"></div>
                <div class="section__subtitle">About Us</div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="container-fluid mt-5 mb-5">
            <div class="about_text" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
                <p>Lets Game Now is a simple to use esports portal for all types of gamers. With a variety of online
                    tournaments, gamer will get the chance to qualify for international tournaments, get noticed and
                    build a career as a professional, or just play for fun against friend and compete regularly for cash
                    prizes.</p>
            </div>
        </div>
    </section>
@endsection