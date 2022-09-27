@if(Auth::guard('gamer')->check())
    @php $user ?? '' =Auth::guard('gamer')->user(); @endphp
@endif

<!doctype html>
<html lang="en">
  @include("website.layouts.header")
  <body>
  {{--include styles--}}
   @include("website.layouts.sub-header")   

    <section class="banner__area inner">
      <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">
               
      <h2 class="text-center">Profile</h2>

           <div class="news__ticker" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-delay="500" data-aos-duration="1000">
        <span>Upcoming Tournaments</span>
        <div id="carouselTicker" class="carouselTicker">
            <ul class="carouselTicker__list">
                @foreach($upcoming_tournaments as $upcoming_tournament)
                <li class="carouselTicker__item">
                    <a href="" class="ticker_cat bg-primary">{{$upcoming_tournament->game_name}}</a><a href="#">{{$upcoming_tournament->name}} is starting from {{date("M.d.Y",strtotime($upcoming_tournament->start_date))}}. Register today to participate.</a>
                </li>
              @endforeach
            </ul>
        </div>
      </div>
    </section>

    <section class="sponser_bg pt-5 pb-5">      
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-4 col-md-4">
            <div class="profile_picture_wrap mb-4">
              <div class="profile_picture">
                <img class="img-fluid" src="{{URL::asset($user ?? ''->image)}}">
              </div>
            </div>
          </div>

          <div class="col-xl-6 col-lg-7 col-md-8 col-12">
            <div class="profile_details">
              <h3 class="mb-4">  @foreach($teams as $team)
              @if($team->gamer_id == $user ?? ''->id)
             {{ $team->team_name }}
              @endif
              @endforeach<a href="{{route('gamer.edit')}}">Edit <i class="fas fa-edit"></i></a></h3>
              <ul class="mb-3">
                <li><i class="fas fa-calendar"></i> Member Since  {{substr($user ?? ''->created_at,0,10)}}</li>
                <li><i class="fas fa-map-marker-alt"></i> 
                @foreach($country as $coun)
                @if($coun->id == $user ?? ''->country_id)
                  {{$coun->name}}
                @endif
                @endforeach
                </li>
                <li><i class="fas fa-envelope"></i> {{$user ?? ''->email}}</li>
                <li><i class="fas fa-mobile"></i> {{$user ?? ''->mobile}}</li>
              </ul>
              <div class="d-flex justify-content-between mb-3">                
                <div class="add_game_id"><a href="{{route('mytournament',$user ?? ''->id)}}">Show My Tournament</a></div>
                <div class="add_game_id"><a href="{{route('tournamentwon',$user ?? ''->id)}}">Won Tournament</a></div>
                <div class="add_game_id"><a href="{{route('mytransactions',$user ?? ''->id)}}">My Transactions</a></div>
              </div>
              @if(Session::has('message'))
            <!--<div class="alert {{ Session::get('alert-class', 'alert-info') }}">-->
            <!--    <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>-->
            <!--    {{ Session::get('message') }}-->
            <!--</div>-->
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
              {{ Session::get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
              <div class="d-flex justify-content-between mb-3">
                <div class="add_game_id"><a data-toggle="modal" data-target="#addTeamMember" href="#addTeamMember">Add Team Member</a></div>
                <div class="add_game_id"><a data-toggle="modal" data-target="#addGameId" href="#addGameId">Add Game ID</a>  
                 (Ingame name for Captain) </div> 
              </div>
             </div>
          </div>
        </div>

        <div class="row align-items-center justify-content-between feature_area mb-5">
          <div class="col-sm-4 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <img src="{!!asset('letsgamenow/images/rank.png')!!}">
            <h4>511</h4>
            <a href="#" class="red__btn">OVERALL RANK</a>
          </div>
          <div class="col-sm-4 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <img src="{!!asset('letsgamenow/images/earnings.png')!!}">
            <h4>N/A</h4>
            <a href="#" class="white__btn">EARNINGS</a>
          </div>
          <div class="col-sm-4 text-center" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <img src="{!!asset('letsgamenow/images/log_point.png')!!}">
            <h4>N/A</h4>
            <a href="#" class="white__btn">LGN POINTS</a>
          </div>
        </div>
       @if($user ?? ''->gamer_type==1)
        <!-- Team List -->
        <div class="team__member__list__table">
          <div class="table-responive">
            <table class="table">
              <tr>
                <th width="5%">#</th>
                <th width="20%">Name</th>
                <th width="20%">Email</th>
                <th width="20%">Mobile</th>
                <th width="20%">Platform</th>
                <th width="20%">InGame Name</th>
                <th width="20%">IGame Id</th>
              </tr>
              <?php $slno = 1; ?>
              @if($gamerplatfromdetails)
               @foreach($gamerplatfromdetails as $data)
              <tr>
                <td>{{$slno}}</td>
                <td>{{$user ?? ''->fname}}{{ $user ?? ''->lname }}</td>
                <td>{{$user ?? ''->email}}</td>
                <td>{{$user ?? ''->mobile}}</td>
                <td>{{$data->pfname}}</td>
                <td>{{$data->ingame_name}}</td>
                <td>{{$data->platfrom_number}}</td>
               </tr>
              <?php $slno = $slno + 1; ?>    
               @endforeach
               @endif
              
            </table>
          </div>
        </div>
      @endif
 @if($user ?? ''->gamer_type==2)
        <!-- Team List -->
        <div class="team__member__list__table">
          <div class="table-responive">
            <table class="table">
              <tr>
                <th width="5%">#</th>
                <th width="20%">Name</th>
                <th width="30%">Email</th>
                <th width="20%">Mobile</th>
                <th width="20%">InGame Name</th>
                <th width="20%">IGame Id</th>
                <th class="text-center" width="10%">Edit</th>
                <th class="text-center" width="10%">Delete</th>
              </tr>
              <?php $slno = 1; ?>
              @if($teamplayer)
               @foreach($teamplayer as $data)
              <tr>
                <td>{{$slno}}</td>
                <td>{{$data->tpname}}</td>
                <td>{{$data->tpemail}}</td>
                <td>{{$data->phone_no}}</td>
                <td>{{$data->ingame_name}}</td>
                <td>{{$data->ingame_id}}</td>
                 <td><a data-toggle="modal"class="edit__team__member" data-target="#updateTeamMember{{$data->tpid}}" href="#addTeamMember"><i class="fas fa-edit"></i></a></td>
                <td class="text-center"><a href="javascript:void(0)" class="edit__team__member btn-delete-submit" data-id="{{ $data->tpid }}" ><i class="fas fa-trash"></i></a></td> 
              </tr>
              <?php $slno = $slno + 1; ?>    
               @endforeach
               @endif
              
            </table>
          </div>
        </div>
      @endif
      </div>
    </section>

  @if($teamplayer)
  @foreach($teamplayer as $data)
    <!-- Modal -->
    <div class="modal fade addGameId_modal" id="updateTeamMember{{$data->tpid}}" tabindex="-1" role="dialog" aria-labelledby="addTeamMember" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Team Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post"action="{{route('updateteamplayer')}}">
            @csrf              
              <div class="upadate_field add_game_field mb-3">
                <input type="text" class="form-control" required="required" placeholder="Name" type="text" name="playername" value="{{$data->tpname}}">
              </div>
              <div class="upadate_field add_game_field mb-3">
                <input type="email" class="form-control" placeholder="Email" required="required" type="text" name="playeremail" value="{{$data->tpemail}}">
              </div>
              <div class="upadate_field add_game_field mb-3">
                <input type="number" class="form-control" placeholder="Mobile No." required="required" type="text" name="playermobile" value="{{$data->phone_no}}">
              </div>
              <div class="upadate_field add_game_field mb-3">
                <select class="form-control" name='platform_id'>
                  <option value="0">Select Platform</option>
                  @foreach($platforms as $plat)
                  <option value="{{$plat->id}}" <?php if($plat->id==$data->platform_id){ echo "selected";} ?>>{{$plat->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="upadate_field add_game_field mb-3">
                
              <input class="form-control" placeholder="Enter Player InGame Name" type="text" name="platfromname" value="{{$data->ingame_name}}">
              </div>
               <input type="hidden" name='tpid' value="{{$data->tpid}}" >
              <div class="upadate_field add_game_field mb-3">
                
                <input class="form-control" placeholder="Enter Player Game ID" type="text" name="platfromnumber" value="{{$data->ingame_id}}">
              </div>
              <div class="upadate_field add_game_field">
                <input class="add_game_id_submit" type="submit" value="Save"  name="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  @endif
    <footer>
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-sm-4" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">
            <div class="row justify-content-between align-items-center">
              <div class="col-sm-7">
                <h3>CONTACT US</h3>
                <ul class="contact__list">
                  <li>5001 BEACH ROAD #08-11 GOLDEN MILE COMPLEX, Singapore 199588</li>
                  <li><a href="mailto:info@letsgamenow.com">info@letsgamenow.com</a></li>
                </ul>
              </div>
              <div class="col-sm-5">
                <img src="{!!asset('letsgamenow/images/logo.png')!!}" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="col-sm-4" data-aos="fade-down" data-aos-easing="ease-in-back" data-aos-duration="1500">
            <h3>Links</h3>
            <ul class="footer__links">
              <li><a href="{{route('home.about')}}">About</a></li>
              <li><a href="{{route('home.contact')}}">Contact Us</a></li>
              <li><a href="{{route('home.faqs')}}">FAQs</a></li>
              <li><a href="{{route('home.terms.conditions')}}">Terms & Conditions</a></li>
              <li><a href="{{route('home.privacy.policy')}}">Privacy Policy</a></li>
              <li><a href="{{route('home.refund.cancel')}}">Refund & Cancellation</a></li>
            </ul>
          </div>
          <div class="col-sm-4" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="2000">
            <h3>NEWSLETTER</h3>
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

      <div class="bottom__footer mt-5 pt-5 pb-5">
        <p class="text-center">© 2019 Copyright: Letsgamenow.com</p>
      </div>
    </footer>

    <div class="left_bar_social">
<ul class="mb-0 social_list">
<li class="facebook"><a target="_blanck" href="https://www.facebook.com/lgnindia"><i class="fab fa-facebook-f"></i></a></li>
<li class="twitter"><a target="_blanck" href="https://twitter.com/lets_game_now"><i class="fab fa-twitter"></i></a></li>
<li class="instagram"><a target="_blanck" href="https://instagram.com/lets_game_now"><i class="fab fa-instagram"></i></a></li>
<li class="linkedin"><a target="_blanck" href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
<li class="youtube"><a target="_blanck" href="https://youtube.com"><i class="fab fa-youtube"></i></a></li>
</ul>
<!-- <a class="sharethis_btn" href="#"><i class="ti-sharethis"></i></a> -->
</div>

    <!-- Modal -->
    <div class="modal fade addGameId_modal" id="addGameId" tabindex="-1" role="dialog" aria-labelledby="addGameId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Game ID</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{route('gamerplatfrom.store')}}">
              @csrf
              <div class="upadate_field add_game_field mb-3">
                <select class="form-control" name='platform_id'>
                  <option value="0">Select Option</option>
                  @foreach($platforms as $plat)
                  <option value="{{$plat->id}}">{{$plat->name}}</option>
                  @endforeach
                </select>
              </div>
              <input type="hidden" name='gamer_id' value="{{$user ?? ''->id}}">
              <div class="upadate_field add_game_field mb-3">
                
                <input class="form-control" placeholder="Enter Your InGame Name" type="text" name="platfromname">
                </div>
              <div class="upadate_field add_game_field mb-3">
                
                <input class="form-control" placeholder="Enter Your Game ID" type="text" name="platfromnumber">
              </div>
              <div class="upadate_field add_game_field">
                <input class="add_game_id_submit" type="submit" value="Save" name="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal -->
    <div class="modal fade addGameId_modal" id="addTeamMember" tabindex="-1" role="dialog" aria-labelledby="addTeamMember" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        @if($user ?? ''->gamer_type==1)
          <div class="modal-header">          
            <h5 class="modal-title" id="exampleModalLongTitle">To Team Member You have to Name your Team</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">          
            <form method="post"action="{{route('team.register.submit')}}">
            @csrf              
              <div class="upadate_field add_game_field mb-3">
                <input type="text" class="form-control" required="required" placeholder="Team Name" type="text" name="team_name">
              </div>
              <div class="upadate_field add_game_field mb-3">
                <select class="form-control" name='platform_id'>
                  <option value="0">Select Platform</option>
                  @foreach($platforms as $plat)
                  <option value="{{$plat->id}}">{{$plat->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="upadate_field add_game_field mb-3">                
              <input class="form-control" placeholder="Enter Player InGame Name" type="text" name="ingame_name">
              </div>
              <div class="upadate_field add_game_field mb-3">                
                <input class="form-control" placeholder="Enter Player Game ID" type="text" name="ingame_id">
              </div>
              <input type="hidden" name='gamer_id' value="{{$user ?? ''->id}}">
              <div class="upadate_field add_game_field">
                <input class="add_game_id_submit" type="submit" value="Save"  name="Submit">
              </div>
            </form>
          </div>
          @endif
          @if($user ?? ''->gamer_type==2)
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Team Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">          
            <form method="post"action="{{route('addteamplayer')}}">
            @csrf              
              <div class="upadate_field add_game_field mb-3">
                <input type="text" class="form-control" required="required" placeholder="Name" type="text" name="playername">
              </div>
              <div class="upadate_field add_game_field mb-3">
                <input type="email" class="form-control" placeholder="Email" required="required" type="text" name="playeremail">
              </div>
              <div class="upadate_field add_game_field mb-3">
                <input type="number" class="form-control" placeholder="Mobile No." required="required" type="text" name="playermobile">
              </div>
              <div class="upadate_field add_game_field mb-3">
                <select class="form-control" name='platform_id'>
                  <option value="0">Select Platform</option>
                  @foreach($platforms as $plat)
                  <option value="{{$plat->id}}">{{$plat->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="upadate_field add_game_field mb-3">
                
              <input class="form-control" placeholder="Enter Player InGame Name" type="text" name="platfromname">
              </div>
              <div class="upadate_field add_game_field mb-3">
                
                <input class="form-control" placeholder="Enter Player Game ID" type="text" name="platfromnumber">
              </div>
              @foreach($teams as $team)
              @if($team->gamer_id == $user ?? ''->id)
              <input type="hidden" name='team_id' value="{{$team->id}}">
              @endif
              @endforeach
              <div class="upadate_field add_game_field">
                <input class="add_game_id_submit" type="submit" value="Save"  name="Submit">
              </div>
            </form>
          </div>
          @endif  
        </div>
      </div>
    </div>    

    @include("website.layouts.scripts")

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    $(function () {
        $(document).on("click", ".btn-delete-submit", function () {
                var id = $(this).attr("data-id"); 
                var postdata = {
                    "_token": "{{ csrf_token() }}",
                    "id": id, }
                    swal({
                           title: "Are you sure?",
                           text: "Do you want to Delete this Player from you Team",
                           showCancelButton: true,
                           confirmButtonClass: "btn-danger",
                           confirmButtonText: "Yes, do!",
                           closeOnConfirm: false
                           },
                  function(){
                $.post("{{ route('deleteteamplayer') }}", postdata, function (response) {
                    var data = $.parseJSON(response);
                     if (data.status == 1) {
                      swal(data.message);
                        location.reload();
                    } else {
                        swal(data.message);
                    }
                })
            })
        });
    });
</script>



  </body>
</html>
