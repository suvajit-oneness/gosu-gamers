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
          <a class="btn btn-danger" href="{{ route('gamer.tournaments.show',$user->id) }}">Back</a>
        </div>
        <div class="">
          <form name="frm" id="frmx" method="post" enctype="multipart/form-data" action="{{route('gamer.tournaments.store',$user->id)}}">
              @csrf
              <div class="row profile_upadate_field custom_layouts">
                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout">
                    <label>Name : <em>*</em></label>
                    <input type="text" name="name" id="name" class="typeahead form-control " placeholder="Tournament Name" autocomplete="off" value="{{ old('name') }}">
                      @error('name') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout select">
                    <label>Game : <em>*</em></label>
                    <select name="game_id" id="game_id" class="form-control">
                      <option value="">-Select Game-</option>
                      @if(isset($game))
                        @foreach($game as $data)
                        <option value="{{ $data->id }}">{{ ucfirst($data->name) }}</option>
                        @endforeach
                      @endif
                    </select> 
                    @error('game_id') <p class="small text-danger">{{ $message }}</p> @enderror  
                  </div>
                </div>   

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout radio">
                    <label>Zone Type: <em>*</em></label>
                    <input type="radio" name="zone_type" class="zone_type" value="1" id="zone1"> <label for="zone1" class="title">Region</label>
                    <input type="radio" name="zone_type" class="zone_type" value="2" id="zone2"> <label for="zone2" class="title">Country</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout select" id="con" style="display:none;">
                    <label>Country : <em>*</em></label>
                    <select name="country_id[]" class="form-control multiselect" multiple="multiple" >
                    <option value="">---Select Region---</option>
                      @if(isset($country))
                          @foreach($country as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                      @endif
                    </select>
                    @error('country_id') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout select" id="regn" style="display:none;">
                    <label>Region : <em>*</em></label>
                      <select name="region_id[]" class="form-control multiselect" multiple="multiple">
                      <option value="">---Select Region---</option>
                      @if(isset($regions))
                        @foreach($regions as $regions)
                        <option value="{{ $regions->id }}">{{ $regions->name }}</option>
                        @endforeach
                      @endif
                    </select>
                    @error('region_id') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout">
                    <label>Description :</label>
                    <textarea name="description" id="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout">
                    <label>User Type : <em>*</em></label>
                    <select name="user_type" class="form-control">
                      <option value="">Select User Type</option>
                      <option value="1">Individual</option>
                      <option value="2">Team</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>Start Date : <em>*</em></label> 
                    <input type="date" name="start_date" id="start_date" class="form-control" autocomplete="off" value="{{ old('start_date') }}">
                    @error('start_date') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>End Date : <em>*</em></label> 
                    <input type="date" name="end_date" id="end_date" class="form-control" autocomplete="off" value="{{ old('end_date') }}">
                    @error('end_date') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>Start time : <em>*</em></label>
                    <input type="time" name="start_time" id="start_time" class="form-control" autocomplete="off" value="{{ old('start_time') }}">
                    @error('start_time') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>End time : <em>*</em></label>
                    <input type="time" name="end_time" id="end_time" class="form-control" autocomplete="off" value="{{ old('end_time') }}">
                    @error('end_time') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>Registration Start From: <em>*</em></label> 
                    <input type="date" name="reg_start_date" id="reg_start_date" class="form-control" autocomplete="off" value="{{ old('reg_start_date') }}">
                    @error('reg_start_date') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>Registration End : <em>*</em></label> 
                    <!-- <input type="text" name="reg_end_date" id="reg_end_date" class="form-control" onchange="RegistrationDateCheck();" autocomplete="off"> -->
                    <input type="date" name="reg_end_date" id="reg_end_date" class="form-control" autocomplete="off" value="{{ old('reg_end_date') }}">
                    @error('reg_end_date') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>Registration Start time : <em>*</em></label>
                    <input type="time" name="reg_start_time" id="reg_start_time" class="form-control" autocomplete="off" value="{{ old('reg_start_time') }}">
                    @error('reg_start_time') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>Registration End time : <em>*</em></label>
                    <input type="time" name="reg_end_time" id="reg_end_time" class="form-control" autocomplete="off" value="{{ old('reg_end_time') }}">
                    @error('reg_end_time') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout radio">
                    <label>Add Prize Type : <em>*</em></label>
                    <input type="radio" name="prize_type" class="prize_type" value="1" id="prize1"><label for="prize1" class="title">Prize Money</label>
                    <input type="radio" name="prize_type" class="prize_type" value="2" id="prize2"> <label for="prize2" class="title">Other Rewards</label>
                  </div>
                </div>

                <div class="col-md-6" id="money" style="display:none;">
                  <div class="form-group upadate_field custom_layout" >
                    <label>Prize Money : <em>*</em></label> 
                    <input type="text" name="prize_money" id="prize_money" class="form-control onlyNumber" autocomplete="off" value="{{ old('prize_money') }}">
                    @error('prize_money') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout" >
                    <label>Currency : <em>*</em></label> 
                    <select name="prize_currency" id="prize_currency" class="form-control">
                      <option value="">Select Currency</option>
                      @if(isset($currencyList))
                      @foreach($currencyList as $currency)
                      <option value="{{ $currency->id }}">{{ $currency->currency_name }}({{$currency->currency_code}})</option>
                      @endforeach
                      @endif
                    </select>
                    @error('prize_currency') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>No. of users for prize money distribution:</label>
                    <input type="text" name="no_user_prize_dist" id="noufpmd" class="form-control onlyNumber" placeholder="How many users to distribute prize money">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <input type="button" id="setPercentage" class="btn bg-teal-400 text-light" value="Set Amount">
                  </div>
                </div>

                <div class="col-md-12" id="AridynaBox" style="background-color: #ccc;"></div>

                <div class="col-md-6" id="reward" style="display:none;">
                  <div class="form-group upadate_field custom_layout">
                      <label>Other Reward : <em>*</em></label> 
                      <input type="text" name="other_reward" id="other_reward" class="form-control" autocomplete="off" value="{{ old('other_reward') }}">
                      @error('other_reward') <p class="small text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout file" style="">
                    <label>Upload an Image : <em>*</em></label>
                    <input type="file" name="image">
                    <br>
                    @error('image') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout radio">
                    <label>Tournament Type: <em>*</em></label>
                    <input type="radio" name="tournament_type" class="tournament_type" value="2" id="tournament1"><label for="tournament1" class="title"> Konck Out</label>
                    <input type="radio" name="tournament_type" class="tournament_type" value="1" id="tournament2"><label for="tournament2" class="title">Room wise </label>                
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout">
                    <label>Maximum Player Allowed: <em>*</em></label> 
                    <input type="number" name="max_players" id="max_players" class="form-control" autocomplete="off" value="{{ old('max_players') }}">
                    @error('max_players') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>
          
                <div class="col-md-12" id="roomk" style="display:none;">
                  <div class="form-group upadate_field custom_layout">
                    <label>No. Of Player : <em>*</em></label> 
                    <input type="number" name="room_size" id="room_size" class="form-control"  autocomplete="off" value="{{ old('room_size') }}"> 
                    @error('room_size') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>
            
                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout">
                    <label>Rules :</label>
                    <textarea name="rulesdescription" id="rulesdescription" class="form-control" rows="2">{{ old('rulesdescription') }}</textarea>
                  </div>
                </div>
              
                <div class="col-md-12">
                  <div class="form-group upadate_field custom_layout radio">
                    <label>Participation :</label>
                    <input type="radio" name="is_free" class="is_free" value="1" id="participation1" checked> <label for="participation1" class="title">Free</label> 
                    <input type="radio" name="is_free" class="is_free" value="0" id="participation2"> <label for="participation2" class="title">Payable</label>
                  </div>
                </div>

                <div class="col-md-12 row" id="part_amount" style="display:none;">
                  <div class="col-md-6">
                    <div class="form-group upadate_field custom_layout" >
                      <label>Participation Amount : <em>*</em></label> 
                      <input type="text" name="partcipation_amount" id="partcipation_amount" class="form-control" autocomplete="off">
                      @error('partcipation_amount') <p class="small text-danger">{{ $message }}</p> @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group upadate_field custom_layout">
                        <label>Currency : <em>*</em></label> 
                          <select name="part_currency" class="form-control">
                            <option value="">Select Currency</option>
                            @if(isset($currencyList))
                              @foreach($currencyList as $currency)
                              <option value="{{ $currency->id }}">{{ $currency->currency_name }}({{$currency->currency_code}})</option>
                              @endforeach
                            @endif
                          </select>
                          @error('part_currency') <p class="small text-danger">{{ $message }}</p> @enderror
                      </div>
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout radio">
                    <label>Platforms: </label>
                    @foreach($station as $key => $stn)
                    <input type="radio" name="ps_number" value="{{ $stn->id }}" id="{{ $key }}+1"/> <label for="{{ $key }}+1" class="title"> {{ $stn->name }} 
                    </label>
                    @endforeach
                    @error('ps_number') <p class="small text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group upadate_field custom_layout radio">
                    <label>Status : <em>*</em></label>
                    <input type="radio" name="tournament_status" value="1" checked="checked" id="status1"> <label for="status1" class="title"> Active </label>
                    <input type="radio" name="tournament_status" value="0" id="status2"> <label for="status2" class="title">Deactive</label>
                  </div>
                </div>
              </div>
              <!------------------------------------------------------------------------------------------------------->

              <!-- META INFO -->

            <div class="row">
              <div class="col-md-12">
                <h3>Page Meta Information</h3>
                <hr/>
              </div>
              <div class="col-md-12">
                <div class="form-group upadate_field custom_layout">
                  <label>Meta Title:</label>
                  <input type="text" name="meta_title" class="form-control" placeholder="Meta Title">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group upadate_field custom_layout">
                  <label>Meta Keywords:</label>
                  <input type="text" name="metakeyword" class="form-control" placeholder="Meta Keywords">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group upadate_field custom_layout">
                  <label>Meta Description:</label>
                  <textarea name="metadescription" class="form-control" placeholder="Meta Description" rows="2"></textarea>
                </div>
              </div>
            </div>

            <div class="text-left">
              <div class="header-elements">
                <button type="submit" class="btn btn-dark"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('gamer.tournaments.create',$user->id)}}" class="btn btn-warning ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

