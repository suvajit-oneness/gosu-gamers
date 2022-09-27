@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <!-- <img src="{!!asset('new-theme\images\site banner\LEADERBOARDS.jpg')!!}" class="img-fluid"> -->

      <h2 class="text-center">OUR LEADERBOARDS</h2>

      <div class="news__ticker">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                
            </ul>
        </div>
      </div>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      <div class="title__area text-center">
        <div class="section__subtitle">Tournament</div>
        <div class="section__title">Won Tournament</div>
      </div>

      <div class="explore__tab mt-3 mb-3">
        <div class="container">
          <div class="navbar-nav flex-row justify-content-center filter-option">              
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container">
        <!-- <h5 class="leaderboard__name">Won Tournament</h5> -->
        <div class="leaderboard__table">
        <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">Sl No</div>
            <div class="table__col">Name </div>
            <div class="table__col text-center">Tournament</div>
          
          </div>
        <?php $slno = 1; ?>
          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">1</div>
            <div class="table__col">John Doe</div>
            <div class="table__col text-center">LUDO KING WEEKLY TOURNAMENT</div>
            </div>
          <?php $slno = $slno + 1; ?>
          
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