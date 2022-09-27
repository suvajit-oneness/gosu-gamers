@if (Auth::guard('gamer')->check())
   @php
  $today = date('Y-d-m');
   
   $userId = Auth::guard('gamer')->user()->id;
   @endphp
   @if(Auth::guard('gamer')->user()->gamer_type == 1)
 
      @php $user ="gamer"; @endphp
   @elseif(Auth::guard('gamer')->user()->gamer_type == 2)
      @php $user ="team"; @endphp
   @endif
@endif
@extends("website.layouts.master")
@section("content")
<style type="text/css">
   table{
      color: #fff;
   }
   .modal_input{
      display: flex;
      flex-wrap: wrap;
      width: 100%;
   }
   .modal_input .add_game_field{
      width: calc((100% - 5px) / 5);
   }
   .modal_input .upadate_field{
      text-align: center;
   }
   .modal_input .upadate_field input{
      text-align: center;
   }
</style>
<section class="banner__area game inner">
   <img src="{!!asset('letsgamenow/images/game_details.jpg')!!}" class="img-fluid">
   <h2 class="text-center">{{$tournaments->name}}</h2>
   <input type="hidden" id="tid" value="{{ $tournaments->id }}">
</section>
<section class="extradark_bg overflow_show pt-5 pb-5">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 game_banner mb-5">
            <img  data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" src="{{URL::asset($tournaments->image)}}" class="img-fluid">
            <div class="game__details_area mb-5 ">
               <div class="row align-items-center">
                  <div class="col-sm-7">
                     <div class="clearfix"></div>
            <!-- AddToAny BEGIN -->
            <div class="news_details_content">
              <p></p>
              <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
              <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
              <a class="a2a_button_whatsapp"></a>
              <a class="a2a_button_facebook"></a>
              <a class="a2a_button_twitter"></a>
              <a class="a2a_button_pinterest"></a>
              <a class="a2a_button_linkedin"></a>
              <a class="a2a_button_google_gmail"></a>
              </div>
              <script async src="https://static.addtoany.com/menu/page.js"></script>
              <!-- AddToAny END -->
            </div>
                  </div>
                  <div class="col-sm-5 text-right ">
                     @if($tournaments->stop_joining==0)
                     @if(Auth::guard('gamer')->check() )
                     <!-- <a href="javascript:void(0)" class="register__btn btn-register-submit" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1000" data-id="{{request()->route()->id}}" gamer_id="{{Auth::guard('gamer')->user()->id}}" gamer_type="{{$user}}"
                        >Register</a> -->  
                     <!-- <a href="#" class="play__btn" data-aos="fade-right" data-aos-easing="ease-in-back" data-aos-duration="1000">Lets Play</a> -->
                     @endif @endif
                  </div>
               </div>
               <hr>
               <div class="row align-items-center justify-content-between game__details">
                 
                  <div class="col-sm-5">
                     <div class="row">
                        <div class="col border-right">
                           <h5>Registration</h5>
                           <p>{{$tournaments->reg_start_date}}</p>
                        </div>
                        <div class="col border-right">
                           <h5>@if($platform)
                              @foreach($platform as $pl)
                              {{rtrim($pl->name,',') }} 
                              @endforeach
                              @endif
                           </h5>
                           <p>{{$tournaments->max_players}} PLAYERS</p>
                        </div>
                        <div class="col">
                           <h5>Winner</h5>
                           <p>{{$tournaments->prize_money}}</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <div class="row align-items-center justify-content-between feature_area" style="margin-bottom: 60px;">
               <div class="col-sm-3 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/calendar.png')!!}">
                  <h4>{{$tournaments->start_date}}</h4>
                  @if(Auth::guard('gamer')->check() )
                     <a  data-toggle="modal" data-target="#jointurnament_modal" href="#jointurnament_modal" class="red__btn">JOIN</a>
                  @else
                  <a href="https://letsgamenow.com/home/otplogin" class="red__btn">JOIN</a>
                  @endif
               </div>
               <div class="col-sm-3 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/success.png')!!}">
                  <h4>{{$tournaments->prize_money}} INR</h4>
                  <a href="#" class="white__btn">RULES</a>
               </div>
               @if( $tournaments->tournament_type==2)
               <div class="col-sm-3 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/group.png')!!}">
                  <h4>{{$playerjoined[0]->tournament_id}} / {{$tournaments->max_players}}</h4>
                  <a href="{{route('fixture',request()->route()->id)}}" class="white__btn">FIXTURE</a>
               </div>
               @endif

               <div class="col-sm-3 text-center" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/success.png')!!}">
                  @if(!$winner=='')
                    <h4> @foreach($winner as $win)
                    {{$win->room_code}} {{$win->name}}
                  @endforeach</h4> 
                  @else  
                  <h4>Winner is not yet Declare</h4>
                  @endif                 
                  <div class="white__btn">Winner</div> 
               </div>
            </div>
            <div class="clearfix"></div>
            <div class="tournament_area mb-5">
               <div class="row">

                  <div class="col-sm-6" style="color: #fff;">
                    
                     <h4>About the Tournament</h4>
                     <p>{!!$tournaments->description!!}</p>
                     <h4>Rules</h4>           
                  <p>{!!$tournaments->rulesdescription!!}</p>
                     
                     <p>FOR ANY ISSUE CONTACT US ON CHAT WE ARE AVAILABLE 24/7</p>
                  </div>
                  <div class="col-sm-6" data-aos="fade-left" data-aos-easing="ease-in-back" data-aos-duration="1000">
                     <h5 class="leaderboard__name">Leaderboard</h5>
                     <div class="leaderboard__table">
                        <div class="table__row thead">
                           <div class="table__col">PLACEMENT</div>
                           <div class="table__col text-right">POINTS</div>
                        </div>
                        @if($tournaments->user_type == 1)
                           @if($leaderboard)
                              @foreach($leaderboard as $leader)
                              <div class="table__row">
                                 <div class="table__col">{{$leader->fname}} {{$leader->lname}}</div>
                                 <div class="table__col text-right">{{$leader->user_point}}</div>
                              </div>
                              @endforeach
                           @endif
                        @elseif($tournaments->user_type == 2)
                           @if($teamleaderboard)
                              @foreach($teamleaderboard as $leader)
                              <div class="table__row">
                                 <div class="table__col">{{$leader->team_name}} </div>
                                 <div class="table__col text-right">{{$leader->user_point}}</div>
                              </div>
                              @endforeach
                           @endif
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            {{-- <!-- <div class="row align-items-center justify-content-between feature_area">
               <div class="col-sm-3 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/calendar.png')!!}">
                  <h4>{{$tournaments->start_date}}</h4>
                  @if(Auth::guard('gamer')->check() )
                  <a  data-toggle="modal" data-target="#jointurnament_modal" href="#jointurnament_modal" class="red__btn">JOIN</a> @endif
               </div>
               <div class="col-sm-3 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/success.png')!!}">
                  <h4>{{$tournaments->prize_money}} INR</h4>
                  <a href="#" class="white__btn">RULES</a>
               </div>
               @if($tournaments->game_id==1)
               <div class="col-sm-3 text-center border-right" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/group.png')!!}">
                  <h4>{{$playerjoined[0]->tournament_id}} / {{$tournaments->max_players}}</h4>
                  <a href="{{route('fixture',request()->route()->id)}}" class="white__btn">FIXTURE</a>
               </div>
               @endif
               <div class="col-sm-3 text-center" data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000">
                  <img src="{!!asset('letsgamenow/images/success.png')!!}">
                  @if(!$winner=='')
                    <h4> @foreach($winner as $win)
                    {{$win->room_code}} {{$win->name}}
                  @endforeach</h4> 
                  @else  
                  <h4>Winner is not yet Declare</h4>
                  @endif                 
                  <div class="white__btn">Winner</div> 
               </div>
            </div> --> --}}
         </div>
      </div>
   </div>
