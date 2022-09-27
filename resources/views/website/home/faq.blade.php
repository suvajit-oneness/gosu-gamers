

@extends("website.layouts.master")
@section("content")
<section class="banner__area inner">
  <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Refund And Cancellation</h2>
</section>
<section class="sponser_bg pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section__title text-center mb-sm-5 mb-3" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">FAQs</div>
      </div>
     
      <div class="col-sm-12 about__area mt-3">
      @foreach($faqs as $faq)
        <div class="accordion_wrapper">
          <h3 class="accordian_heading">{{strip_tags(html_entity_decode($faq->question))}}</h3>
          <div class="accordian_content">
            <p>{{strip_tags(html_entity_decode($faq->answer))}}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

</section>
@endsection

