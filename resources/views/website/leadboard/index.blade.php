@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <!-- <img src="{!!asset('new-theme\images\site banner\LEADERBOARDS.jpg')!!}" class="img-fluid"> -->
      <h2 class="text-center">OUR LEADERBOARDS</h2>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      <div class="title__area text-center mb-3 mb-sm-0">
        <div class="section__subtitle">Latest Games</div>
        <div class="section__title">All New Games</div>
      </div>

      <div class="explore__tab mt-5 mb-5">
        <div class="container">
          <div class="navbar-nav flex-row justify-content-center filter-option">
            <a class="nav-item nav-link active" href="#" data-category="all">All</a>
            <a class="nav-item nav-link" href="#" data-category="game">FIFA</a>
            <a class="nav-item nav-link" href="#" data-category="game">RainBow 6 Siege</a>
            <a class="nav-item nav-link" href="#" data-category="game">Call of Duty</a>
            <a class="nav-item nav-link" href="#" data-category="game">FREE FIRE MAX</a>
            <a class="nav-item nav-link" href="#" data-category="game">DOTA 2</a>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="container">
        <!-- <h5 class="leaderboard__name">All Games</h5> -->
        <div class="leaderboard__table">
          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">1</div>
            <div class="table__col">John Doe</div>
            <div class="table__col text-center">6969</div>
            <div class="table__col text-right">India</div>
          </div>

          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">2</div>
            <div class="table__col">Luthar Hall</div>
            <div class="table__col text-center">6900</div>
            <div class="table__col text-right">UK</div>
          </div>

          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">3</div>
            <div class="table__col">Lorem Din</div>
            <div class="table__col text-center">6869</div>
            <div class="table__col text-right">India</div>
          </div>

          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">4</div>
            <div class="table__col">Luthar Doe</div>
            <div class="table__col text-center">6669</div>
            <div class="table__col text-right">USA</div>
          </div>

          <div class="table__row thead" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="table__col">5</div>
            <div class="table__col">John Doe</div>
            <div class="table__col text-center">6969</div>
            <div class="table__col text-right">India</div>
          </div>
        </div>
      </div>

    </section>
@endsection