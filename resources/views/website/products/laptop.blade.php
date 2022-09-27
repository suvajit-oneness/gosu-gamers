@extends("website.layouts.master")
@section("content")
  <section class="banner__area game inner">
    <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">
    <h2 class="text-center">GAMING LAPTOP</h2>

    <div class="news__ticker d-block aos-init aos-animate" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-delay="500"
      data-aos-duration="1000">
      <span>GAMING LAPTOP</span>
      <div id="carouselTicker" class="carouselTicker">
        <ul class="carouselTicker__list"></ul>
      </div>
    </div>
  </section>

  <section class="py-5 sponser_bg product-listing">
    <div class="container">
      <div class="row pt-4">
      @if($product)
      @foreach($product as $data)
        <div class="col-12 col-lg-3 col-sm-6 mb-3 mb-lg-4">
          <div class="card border-0 shadow-sm position-relative h-100">
          <img src="{{URL::asset($data->image)}}" style="width:100%;">
            <div class="card-body">
            <h3 class="text-center">
                <a href="{{ route('products.laptop-details',$data->id) }}">{{$data->title}}</a>
              </h3>
            </div>
            <a href="{{ route('products.laptop-details',$data->id) }}" class="buy_btn">More Details <i class="fas fa-arrow-right"></i></a>
            <div class="hover-div">
              <div class="row overflow-auto h-100">
                <div class="col-lg-12 p-0">
                  <div class="card border-0 p-2 h-100 overflow-auto">
                    <h5>Games</h5>
                    <ul>
                    @php
                    if ($data->game_id != '') {
                        $gamesData = substr($data->game_id, 0, -1);
                          $gamesListArr = explode(',', $gamesData);
                          foreach ($gamesListArr as $gamesListKey => $gamesListValue) {
                            $gameSalesData = \App\Models\GameSale::findOrFail($gamesListValue);
                            echo '<li><i class="fa fa-check"></i> '.$gameSalesData->name.'</li>';
                          }
                    }
                    @endphp
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      @endif
      </div>
      <div class="float-right">{!! $product->links() !!}</div>
    </div>
  </section>
@endsection