@extends("website.layouts.master")
@section("content")
    <section class="banner__area inner">
      <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->

      <h2 class="text-center">Refund And Cancellation</h2>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      
      <div class="container">
        <div class="row">
        
          <div class="col-sm-12 about__area mt-3">
            <p>{{strip_tags(html_entity_decode($refund[0]->content))}}</p>
         </div>
        </div>
        
      </div>

    </section>

@endsection