<footer>

      <div class="container">
        <div class="row justify-content-between">

          <div class="col-sm-4" data-aos="fade-right" data-aos-offset="0" data-aos-easing="ease-in-back" data-aos-duration="1000">
              <img src="{!!asset('letsgamenow/images/logo.png')!!}" class="img-foot">
              <!-- <h3 class="mt-3 mt-sm-0">CONTACT US</h3> -->
              <ul class="contact__list">
                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                <li><a href="mailto:gosugamerindia@gmail.com">gosugamerindia@gmail.com</a></li>
              </ul>
              <div class="left_bar_social">
                <ul class="mb-0 social_list">
                  <li class="facebook"><a target="_blank" href="https://www.facebook.com/gosugamersindia"><i class="fab fa-facebook-f"></i></a></li>
                  <li class="twitter"><a target="_blank" href="https://twitter.com/gosugamersindia"><i class="fab fa-twitter"></i></a></li>
                  <li class="instagram"><a target="_blank" href="https://www.instagram.com/gosugamersindia/"><i class="fab fa-instagram"></i></a></li>
                  <li class="linkedin"><a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                  <li class="youtube"><a target="_blank" href="https://www.youtube.com/GosuGamersIndia"><i class="fab fa-youtube"></i></a></li>
                </ul>
              </div>
          </div>

          <div class="col-sm-4" data-aos="fade-down" data-aos-offset="0" data-aos-easing="ease-in-back" data-aos-duration="1500">
            <h3 class="mt-3 mt-sm-0">Links</h3>
            <ul class="footer__links">
              <li><a href="{{route('home.about')}}">About</a></li>
              <li><a href="{{route('home.contact')}}">Contact Us</a></li>
              <li><a href="{{route('home.faqs')}}">FAQs</a></li>
              <li><a href="{{route('home.terms.conditions')}}">Terms & Conditions</a></li>
              <li><a href="{{route('home.privacy.policy')}}">Privacy Policy</a></li>
              <li><a href="{{route('home.refund.cancel')}}">Refund & Cancellation</a></li>
            </ul>
          </div>

          <div class="col-sm-4" data-aos="fade-left" data-aos-offset="0" data-aos-easing="ease-in-back" data-aos-duration="2000">
            <h3 class="mt-3 mt-sm-0">NEWSLETTER</h3>
            <p>Subsrcibe us now to get the latest news and updates</p>
            <div class="newsletter__form">
              <form>
                <div class="form-group clearfix">
                  <input type="email" name="email" value="" placeholder="Email address" required="">
                  <button type="submit" class="newsletter__btn"><span class="fas fa-envelope"></span></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="bottom__footer mt-2 pt-2 mt-sm-5 pt-sm-5">
        <p class="text-center">© 2022 Copyright: gosugamers.net</p>
      </div>

      <div class="discord-logo" data-toggle="modal" data-target="#discord-modal">
        <img src="{!!asset('letsgamenow/images/discord-logo.png')!!}" alt="">
      </div>
  
      <!-- Modal -->
      <div class="modal fade" id="discord-modal" tabindex="-1" role="dialog" aria-labelledby="discord-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body" style="background-color: #202225;">
                <div class="coming_div">
                  <img src="{!! asset('letsgamenow/images/logo.png') !!}" width="200px" style="margin-bottom: 30px;">
                  <p style="margin-bottom: -5px;font-size: 22px;">invited you to join</p>
                  <h1>Gosugamers</h1>
                  <a href="https://discord.com/invite/wN2grPdgHS" target="_blank" class="btn btn-primary" style="border-radius: inherit; padding: 6px 47px;">Connect</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </footer>