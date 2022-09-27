@extends("website.layouts.master")
@section("content")
    <section class="banner__area game inner">
      {{-- <img src="{!!asset('new-theme\images\site banner\news.jpg')!!}" class="img-fluid"> --}}
      <h2 class="text-center">News</h2>
    </section>
    <section class="sponser_bg pt-5 pb-5 inner_body_bg">
      <!-- <div class="title__area mb-3 text-center">
        <div class="section__title">TOURNAMENTS</div>
        <div class="section__subtitle">Game Details</div>
      </div> -->
      <div class="explore__tab mt-3 mb-5">
        <div class="container">
          <?php
            $url_pos = (Request::segment(2)!=null && Request::segment(2)!='')?Request::segment(2):0;
            ?>
          <div class="navbar-nav flex-row justify-content-center filter-option">
            <a class="nav-item nav-link <?php if($url_pos==0){echo "active";} ?>" href="{!! URL::to('site-news') !!}" data-category="all">All</a>
            @foreach($news_categories as $news_category)
            <?php $key1 = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $news_category->name)); ?>
            <a class="nav-item nav-link <?php if($url_pos==$news_category->id){echo "active";} ?>" href="{!! URL::to('news-sorting/'.$news_category->id.'/'.$key1) !!}" data-category="news_category{{$news_category->id}}">{{$news_category->name}}</a>
            @endforeach
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="container">
        <ul class="tournament_list news_list big">
          @foreach($news as $data)
          <?php $key = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $data->title)); 
          $data = App\Models\News::findOrFail($data->id);
          $data->view_count += 1;
          $data->update();
          ?>
          <li data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="news__blocks">
              <div class="news__blocks_img">
                <a class="d-block counter" data-id="{{$data->id}}" href="{!! URL::to('news-details/'.$data->id.'/'.$key) !!}"><img src="{{URL::asset($data->image)}}" alt=""></a>
              </div>
              <div class="news__blocks__body">
                <a class="mb-2 counter limiter" data-id="{{$data->id}}" href="{!! URL::to('news-details/'.$data->id.'/'.$key) !!}">{{$data->title}}</a>
                <span class="d-block">{{date("M, d.Y",strtotime($data->post_date))}}</span>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="d-flex justify-content-end">
          {{ $news->links() }}
        </div>
      </div>
    </section>
    @include("website.layouts.scripts")
    <script>
      $(document).ready(function(){ 
        $('.counter').click(function(){ 
          var newsId = $(this).data('id');
          $.ajax({
            url : '{{ route("news.count") }}',
            method : 'POST',
            data : {
              '_token' : '{{csrf_token()}}',
              'newsId' : newsId
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
@endsection