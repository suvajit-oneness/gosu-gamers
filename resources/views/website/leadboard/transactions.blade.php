@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <!-- <img src="{!!asset('new-theme\images\site banner\LEADERBOARDS.jpg')!!}" class="img-fluid"> -->

      <h2 class="text-center">OUR LEADERBOARDS</h2>

      <div class="news__ticker">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                @foreach($upcoming_tournaments as $upcoming_tournament)
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-primary">{{$upcoming_tournament->game_name}}</a><a href="#">{{$upcoming_tournament->name}} is starting from {{date("M.d.Y",strtotime($upcoming_tournament->start_date))}}. Register today to participate.</a>
                </li>
              @endforeach
            </ul>
        </div>
      </div>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      <div class="title__area text-center">
      <div class="section__subtitle">TRANSACTION</div>
        <div class="section__title">All My Transactions</div>
      </div>

      <div class="explore__tab mt-3 mb-3">
        <div class="container">
          <div class="navbar-nav flex-row justify-content-center filter-option">              
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container">
        <!-- <h5 class="leaderboard__name">All Transactions</h5> -->
        <div class="leaderboard__table">
        <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">Sl No</div>
            <div class="table__col">Name </div>
            <div class="table__col text-center">Tournament</div>
            <div class="table__col text-center">Amount</div>
            <div class="table__col text-center">Currency</div>
          </div>
        <?php $slno = 1; ?>
          @if($teams)
          @foreach($teams as $team)
          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">{{$slno}}</div>
            <div class="table__col">{{$team->fname}} {{$team->lname}} </div>
            <div class="table__col text-center">{{$team->tournaments}}</div>
            <div class="table__col text-center">{{$team->amount}}</div>
            <div class="table__col text-center">{{$team->cname}}</div>
          </div>
          <?php $slno = $slno + 1; ?>
         @endforeach
         @endif
          </div>
        </div>
      </div>

      <div class="clearfix p-5"></div>

      <!-- <div class="container">
        <p class="text-center">
          <a href="#" class="prev__btn"><span>Prev</span></a>
          <a href="#" class="next__btn"><span>Next</span></a>
        </p>
      </div> -->

    </section>
@endsection