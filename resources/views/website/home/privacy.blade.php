@extends("website.layouts.master")
@section("content")
<section class="banner__area inner">
  <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Privacy Policy</h2>
</section>
<section class="sponser_bg pt-5 pb-5">
  <div class="container">
    <div class="row">
      <!-- <div class="col-12 text-center">
        <div class="section__title" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">Privacy And Policy</div>
      </div> -->
      <div class="col-sm-12 about__area mt-3">
        {{strip_tags(html_entity_decode($privacy[0]->content))}}
      </div>
    </div>
  </div>
</section>
@endsection

