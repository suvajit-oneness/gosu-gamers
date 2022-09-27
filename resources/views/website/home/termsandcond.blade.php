@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->
      <h2 class="text-center">Terms And Conditions</h2>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      
      <div class="container">
        <div class="row">
          <!-- <div class="col-12 text-center">
            <div class="section__title" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">Terms And Conditions</div>
          </div> -->
          <div class="col-sm-12 about__area mt-3">
            <p>{{$terms[0]->content}}</p>

         </div>
        </div>
        
      </div>

    </section>

@endsection