</section>
@if(Auth::guard('gamer')->check() )    
   {{-- @if($user == "gamer" )
      <!-- Modal -->
      <div class="modal fade addGameId_modal jointurnament_modal" id="joinTurnament_modal" tabindex="-1" role="dialog" aria-labelledby="joinTurnament_modal" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Join Tournament</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form method="post" action="{{route('gameringameidsave')}}">
                     @csrf
                     <input  type="hidden" value="{{$user}}" name="gamer_type" id="gamer_type">
                     <input  type="hidden" name="gamer_id" id="gamer_id" value="{{Auth::guard('gamer')->user()->id}}"> 
                     
                     <div class="upadate_field add_game_field mb-3">
                        <input class="form-control" placeholder="In Game Name" type="text" name="Ingame Name" id="ingame_name">
                     </div>
                     @if($tournaments->game_id==2)
                     <div class="upadate_field add_game_field mb-3">
                        <input class="form-control" placeholder="In Game Id" type="text" name="Ingame Id" id="ingame_id">
                     </div>
                     @else
                        <div class="upadate_field add_game_field mb-3">
                           <input class="form-control"
                              @if($tournaments->ps_number==1)
                              placeholder="IN Game ID"
                              @elseif($tournaments->ps_number==3)
                              placeholder="IN Game ID"
                              @elseif($tournaments->ps_number==2)
                              placeholder="PSN ID"
                              @elseif($tournaments->ps_number==4)
                              placeholder="Steam ID"
                              @else
                              placeholder="Origin ID"
                           @endif type="text" name="ingame_id" id="ingame_id">
                        </div>
                     @endif
                     <div class="upadate_field add_game_field">
                        <input class="add_game_id_submit" type="button" id="joinGame" value="Submit" name="" data-id="{{request()->route()->id}}">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   @endif
   @if($user == "team" ) --}}
      @if($tournaments->user_type==1)
      <!-- Modal -->
         <div class="modal fade addGameId_modal jointurnament_modal" id="joinTurnament_modal" tabindex="-1" role="dialog" aria-labelledby="joinTurnament_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Join Tournament</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form method="post" action="{{route('gameringameidsave')}}">
                        @csrf
                        <input  type="hidden" value="{{$user}}" name="gamer_type" id="gamer_type">
                        <input  type="hidden" name="gamer_id" id="gamer_id" value="{{Auth::guard('gamer')->user()->id}}"> 
                        
                        <div class="upadate_field add_game_field mb-3">
                           <input class="form-control" placeholder="In Game Name" type="text" name="Ingame Name" id="ingame_name">
                        </div>
                        @if($tournaments->game_id==2)
                        <div class="upadate_field add_game_field mb-3">
                           <input class="form-control" placeholder="In Game Id" type="text" name="Ingame Id" id="ingame_id">
                        </div>
                        @else
                           <div class="upadate_field add_game_field mb-3">
                              <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif type="text" name="ingame_id" id="ingame_id">
                           </div>
                        @endif
                        <div class="upadate_field add_game_field">
                           <input class="add_game_id_submit" type="button" id="joinGame" value="Submit" name="" data-id="{{request()->route()->id}}">
                        </div>
                        
                     </form>
                     
                  </div>
               </div>
            </div>
         </div>
      @elseif($tournaments->user_type==2)
         <!-- Modal -->  
         <div class="modal fade addGameId_modal jointurnament_modal" id="joinTurnament_modal" tabindex="-1" role="dialog" aria-labelledby="joinTurnament_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Join Tournament</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form method="post" action="{{route('gameringameidsave')}}">
                        @csrf
                        <input  type="hidden" value="{{$user}}" name="gamer_type" id="gamer_type">
                        <input  type="hidden" name="gamer_id" id="gamer_id" value="{{Auth::guard('gamer')->user()->id}}">      
                        {{-- @if($tournaments->game_id==2 ||$tournaments->game_id==4||$tournaments->game_id==17 ||$tournaments->game_id==18 ||$tournaments->game_id==5)
                           <div class="row">
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Name</label>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Ingame Name</label>
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">ID</label>
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Email</label>
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Mobile</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid0" @if(isset($teamplayers[0]->tpid)) value="{{$teamplayers[0]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="player_name" type="text" name="Player Name" id="player_name0" @if(isset($teamplayers[0]->name)) value="{{$teamplayers[0]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[0]->ingame_name)) value="{{ $teamplayers[0]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name0">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[0]->ingame_id)) value="{{ $teamplayers[0]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id0">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[0]->email)) value="{{ $teamplayers[0]->email }}"  @endif type="text" name="player_email" id="player_email0">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[0]->phone_no)) value="{{ $teamplayers[0]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone0">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid1" @if(isset($teamplayers[1]->tpid)) value="{{$teamplayers[1]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name0" @if(isset($teamplayers[1]->name)) value="{{$teamplayers[1]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[1]->ingame_name)) value="{{ $teamplayers[1]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name1">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[1]->ingame_id)) value="{{ $teamplayers[1]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id1">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[1]->email)) value="{{ $teamplayers[1]->email }}"  @endif type="text" name="player_email" id="player_email1">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[1]->phone_no)) value="{{ $teamplayers[1]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone1">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid2" @if(isset($teamplayers[2]->tpid)) value="{{$teamplayers[2]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name2" @if(isset($teamplayers[2]->name)) value="{{$teamplayers[2]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[2]->ingame_name)) value="{{ $teamplayers[2]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name2">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[2]->ingame_id)) value="{{ $teamplayers[2]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id2">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[2]->email)) value="{{ $teamplayers[2]->email }}"  @endif type="text" name="player_email" id="player_email2">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[2]->phone_no)) value="{{ $teamplayers[2]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone2">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid3" @if(isset($teamplayers[3]->tpid)) value="{{$teamplayers[3]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name3" @if(isset($teamplayers[3]->name)) value="{{$teamplayers[3]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[3]->ingame_name)) value="{{ $teamplayers[3]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name3">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[3]->ingame_id)) value="{{ $teamplayers[3]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id3">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[3]->email)) value="{{ $teamplayers[3]->email }}"  @endif type="text" name="player_email" id="player_email3">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[3]->phone_no)) value="{{ $teamplayers[3]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone3">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid4" @if(isset($teamplayers[4]->tpid)) value="{{$teamplayers[4]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name4" @if(isset($teamplayers[4]->name)) value="{{$teamplayers[4]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[4]->ingame_name)) value="{{ $teamplayers[4]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name4">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[4]->ingame_id)) value="{{ $teamplayers[4]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id4">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[4]->email)) value="{{ $teamplayers[4]->email }}"  @endif type="text" name="player_email" id="player_email4">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[4]->phone_no)) value="{{ $teamplayers[4]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone4">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid5" @if(isset($teamplayers[5]->tpid)) value="{{$teamplayers[5]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name5" @if(isset($teamplayers[5]->name)) value="{{$teamplayers[5]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[5]->ingame_name)) value="{{ $teamplayers[5]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name5">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[5]->ingame_id)) value="{{ $teamplayers[5]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id5">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[5]->email)) value="{{ $teamplayers[5]->email }}"  @endif type="text" name="player_email" id="player_email5">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[5]->phone_no)) value="{{ $teamplayers[5]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone5">
                                 </div>
                              </div>
                           </div> --}}

                        {{-- @elseif($tournaments->game_id==1) --}}
                           <div class="row">
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Name</label>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Ingame Name</label>
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">ID</label>
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Email</label>
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <label class="join_turnament_label">Mobile</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid0" @if(isset($teamplayers[0]->tpid)) value="{{$teamplayers[0]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="player_name" type="text" name="Player Name" id="player_name0" @if(isset($teamplayers[0]->name)) value="{{$teamplayers[0]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[0]->ingame_name)) value="{{ $teamplayers[0]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name0">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[0]->ingame_id)) value="{{ $teamplayers[0]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id0">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[0]->email)) value="{{ $teamplayers[0]->email }}"  @endif type="text" name="player_email" id="player_email0">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[0]->phone_no)) value="{{ $teamplayers[0]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone0">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid1" @if(isset($teamplayers[1]->tpid)) value="{{$teamplayers[1]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name0" @if(isset($teamplayers[1]->name)) value="{{$teamplayers[1]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[1]->ingame_name)) value="{{ $teamplayers[1]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name1">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[1]->ingame_id)) value="{{ $teamplayers[1]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id1">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[1]->email)) value="{{ $teamplayers[1]->email }}"  @endif type="text" name="player_email" id="player_email1">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[1]->phone_no)) value="{{ $teamplayers[1]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone1">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid2" @if(isset($teamplayers[2]->tpid)) value="{{$teamplayers[2]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name2" @if(isset($teamplayers[2]->name)) value="{{$teamplayers[2]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[2]->ingame_name)) value="{{ $teamplayers[2]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name2">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[2]->ingame_id)) value="{{ $teamplayers[2]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id2">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[2]->email)) value="{{ $teamplayers[2]->email }}"  @endif type="text" name="player_email" id="player_email2">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[2]->phone_no)) value="{{ $teamplayers[2]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone2">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid3" @if(isset($teamplayers[3]->tpid)) value="{{$teamplayers[3]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name3" @if(isset($teamplayers[3]->name)) value="{{$teamplayers[3]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[3]->ingame_name)) value="{{ $teamplayers[3]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name3">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[3]->ingame_id)) value="{{ $teamplayers[3]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id3">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[3]->email)) value="{{ $teamplayers[3]->email }}"  @endif type="text" name="player_email" id="player_email3">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[3]->phone_no)) value="{{ $teamplayers[3]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone3">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid4" @if(isset($teamplayers[4]->tpid)) value="{{$teamplayers[4]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name4" @if(isset($teamplayers[4]->name)) value="{{$teamplayers[4]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[4]->ingame_name)) value="{{ $teamplayers[4]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name4">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[4]->ingame_id)) value="{{ $teamplayers[4]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id4">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[4]->email)) value="{{ $teamplayers[4]->email }}"  @endif type="text" name="player_email" id="player_email4">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[4]->phone_no)) value="{{ $teamplayers[4]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone4">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="TP_id" id="tpid5" @if(isset($teamplayers[5]->tpid)) value="{{$teamplayers[5]->tpid }}"  @endif>
                              <div class="modal_input">
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" required="required" placeholder="Player Name" type="text" name="Player Name" id="player_name5" @if(isset($teamplayers[5]->name)) value="{{$teamplayers[5]->name }}"  @endif>
                                 </div>
                                 @if($tournaments->ps_number==1 || $tournaments->ps_number==3)
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="IN Game Name"@if(isset($teamplayers[5]->ingame_name)) value="{{ $teamplayers[5]->ingame_name }}"  @endif type="text" name="ingame_name" id="ingame_name5">
                                 </div>
                                 @endif
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control"
                                    @if($tournaments->ps_number==1)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==3)
                                    placeholder="IN Game ID"
                                    @elseif($tournaments->ps_number==2)
                                    placeholder="PSN ID"
                                    @elseif($tournaments->ps_number==4)
                                    placeholder="Steam ID"
                                    @else
                                    placeholder="Origin ID"
                                 @endif
                                    @if(isset($teamplayers[5]->ingame_id)) value="{{ $teamplayers[5]->ingame_id }}"  @endif type="text" name="ingame_id" id="ingame_id5">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Email Id"@if(isset($teamplayers[5]->email)) value="{{ $teamplayers[5]->email }}"  @endif type="text" name="player_email" id="player_email5">
                                 </div>
                                 <div class="upadate_field add_game_field mb-3">
                                    <input class="form-control" placeholder="Mobile No"@if(isset($teamplayers[5]->phone_no)) value="{{ $teamplayers[5]->phone_no }}"  @endif type="text" name="player_phone" id="player_phone5">
                                 </div>
                              </div>
                           </div>
                        {{-- @else --}}
                        {{-- <input type="hidden"  name="ingame_id" id="ingame_id" value="">
                        <input type="hidden"  name="ingame_name" id="ingame_name" value=""> --}}
                        {{-- @endif --}}
                        <div class="upadate_field add_game_field">
                           <input class="add_game_id_submit" type="button" id="teamjoinGame" value="Submit" name="" data-id="{{request()->route()->id}}">
                        </div>
                        
                     </form>
                  
                  </div>
               </div>
            </div>
         </div>
      @endif


      {{-- live Chat  --}}
      @if($tournaments->gamer_id != NULL)
         @if($userId != $tournaments->gamer_id)
         <div class="wrapper">
            <div class="chat_dive content" id="content">
               @if($tournaments->gamer_id)
                  @php
                  $gamerName = App\Models\Gamer::where('id', $tournaments->gamer_id)->first();
                  @endphp
               @endif
               @php
               $getcreator = $tournaments->gamer_id==NULL ? "Admin" : $gamerName->id;
               $getSMS = DB::table('tournament_chats')
               ->where(function($query) use($getcreator, $userId) {
                  $query->where('gamer_id', $getcreator)
                        ->orWhere('gamer_id', $userId);
               })
               ->where('tournament_id', $tournaments->id)
               ->orderBy('created_at', 'ASC')->get();
               @endphp
               <h3>{{ ($tournaments->gamer_id==NULL)? "Admin" : "$gamerName->fname $gamerName->lname" }} <span class="online">online</span></h3>
               <ul class="chat_msg" id="online_chat">
                  @if($getSMS)
                     @foreach($getSMS as $getSMSKey => $getSMSValue)
                     @php
                        $fetchDate = date("Y-d-m",strtotime($getSMSValue->created_at))
                     @endphp
                        @if($getSMSValue->gamer_id == $userId)
                           <li id="get_data">
                              <div class="msg you">
                              {{ $getSMSValue->message }}
                                 <span class="time">{{($fetchDate == $today) ? "Today ".date("h:i",strtotime($getSMSValue->created_at)): date("d m h:i",strtotime($getSMSValue->created_at))}}</span>
                              </div>
                           </li>
                        @elseif($getSMSValue->sms_to == $userId)
                           <li id="get_data">
                              <div class="msg him">
                                 {{ $getSMSValue->message }}
                                 <span class="time">{{($fetchDate == $today) ? "Today ".date("h:i",strtotime($getSMSValue->created_at)): date("d m h:i",strtotime($getSMSValue->created_at))}}</span>
                              </div>
                           </li>
                        @endif
                     @endforeach
                  @endif
               </ul>
               <form method="POST" action="{{route('gamer.tournaments.sms')}}" id="AddSMS">@csrf
                  <div class="input-group">
                     <input type="hidden" name="tournament_id" value="{{ $tournaments->id }}">
                     <input type="hidden" name="gamer_id" value="{{ $userId }}">
                     <input type="hidden" name="sms_to" value="{{( $tournaments->gamer_id) ?  $getcreator : "Admin" }}">
                     <input type="hidden" name="creator" value="{{( $tournaments->gamer_id) ?  $getcreator : "Admin" }}">
                     <input type="text" class="form-control" name="sms" placeholder="Enter here...">
                     <span class="input-group-btn">
                           <button class="btn btn-default" type="submit"><img src="{{ asset('letsgamenow/images/live_chat/send.svg') }}" width="22px"></button>
                     </span>
                  </div>
               </form>
               <!-- /input-group -->
            </div>
            <a class="buttom-btn" href="#" id="toggle" ><img src="{{ asset('letsgamenow/images/live_chat/chat_icon.png') }}" width="36px">
               @php
                  $latest_UserSMS = App\Models\TournamentChat::where('tournament_id', $tournaments->id)->where('gamer_id', $userId)->where('sms_to', $tournaments->gamer_id)->latest('created_at')->first();
                  // dd($latest_UserSMS->message);
               @endphp
               @if($latest_UserSMS)
                  @php
                     $countSMS = App\Models\TournamentChat::where('tournament_id', $tournaments->id)->where('gamer_id', $tournaments->gamer_id)->where('sms_to', $userId)->where('created_at', '>', $latest_UserSMS->created_at)->count();
                  @endphp
               
                  @if($countSMS>0)
                     <span class="sms_count" style="background: #ffbf00 !important; color: #000 !important;">{{ $countSMS }}</span>
                  @endif
               @endif
            </a>
         </div>
         @endif
      @endif
      {{-- live Chat  --}}
   {{-- @endif  --}}
@endif 
      
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>


$(document).ready(function(){
    fetchSMS();
    function fetchSMS(){
      var auth_id = $("#auth_id").val();
      var tid = $("#tid").val();
      $.ajax({
         type: "GET",
         url: "{{ url('fetch_sms') }}/" + tid,
         dataType:"Json",
			success: function(response) {

            $.each(response, function(key, items ){
               $('#online_chat').append();
            });
            console.log(response.admin);
			}
		});
    }
});
   // / add to cart ajax
	// $('#AddSMS').on('submit', function(e) {
	// 	e.preventDefault();
	// 	var data = $(this).serialize();
	// 	$.ajax({
	// 		url: $(this).attr('action'),
	// 		method: $(this).attr('method'),
	// 		data: data,
	// 		success: function(result) {
   //          window.location.reload();
	// 		},
	// 	});
	// });

    $(function () {
        $(document).on("click", ".btn-register-submit", function () {                           
                var id = $(this).attr("data-id"); 
                var gamer_id = $(this).attr("gamer_id");
                var gamer_type = $(this).attr("gamer_type");
                var postdata = {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "gamer_id": gamer_id,
                    "gamer_type":gamer_type
                     }
                        swal({
                           title: "Are you sure?",
                           text: "You want to Register for this Tournament!",
                           showCancelButton: true,
                           confirmButtonClass: "btn-danger",
                           confirmButtonText: "Yes, do!",
                           closeOnConfirm: false
                           },
                  function(){
                $.post("{{ route('gamerstournaments.update2') }}", postdata, function (response) {
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

        $(document).on("click", "#joinGame", function () {         
                var id = $(this).attr("data-id"); 
                var gamer_id = $("#gamer_id").val();
                var gamer_type = $("#gamer_type").val();
                var ingame_name = $("#ingame_name").val();
                var ingame_id = $("#ingame_id").val();
                var postdata = {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "gamer_id": gamer_id,
                    "gamer_type":gamer_type,
                    "in_game_name":ingame_name,
                    "in_game_id":ingame_id,
                      }
                      swal({
                           title: "Are you sure?",
                           text: "You want to Register for this Tournament!",
                           showCancelButton: true,
                           confirmButtonClass: "btn-danger",
                           confirmButtonText: "Yes, do!",
                           closeOnConfirm: false
                           },
                  function(){
                $.post("{{ route('gamerstournaments.update2') }}", postdata, function (response) {
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

         $(document).on("click", "#teamjoinGame", function () {
                var id = $(this).attr("data-id");
                var gamer_id = $("#gamer_id").val();
                var gamer_type = $("#gamer_type").val();

                var tpid0 = $("#tpid0").val();
                var player_name0 = $("#player_name0").val();
                var player_email0 = $("#player_email0").val();
                var player_phone0 = $("#player_phone0").val();
                var ingame_name0 = $("#ingame_name0").val();
                var ingame_id0 = $("#ingame_id0").val();

                var tpid1 = $("#tpid1").val();
                var player_name1 = $("#player_name1").val();
                var player_email1 = $("#player_email1").val();
                var player_phone1 = $("#player_phone1").val();
                var ingame_name1 = $("#ingame_name1").val();
                var ingame_id1 = $("#ingame_id1").val();

                var tpid2 = $("#tpid2").val();
                var player_name2 = $("#player_name2").val();
                var player_email2 = $("#player_email2").val();
                var player_phone2 = $("#player_phone2").val();
                var ingame_name2 = $("#ingame_name2").val();
                var ingame_id2 = $("#ingame_id2").val();

                var tpid3 = $("#tpid3").val();
                var player_name3 = $("#player_name3").val();
                var player_email3 = $("#player_email3").val();
                var player_phone3 = $("#player_phone3").val();
                var ingame_name3 = $("#ingame_name3").val();
                var ingame_id3 = $("#ingame_id3").val();

                var tpid4 = $("#tpid4").val();
                var player_name4 = $("#player_name4").val();
                var player_email4 = $("#player_email4").val();
                var player_phone4 = $("#player_phone4").val();
                var ingame_name4 = $("#ingame_name4").val();
                var ingame_id4 = $("#ingame_id4").val();

                var tpid5 = $("#tpid5").val();
                var player_name5 = $("#player_name5").val();
                var player_email5 = $("#player_email5").val();
                var player_phone5 = $("#player_phone5").val();
                var ingame_name5 = $("#ingame_name5").val();
                var ingame_id5 = $("#ingame_id5").val();

                var postdata = {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "gamer_id": gamer_id,
                    "gamer_type":gamer_type,
                    "tpid0":tpid0,
                    "player_name0":player_name0,
                    "player_email0":player_email0,
                    "player_phone0":player_phone0,
                    "in_game_name0":ingame_name0,
                    "in_game_id0":ingame_id0,
                    "tpid1":tpid1,
                    "player_name1":player_name1,
                    "player_email1":player_email1,
                    "player_phone1":player_phone1,
                    "in_game_name1":ingame_name1,
                    "in_game_id1":ingame_id1,
                    "tpid2":tpid2,
                    "player_name2":player_name2,
                    "player_email2":player_email2,
                    "player_phone2":player_phone2,
                    "in_game_name2":ingame_name2,
                    "in_game_id2":ingame_id2,
                    "tpid3":tpid3,
                    "player_name3":player_name3,
                    "player_email3":player_email3,
                    "player_phone3":player_phone3,
                    "in_game_name3":ingame_name3,
                    "in_game_id3":ingame_id3,
                    "tpid4":tpid4,
                    "player_name4":player_name4,
                    "player_email4":player_email4,
                    "player_phone4":player_phone4,
                    "in_game_name4":ingame_name4,
                    "in_game_id4":ingame_id4,
                    "tpid5":tpid5,
                    "player_name5":player_name5,
                    "player_email5":player_email5,
                    "player_phone5":player_phone5,
                    "in_game_name5":ingame_name5,
                    "in_game_id5":ingame_id5,
                }
                  swal({
                           title: "Are you sure?",
                           text: "You want to Register for this Tournament!",
                           showCancelButton: true,
                           confirmButtonClass: "btn-danger",
                           confirmButtonText: "Yes, do!",
                           closeOnConfirm: false
                           },
                  function(){

                $.post("{{ route('gamerstournaments.update2') }}", postdata, function (response) {
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
        $("#toggle").on("click", function(){
            $(".content").toggle(); // fadeToggle() // .slideToggle()
         });
    });
</script>


    
