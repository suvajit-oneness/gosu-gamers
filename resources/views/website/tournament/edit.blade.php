@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")
<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Create Tournament</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>
<div class="container">
<div class="content">
   <div class="">
    <div class="text-right mb-3">
      <a class="btn btn-danger" href="{{ route('gamer.tournaments.show',$user->id) }}"><i class="icon-exit ml-2"></i> Back</a>
    </div>
      <div class="">
        <form method="post" enctype="multipart/form-data" action="{{route('gamer.tournaments.update')}}">
          @csrf
          <div class="row profile_upadate_field custom_layouts">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Name : <em>*</em></label>
                <input type="text" name="tournament_name" class="form-control" placeholder="Enter Name" value="@if(isset($tour_data) && ($tour_data->name != '')) {{ $tour_data->name }} @endif">
                <input type="hidden" name="tournament_id" class="form-control" value="@if(isset($tour_data) && ($tour_data->id != '')) {{ $tour_data->id }} @endif">
                @if($errors->has('tournament_name'))
                <span class="roy-vali-error"><small>{{$errors->first('tournament_name')}}</small></span>
                @endif
              </div>
            </div>
        
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Game : <em>*</em></label>
                <select name="game" class="form-control">
                  <option value="">-Select Game-</option>
                  @if(isset($game_data))
                    @foreach($game_data as $data)
                    <option value="{{ $data->id }}" @if(isset($tour_data) && ($tour_data->game_id != '') && ($tour_data->game_id == $data->id)) selected="selected" @endif>{{ ucfirst($data->name) }}</option>
                    @endforeach
                  @endif
                </select>
                @if($errors->has('game'))
                <span class="roy-vali-error"><small>{{$errors->first('game')}}</small></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout radio">
                <label>Zone Type: <em>*</em></label>
                <input type="radio" name="zone_type" class="zone_type" value="1" id="1" @if($tour_data->region_id != '0') checked="checked" @endif> 
                <label for="1" class="title">Region</label>
                <input type="radio" name="zone_type" class="zone_type" value="2" id="2" @if($tour_data->country_id != '0') checked="checked" @endif> <label for="2" class="title">Country</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout select" id="con" style="display:@if($tour_data->country_id != '0') block; @else none @endif">
                <label>Country : <em>*</em></label>
                <select name="country[]" class="form-control" multiple=>
                  <option value="">Select Country</option>
                  @if(isset($countries))
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" @if(isset($tour_data) && ($tour_data->country_id != '') && ($tour_data->country_id == $country->id)) selected="selected" @endif>{{ $country->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group upadate_field custom_layout" id="regn" style="display:@if($tour_data->region_id != '0') block; @else none @endif">
                <label>Region : <em>*</em></label>
                <select name="region[]" class="form-control" multiple=>
                  <option value="">Select Region</option>
                  @if(isset($regionList))
                    @foreach($regionList as $region)
                    <option value="{{ $region->id }}" @if(isset($tour_data) && ($tour_data->region_id != '') && ($tour_data->region_id == $region->id)) selected="selected" @endif>{{ $region->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
          </div>

          <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>    
            <div class="row">
              <div class="col-md-12">
                <div class="form-group upadate_field custom_layout">
                  <label>Description :</label>
                  <textarea name="description" id="description" class="form-control" rows="10">@if(isset($tour_data) && ($tour_data->description != '')) {{ $tour_data->description }} @endif</textarea>
                </div>
              </div>
            </div>
          <script>
            ClassicEditor
              .create( document.querySelector( '#description' ) )
              .catch( error => {
                  console.error( error );
              } );
          </script>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group upadate_field custom_layout">
                <label>User Type : <em>*</em></label>
                <select name="user_type" class="form-control">
                  <option value="">Select User Ype</option>
                  <option value="1" @if(isset($tour_data) && ($tour_data->user_type == '1')) selected="selected" @endif>Individual</option>
                  <option value="2" @if(isset($tour_data) && ($tour_data->user_type == '2')) selected="selected" @endif>Team</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Start Date : <em>*</em></label> 
                <input type="text" name="start_date" id="start_date" class="form-control" value="@if(isset($tour_data) && ($tour_data->start_date != '')) {{ date('m/d/Y',strtotime($tour_data->start_date)) }} @endif">
                @if($errors->has('start_date'))
                <span class="roy-vali-error"><small>{{$errors->first('start_date')}}</small></span>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>End Date : <em>*</em></label> 
                <input type="text" name="end_date" id="end_date" class="form-control" value="@if(isset($tour_data) && ($tour_data->end_date != '')) {{ date('m/d/Y',strtotime($tour_data->end_date)) }} @endif"  onchange="TournamentDateCheck();">
                @if($errors->has('end_date'))
                <span class="roy-vali-error"><small>{{$errors->first('end_date')}}</small></span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
           
          <div class="col-md-6">
            <div class="form-group upadate_field custom_layout">
                <label>Start time : <em>*</em></label>
                <input type="text" name="start_time" id="start_time" class="form-control" value="@if(isset($tour_data) && ($tour_data->start_time != '')) {{ date('h:i A',strtotime($tour_data->start_time)) }} @endif">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>End time : <em>*</em></label>
                <input type="text" name="end_time" id="end_time" class="form-control" value="@if(isset($tour_data) && ($tour_data->end_time != '')) {{ date('h:i A',strtotime($tour_data->end_time)) }} @endif">
                @if($errors->has('end_time'))
                <span class="roy-vali-error"><small>{{$errors->first('end_time')}}</small></span>
                @endif
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Registration Start From: <em>*</em></label> 
                <input type="text" name="reg_start_date" id="reg_start_date" class="form-control" value="@if(isset($tour_data) && ($tour_data->reg_start_date != '')) {{ $tour_data->reg_start_date }} @endif">
                @if($errors->has('reg_start_date'))
                <span class="roy-vali-error"><small>{{$errors->first('reg_start_date')}}</small></span>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Registration End : <em>*</em></label> 
                <input type="text" name="reg_end_date" id="reg_end_date" class="form-control" onchange="RegistrationDateCheck();" value="@if(isset($tour_data) && ($tour_data->reg_end_date != '')) {{ $tour_data->reg_end_date }} @endif">
                @if($errors->has('reg_end_date'))
                <span class="roy-vali-error"><small>{{$errors->first('reg_end_date')}}</small></span>
                @endif
              </div>
            </div>
          </div> 

        <div class="row">
          <div class="col-md-6">
            <div class="form-group upadate_field custom_layout">
                <label>Registration Start time : <em>*</em></label>
                <input type="text" name="reg_start_time" id="reg_start_time" class="form-control" autocomplete="off" value="@if(isset($tour_data) && ($tour_data->reg_start_time != '')) {{ date('h:i A',strtotime($tour_data->reg_start_time)) }} @endif">
                @if($errors->has('reg_start_time'))
                <span class="roy-vali-error"><small>{{$errors->first('reg_start_time')}}</small></span>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Registration End time : <em>*</em></label>
                <input type="text" name="reg_end_time" id="reg_end_time" class="form-control" autocomplete="off" value="@if(isset($tour_data) && ($tour_data->reg_end_time != '')) {{ date('h:i A',strtotime($tour_data->reg_end_time)) }} @endif">
                @if($errors->has('reg_end_time'))
                <span class="roy-vali-error"><small>{{$errors->first('reg_end_time')}}</small></span>
                @endif
              </div>
            </div>
        </div>

         <div class="row">
            <div class="col-md-12">
              <div class="form-group upadate_field custom_layout radio">
                <label>Add Prize Type : <em>*</em></label>
                <input type="radio" name="prize_type" class="prize_type" value="1" id="3" @if($tour_data->prize_money != '0') checked="checked" @endif><label for="3" class="title"> Prize Money</label>
                <input type="radio" name="prize_type" class="prize_type" value="2" id="4" @if($tour_data->other_reward != '') checked="checked" @endif><label for="4" class="title"> Other Rewards</label>
              </div>
            </div>
          </div>

          <div class="row" id="money" style="display:@if($tour_data->prize_money != '0') flex; @else none @endif">
            <div class="col-md-6">
                <div class="form-group upadate_field custom_layout">
                  <label>Prize Money : <em>*</em></label> 
                  <input type="text" name="prize_money" id="prize_money" class="form-control onlyNumber" autocomplete="off" value="@if($tour_data->prize_money != '0') {{$tour_data->prize_money}} @endif">
                    @if($errors->has('prize_money'))
                    <span class="roy-vali-error"><small>{{$errors->first('prize_money')}}</small></span>
                    @endif
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group upadate_field custom_layout" >
                  <label>Currency : <em>*</em></label> 
                      <select name="prize_currency" id="prize_currency" class="form-control">
                        <option value="">Select Currency</option>
                        @if(!empty($currencyList))
                          @foreach($currencyList as $currency)
                          <option value="{{ $currency->id }}" @if(($tour_data->prize_currency != '0') && ($tour_data->prize_currency == $currency->id)) selected="selected" @endif>{{ $currency->currency_name }}({{$currency->currency_code}})</option>
                          @endforeach
                        @endif
                      </select>
                      @if($errors->has('currency'))
                      <span class="roy-vali-error"><small>{{$errors->first('currency')}}</small></span>
                      @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group upadate_field custom_layout">
                  <label>No. of users for prize money distribution:</label>
                  <input type="text" name="no_user_prize_dist" id="noufpmd" class="form-control onlyNumber" placeholder="How many users to distribute prize money" value="@if(isset($tour_data)){{ $tour_data->no_user_prize_dist }}@endif">
                </div>
              </div>
              <div class="col-md-6">
                <div class="upadate_field">
                  <input type="button" id="setPercentage" class="btn btn-primary" value="Set Percentage">
                </div>
              </div>
              <div class="col-md-12" id="AridynaBox">
                @if(isset($percentageBrakeups) && !empty($percentageBrakeups))

                  <table class="table table-bordered table-sm table_custom_layout">
                   <thead>
                      <tr>
                        <th>Rank</th>
                        <!-- <th>Percentage(%)</th> -->
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach( $percentageBrakeups as $v ) 
                      <tr>
                        <td>Prize Amount Percentage For <strong>Rank-{{ $v->user_rank }}</strong></td>
                        <!-- <td><input type="text" name="percVal[]" class="percVal artxtb onlyNumber" value="{{ intval($v->percentage_value) }}"> %</td> -->
                        <td><input type="text" name="percAmt[]" class="percAmt artxtb" value="{{ intval($v->percentage_amt) }}"></td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                @endif
              </div>
          </div>

          <div class="row" id="reward" style="display:@if($tour_data->other_reward != '') block; @else none @endif">
            <div class="col-md-6">
                <div class="form-group upadate_field custom_layout" >
                  <label>Other Reward : <em>*</em></label> 
                  <input type="text" name="other_reward" id="other_reward" class="form-control" autocomplete="off" value="@if($tour_data->other_reward != '') {{$tour_data->other_reward}} @endif">
                    @if($errors->has('other_reward'))
                    <span class="roy-vali-error"><small>{{$errors->first('other_reward')}}</small></span>
                    @endif
                </div>
            </div>
              <div class="col-md-6">
                <div class="form-group upadate_field custom_layout file" style="">
                    <label>Upload an Image : <em>*</em></label>
                    <input type="file" name="image">
                    <!-- <br>
                    @if(isset($tour_data) && !empty($tour_data->image))
                        <img id="blah" src="{{ asset('/'.$tour_data->image) }}" height="100px" weight="150px">
                    @endif -->
                </div>
              </div>
            <div class="col-md-6">
              <div class="form-group upadate_field radio custom_layout">
                <label>Tournament Type: <em>*</em></label>              
                <input type="radio" name="tournament_type" class="tournament_type" value="2" id="5" @if(isset($tour_data) && ($tour_data->tournament_type != '1')) checked="checked" @endif><label for="5" class="title"> Konck Out</label>
                <input type="radio" name="tournament_type" class="tournament_type" value="1" id="6" @if(isset($tour_data) && ($tour_data->tournament_type != '2')) checked="checked" @endif><label for="6" class="title"> Room wise </label>
              </div>
          </div>
            </div>
         <div class="row" id="roomk" style="display:none;">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Maximum Player Allowed: <em>*</em></label> 
                <input type="text" name="max_players" id="max_players" class="form-control" autocomplete="off" value="@if(isset($tour_data) && ($tour_data->max_players != '')){{ $tour_data->max_players }}@endif">
                @if($errors->has('max_players'))
                <span class="roy-vali-error"><small>{{$errors->first('max_players')}}</small></span>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>No. Of Player : <em>*</em></label> 
                <input type="text" name="room_size" id="room_size" class="form-control" autocomplete="off" value="@if(isset($tour_data) && ($tour_data->room_size != '')){{ $tour_data->room_size }}@endif">
                @if($errors->has('room_size'))
                <span class="roy-vali-error"><small>{{$errors->first('room_size')}}</small></span>
                @endif
              </div>
            </div>
          </div> 
          <div class="row" id="kout" style="display:none;">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Maximum Player Allowed: <em>*</em></label> 
                <input type="number" name="max_players" id="max_players" class="form-control" autocomplete="off"  value="@if(isset($tour_data) && ($tour_data->max_players != '')){{ $tour_data->max_players }}@endif" >
                @if($errors->has('max_players'))
              <span class="roy-vali-error"><small>{{$errors->first('max_players')}}</small></span>
                @endif
              </div>
              </div>
              </div>
              <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group upadate_field custom_layout">
                        <label>Rules :</label>
                        <textarea name="rulesdescription" id="rulesdescription" class="form-control" rows="10">@if(isset($tour_data) && ($tour_data->rulesdescription != '')) {{ $tour_data->rulesdescription }} @endif</textarea>
                      </div>
                    </div>
                  </div>
              <script>
                  ClassicEditor
                      .create( document.querySelector( '#rulesdescription' ) )
                      .catch( error => {
                          console.error( error );
                      } );
              </script>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group upadate_field radio custom_layout radio">
                    <label>Participation :</label>
                    <input type="radio" name="is_free" class="is_free" value="1" id="7" @if($tour_data->is_free == '1') checked="checked" @endif><label for="7" class="title">Free</label>
                    <input type="radio" name="is_free" class="is_free" value="0" id="8" @if($tour_data->is_free == '0') checked="checked" @endif><label for="8" class="title"> Payable </label>
                  </div>
                </div>
              </div> 

              <div class="row" id="part_amount" style="display:@if($tour_data->part_amount == '0') none @else block @endif">
                <div class="col-md-6">
                    <div class="form-group upadate_field custom_layout" >
                      <label>Participation Amount : <em>*</em></label> 
                      <input type="text" name="partcipation_amount" id="partcipation_amount" class="form-control" autocomplete="off" value="{{ $tour_data->part_amount }}">
                        @if($errors->has('partcipation_amount'))
                        <span class="roy-vali-error"><small>{{$errors->first('partcipation_amount')}}</small></span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group upadate_field custom_layout">
                      <label>Currency : <em>*</em></label> 
                        <select name="part_currency" class="form-control">
                          <option value="">Select Currency</option>
                          @if(isset($currencyList))
                            @foreach($currencyList as $currency)
                            <option value="{{ $currency->id }}" @if(($tour_data->part_currency != '0') && ($tour_data->part_currency == $currency->id)) selected="selected" @endif>{{ $currency->currency_name }}({{$currency->currency_code}})</option>
                            @endforeach
                          @endif
                        </select>
                        @if($errors->has('part_currency'))
                        <span class="roy-vali-error"><small>{{$errors->first('part_currency')}}</small></span>
                        @endif
                    </div>
                </div>
              </div>

            {{-- @php $psn = explode(',',$tour_data->ps_number); @endphp --}}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group upadate_field radio custom_layout">
                  <label>Platforms: </label>
                  @foreach($station as $key => $stn)
                  <input type="radio" name="ps_number" value="{{ $stn->id }}" id="{{$key+12}}" @if($tour_data->ps_number) checked @endif/><label class="title" for="{{$key+12}}"> {{ $stn->name }}</label>
                  @endforeach
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group upadate_field custom_layout radio">
                  <label>Status : <em>*</em></label>
                  <input type="radio" name="tournament_status" value="1" id="10" checked="checked"><label class="title" for="10"> Active</label>
                  <input type="radio" name="tournament_status" value="2" id="11"><label class="title" for="11"> Deactive</label>
                </div>
              </div>
            </div>

          <!------------------------------------------------------------------------------------------------------->
        <!-- META INFO -->
         <div class="row">
            <div class="col-md-12">
              <h3 class="label_title">Page Meta Information</h3>
              <hr/>
            </div>
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Meta Title:</label>
                <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="@if(isset($tour_data)){{ $tour_data->meta_title }}@endif">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Meta Keywords:</label>
                <input type="text" name="metakeyword" class="form-control" placeholder="Meta Keywords" value="@if(isset($tour_data)){{ $tour_data->metakeyword }}@endif">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group upadate_field custom_layout">
                <label>Meta Description:</label>
                <textarea name="metadescription" class="form-control" placeholder="Meta Description">@if(isset($tour_data)){{ $tour_data->metadescription }}@endif</textarea>
              </div>
            </div>
        </div>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-edit mr-1"></i>Save</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>

</section>

@endsection

