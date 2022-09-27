@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">

      <h2 class="text-center">Data Deletion Instruction</h2>

      <div class="news__ticker">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-primary">Strategy</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-success">Shooter</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-danger">Adventure</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-warning">RPG</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-info">Racing</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
                </li>
            </ul>
        </div>
      </div>
    </section>
@endsection