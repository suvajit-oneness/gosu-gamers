<!doctype html>
<html lang="en">
  <head>
     {{--include styles--}}
  @include("website.layouts.header")
  </head>
  <body>
  {{--include Header--}}
   @include("website.layouts.sub-header")


    <section class="banner__area inner">
      <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->
      <h2 class="text-center">Contact Us</h2>
    </section>

    <section class="sponser_bg pt-5 pb-5">
      
      <div class="container">
        <div class="title__area mb-5 text-center">
          <div class="section__subtitle">Find Us!</div>
          <div class="section__title" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">Get In Touch</div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-6 about__area" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1500">
            <ul class="address__list">
              <li>
                <span><i class="fas fa-map-marker-alt"></i></span>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </li>
              <li>
                <span><i class="far fa-envelope"></i></span>
                <p>gosugamerindia@gmail.com</p>
              </li>
            </ul>
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3988.786966921965!2d103.86290226455561!3d1.302789299049799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s5001%20BEACH%20ROAD%20%2308-11%20GOLDEN%20MILE%20COMPLEX%20Singapore%20199588!5e0!3m2!1sen!2sin!4v1578383459546!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe> --}}
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d471218.3856170605!2d88.04953593118717!3d22.67638575113144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1663842906036!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="col-sm-6" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1500">
            <form class="contact__form">
              <div class="form-group upadate_field custom_layout">
                <label for="">Enter Your Name</label>
                <input type="text" name="name" value="" placeholder="Your Name" required="">
                <button type="button" class=""><span class="fas fa-user"></span></button>
              </div>

              <div class="form-group upadate_field custom_layout">
                <label for="">Enter Your Email Address</label>
                <input type="email" name="email" value="" placeholder="Email address" required="">
                <button type="button" class=""><span class="fas fa-envelope"></span></button>
              </div>

              <div class="form-group upadate_field custom_layout">
                <label for="">Enter Your Contact No</label>
                <input type="tel" name="phone" value="" placeholder="Contact No." required="">
                <button type="button" class=""><span class="fas fa-phone-alt"></span></button>
              </div>

              <div class="form-group upadate_field custom_layout">
                <label for="">Enter Your Message</label>
                <textarea name="message" placeholder="Message" required=""></textarea>
                <button type="button" class=""><span class="fas fa-comment-alt"></span></button>
              </div>

              <div class="form-group">
                <button type="submit" class="">Submit Now</button>
              </div>
            </form>
          </div>
        </div>
        
      </div>

    </section>

 {{--include styles--}}
   @include("website.layouts.footer")
   @include("website.layouts.scripts")


  </body>
</html>