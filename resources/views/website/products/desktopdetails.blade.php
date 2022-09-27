@php
  $data = App\Models\Product::findOrFail($product->id);
  $data->view_counter += 1;
  $data->update();
@endphp
<!doctype html>
<html lang="en">
   <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/carouselTicker.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/slick.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/slick-theme.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/style.css?ver=1649238535')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/responsive.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('letsgamenow/css/main.css')!!}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>{{$product->title}}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta property="og:image" content="{{URL::asset($product->image)}}"/>
    <meta property="og:site_name" content="LetsGameNow"/>
    <meta property="og:title" content="{{$product->title}}" />
    <meta property="og:description" content="{{$product->title}}" />
    <meta property="og:type" content="{{URL::asset($product->image)}}">
    <style type="text/css">
      li{
        color: #fff;
      }
      .news_details_content{
        color: #fff !important;
      }
      .news_details_content p{
        color: #fff !important;
      }
      .tags .badge{
  	background-color: #4CAF50;
  	}
    </style>
  </head>
  <body>
   @include("website.layouts.sub-header")
    <section class="banner__area game inner">
      <img src="{!!asset('letsgamenow/images/game_details.jpg')!!}" class="img-fluid">
      <h2 class="text-center">{{$product->title}}</h2>
    </section>
    <section class="py-5 sponser_bg overflow_show product-details">
        <div class="container">
            <div class="row text-white">
                <div class="col-12 col-lg-5">
                  <img src="{{URL::asset($product->image)}}" style="width:100%; height:300px; object-fit: scale-down;">
                </div>
                <div class="col-12 col-lg-7">
                    <h2>
                    {{$product->title}}
                    </h2>
                    <div class="py-2 tags">
                      <h6>More than 30 FPS</h6>
                      @php
                    if ($data->game_id != '') {
                          $gamesData = substr($product->game_id, 0, -1);
                          $gamesListArr = explode(',', $gamesData);
                          foreach ($gamesListArr as $gamesListKey => $gamesListValue) {
                            $gameSalesData = \App\Models\GameSale::findOrFail($gamesListValue);
                            echo '<span class="badge">'.$gameSalesData->name.'</span> ';
                          }
                          }
                      @endphp
                    </div>
                      @php
                        if ($data->game_id_medium != '') {
                        @endphp
                        <div class="py-2 tags">
                          <h6>Below 30 FPS but over 10 FPS</h6>
                        @php
                          $gamesData = substr($product->game_id_medium, 0, -1);
                          $gamesListArr = explode(',', $gamesData);
                          foreach ($gamesListArr as $gamesListKey => $gamesListValue) {
                            $gameSalesData = \App\Models\GameSale::findOrFail($gamesListValue);
                            echo '<span class="badge bg-warning text-dark">'.$gameSalesData->name.'</span> ';
                          }
                        @endphp
                        </div>
                        @php
                        }
                        
                        if ($data->game_id_low != '') {
                        @endphp
                        <div class="py-2 tags">
                          <h6>Less than 10 FPS</h6>
                        @php
                          $gamesData = substr($product->game_id_low, 0, -1);
                          $gamesListArr = explode(',', $gamesData);
                          foreach ($gamesListArr as $gamesListKey => $gamesListValue) {
                            $gameSalesData = \App\Models\GameSale::findOrFail($gamesListValue);
                            echo '<span class="badge bg-danger">'.$gameSalesData->name.'</span> ';
                          }
                        @endphp
                        </div>
                        @php
                        }

                      $productCategoryData = \App\Models\product_category::findOrFail($product->product_category);
                    @endphp
                        <p>Category : {{$productCategoryData->name}}</p>
                    <p>
                    Specs : {{$product->product_space}}
                    </p>
                    <p>
                    Performance : {{$product->product_performance}}
                    </p>
                    <a href="javascript: void(0)" class="buy_btn" id="counter">Buy Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            </div>
           
        </div>
    </section>

    <section class="product-listing py-4 py-lg-5 sponser_bg">
    <div class="container">
            <div><h3 class="text-light">Related Products</h3></div>
            <div class="row pt-4">
            @php
              $relatedData = \App\Models\Product::where('product_category', 1)->take(16)->get();
            @endphp
              @foreach($relatedData as $ldata)
              <div class="col-12 col-lg-3 col-sm-6 mb-3 mb-lg-4">
                <div class="card border-0 shadow-sm position-relative h-100">
                <img src="{{URL::asset($ldata->image)}}" style="width:100%;">
                  <div class="card-body">
                  <h3 class="text-center">
                      <a href="{{ route('products.pc-details',$ldata->id) }}">{{$ldata->title}}</a>
                    </h3>
                  </div>
                  <a href="{{ route('products.pc-details',$ldata->id) }}" class="buy_btn">More Details <i class="fas fa-arrow-right"></i></a>
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
            </div>
            </div>
    </section>

    @include("website.layouts.footer")
   @include("website.layouts.scripts")
   @include('sweetalert::alert')
  </body>
  <script>
    $(document).ready(function(){ 
      $('#counter').click(function(){ 
        $.ajax({
          url : '{{ route("products.click-count") }}',
          method : 'POST',
          data : {
            '_token' : '{{csrf_token()}}',
            'productId' : '{{$data->id}}'
          },
          success : function(response) {
            // console.log(response);
            if (response.status == 200) {
              window.open(response.data);
            } else {
              alert(response.message);
            }
          }
        });
      });
    });
  </script>

</html>
