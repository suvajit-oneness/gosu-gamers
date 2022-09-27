@extends("admin.layouts.master")
@section("content")
    <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <div class="content">
        <div class="card">
            <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "
                    href="{{ route('tournaments.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('tournaments.update1')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name : <em>*</em></label>
                                <input type="text" name="tournament_name" class="form-control" placeholder="Enter Name"
                                       value="@if(isset($tour_data) && ($tour_data->name != '')){{$tour_data->name}}@endif">
                                <input type="hidden" name="tournament_id" class="form-control"
                                       value="@if(isset($tour_data) && ($tour_data->id != '')){{$tour_data->id}}@endif">
                                @if($errors->has('tournament_name'))
                                    <span class="roy-vali-error"><small>{{$errors->first('tournament_name')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Game : <em>*</em></label>
                                <select name="game" class="form-control">
                                    <option value="">-Select Game-</option>
                                    @if(isset($game_data))
                                        @foreach($game_data as $data)
                                            <option value="{{$data->id}}"
                                                    @if(isset($tour_data) && ($tour_data->game_id != '') && ($tour_data->game_id == $data->id)) selected="selected" @endif>{{ucfirst($data->name)}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('game'))
                                    <span class="roy-vali-error"><small>{{$errors->first('game')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Zone Type: <em>*</em></label><br>
                        <input type="radio" name="zone_type" class="zone_type" value="1"
                                @if($tour_data->region_id != '0') checked="checked" @endif> Region &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="zone_type" class="zone_type" value="2"
                                @if($tour_data->country_id != '0') checked="checked" @endif> Country
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="regn">
                                <label>Region : <em>*</em></label>
                                @php
                                $available_country_id = explode(',', substr($tour_data->country_id, 0, -1));
                                @endphp
                                <select name="region[]" class="form-control multiselect" multiple=>
                                    <option value="">Select Region</option>
                                    @if(isset($regionList))
                                        @foreach($regionList as $region)
                                            <option value="{{$region->id}}"
                                                    @if(isset($tour_data) && ($tour_data->region_id != '') && ($tour_data->region_id == $region->id)) selected="selected" @endif>{{$region->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('region') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="con">
                                <label>Country : <em>*</em></label>
                                @php
                                $available_country_id = explode(',', substr($tour_data->country_id, 0, -1));
                                @endphp
                                <select name="country[]" class="form-control multiselect" multiple=>
                                    <option value="">Select Country</option>
                                    @if(isset($countries))
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if(in_array($country->id, $available_country_id)) selected @endif>
                                            {{ $country->name }}
                                        @endforeach
                                    @endif
                                </select>
                                @error('country') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description :</label>
                                <textarea name="description" id="description" class="form-control"
                                          rows="10">@if(isset($tour_data) && ($tour_data->description != '')){{$tour_data->description}} @endif</textarea>
                            </div>
                        </div>
                    </div>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#description'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Type : <em>*</em></label>
                                <select name="user_type" class="form-control">
                                    <option value="">Select User Ype</option>
                                    <option value="1"
                                            @if(isset($tour_data) && ($tour_data->user_type == '1')) selected="selected" @endif>
                                        Individual
                                    </option>
                                    <option value="2"
                                            @if(isset($tour_data) && ($tour_data->user_type == '2')) selected="selected" @endif>
                                        Team
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date : <em>*</em></label>
                                <input type="text" name="start_date" id="start_date" class="form-control"
                                       value="@if(isset($tour_data) && ($tour_data->start_date != '')){{date('m/d/Y',strtotime($tour_data->start_date))}}@endif">
                                @if($errors->has('start_date'))
                                    <span class="roy-vali-error"><small>{{$errors->first('start_date')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Date : <em>*</em></label>
                                <input type="text" name="end_date" id="end_date" class="form-control"
                                       value="@if(isset($tour_data) && ($tour_data->end_date != '')){{date('m/d/Y',strtotime($tour_data->end_date))}}@endif"
                                       onchange="TournamentDateCheck();">
                                @if($errors->has('end_date'))
                                    <span class="roy-vali-error"><small>{{$errors->first('end_date')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start time : <em>*</em></label> <br>
                                <input type="text" name="start_time" id="start_time" class="form-control"
                                       value="@if(isset($tour_data) && ($tour_data->start_time != '')){{date('h:i A',strtotime($tour_data->start_time))}}@endif">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End time : <em>*</em></label> <br>
                                <input type="text" name="end_time" id="end_time" class="form-control"
                                       value="@if(isset($tour_data) && ($tour_data->end_time != '')){{date('h:i A',strtotime($tour_data->end_time))}}@endif">
                                @if($errors->has('end_time'))
                                    <span class="roy-vali-error"><small>{{$errors->first('end_time')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Registration Start From: <em>*</em></label>
                                <input type="text" name="reg_start_date" id="reg_start_date" class="form-control"
                                       value="@if(isset($tour_data) && ($tour_data->reg_start_date != '')){{$tour_data->reg_start_date}}@endif">
                                @if($errors->has('reg_start_date'))
                                    <span class="roy-vali-error"><small>{{$errors->first('reg_start_date')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Registration End : <em>*</em></label>
                                <input type="text" name="reg_end_date" id="reg_end_date" class="form-control"
                                       onchange="RegistrationDateCheck();"
                                       value="@if(isset($tour_data) && ($tour_data->reg_end_date != '')){{$tour_data->reg_end_date}}@endif">
                                @if($errors->has('reg_end_date'))
                                    <span class="roy-vali-error"><small>{{$errors->first('reg_end_date')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Registration Start time : <em>*</em></label> <br>
                                <input type="text" name="reg_start_time" id="reg_start_time" class="form-control"
                                       autocomplete="off"
                                       value="@if(isset($tour_data) && ($tour_data->reg_start_time != '')){{date('h:i A',strtotime($tour_data->reg_start_time))}}@endif">
                                @if($errors->has('reg_start_time'))
                                    <span class="roy-vali-error"><small>{{$errors->first('reg_start_time')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Registration End time : <em>*</em></label> <br>
                                <input type="text" name="reg_end_time" id="reg_end_time" class="form-control"
                                       autocomplete="off"
                                       value="@if(isset($tour_data) && ($tour_data->reg_end_time != '')){{date('h:i A',strtotime($tour_data->reg_end_time))}}@endif">
                                @if($errors->has('reg_end_time'))
                                    <span class="roy-vali-error"><small>{{$errors->first('reg_end_time')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Add Prize Type : <em>*</em></label><br>
                                <input type="radio" name="prize_type" class="prize_type" value="1"
                                       @if($tour_data->prize_money != '0') checked="checked" @endif> Prize Money &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="prize_type" class="prize_type" value="2"
                                       @if($tour_data->other_reward != '') checked="checked" @endif> Other Rewards
                            </div>
                        </div>
                    </div>

                    <div class="row" id="money"
                         style="display:@if($tour_data->prize_money != '0') block; @else none @endif">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prize Money : <em>*</em></label>
                                <input type="text" name="prize_money" id="prize_money" class="form-control onlyNumber"
                                       autocomplete="off"
                                       value="@if($tour_data->prize_money != '0'){{$tour_data->prize_money}}@endif">
                                @if($errors->has('prize_money'))
                                    <span class="roy-vali-error"><small>{{$errors->first('prize_money')}}</small></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Currency : <em>*</em></label>
                                <select name="prize_currency" id="prize_currency" class="form-control">
                                    <option value="">Select Currency</option>
                                    @if(!empty($currencyList))
                                        @foreach($currencyList as $currency)
                                            <option value="{{$currency->id}}"
                                                    @if(($tour_data->prize_currency != '0') && ($tour_data->prize_currency == $currency->id)) selected="selected" @endif>{{$currency->currency_name}}
                                                ({{$currency->currency_code}})
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('currency'))
                                    <span class="roy-vali-error"><small>{{$errors->first('currency')}}</small></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. of users for prize money distribution:</label>
                                <input type="text" name="no_user_prize_dist" id="noufpmd"
                                       class="form-control onlyNumber"
                                       placeholder="How many users to distribute prize money"
                                       value="@if(isset($tour_data)){{$tour_data->no_user_prize_dist}}@endif">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="button" id="setPercentage" class="btn btn-primary" value="Set Percentage"
                                       style="margin-top: 24px;">
                            </div>
                        </div>
                        <div class="col-md-12" id="AridynaBox" style="background-color: #ccc;">
                            @if(isset($percentageBrakeups) && !empty($percentageBrakeups))

                                <table class="table table-bordered table-sm">
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
                                            <td>Prize Amount Percentage For <strong>Rank-{{ $v->user_rank }}</strong>
                                            </td>
                                            {{--                        <td><input type="text" name="percVal[]" class="percVal artxtb onlyNumber" value="{{ intval($v->percentage_value) }}"> %</td>--}}
                                            <td><input type="text" name="percAmt[]" class="percAmt artxtb"
                                                       value="{{intval($v->percentage_amt)}}"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

                    <div class="row" id="reward"
                         style="display:@if($tour_data->other_reward != '') block; @else none @endif">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Other Reward : <em>*</em></label>
                                <input type="text" name="other_reward" id="other_reward" class="form-control"
                                       autocomplete="off"
                                       value="@if($tour_data->other_reward != ''){{$tour_data->other_reward}}@endif">
                                @if($errors->has('other_reward'))
                                    <span class="roy-vali-error"><small>{{$errors->first('other_reward')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group" style="">
                                <label>Upload an Image : <em>*</em></label>
                                <input type="file" name="image">
                                @if(isset($tour_data) && !empty($tour_data->image))
                                    <br>
                                    <img id="blah" src="{{ asset($tour_data->image) }}" height="100px" weight="150px">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tournament Type: <em>*</em></label><br>
                            <label> <input type="radio" name="tournament_type" class="tournament_type" value="2"
                                           @if(isset($tour_data) && ($tour_data->tournament_type != '1')) checked="checked" @endif>
                                Konck Out</label>
                            <label> <input type="radio" name="tournament_type" class="tournament_type" value="1"
                                           @if(isset($tour_data) && ($tour_data->tournament_type != '2')) checked="checked" @endif>
                                Room wise </label>
                        </div>
                    </div>
                    <div class="row" id="roomk" style="display:none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Maximum Player Allowed: <em>*</em></label>
                                <input type="text" name="max_users" class="form-control"
                                       autocomplete="off"
                                       value="@if(isset($tour_data) && ($tour_data->max_players != '')){{$tour_data->max_players}}@endif">
                                @if($errors->has('max_users'))
                                    <span class="roy-vali-error"><small>{{$errors->first('max_users')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Of Player : <em>*</em></label>
                                <input type="text" name="room_size" id="room_size" class="form-control"
                                       autocomplete="off"
                                       value="@if(isset($tour_data) && ($tour_data->room_size != '')){{$tour_data->room_size}}@endif">
                                @if($errors->has('room_size'))
                                    <span class="roy-vali-error"><small>{{$errors->first('room_size')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row" id="kout" style="display:none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Maximum Player Allowed: <em>*</em></label>
                                <input type="number" name="max_users" id="max_players" class="form-control"
                                       autocomplete="off"
                                       value="@if(isset($tour_data) && ($tour_data->max_players != '')){{$tour_data->max_players}}@endif">
                                @if($errors->has('max_players'))
                                    <span class="roy-vali-error"><small>{{$errors->first('max_players')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Rules :</label>
                                <textarea name="rulesdescription" id="rulesdescription" class="form-control"
                                          rows="10">@if(isset($tour_data) && ($tour_data->rulesdescription != '')){{$tour_data->rulesdescription}}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#rulesdescription'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Participation :</label>
                                <input type="radio" name="is_free" class="is_free" value="1"
                                       @if($tour_data->is_free == '1') checked="checked" @endif> Free &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="is_free" class="is_free" value="0"
                                       @if($tour_data->is_free == '0') checked="checked" @endif> Payable
                            </div>
                        </div>
                    </div>

                    <div class="row" id="part_amount"
                         style="display:@if($tour_data->part_amount == '0') none @else block @endif">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Participation Amount : <em>*</em></label>
                                <input type="text" name="partcipation_amount" id="partcipation_amount"
                                       class="form-control" autocomplete="off" value="{{$tour_data->part_amount}}">
                                @if($errors->has('partcipation_amount'))
                                    <span class="roy-vali-error"><small>{{$errors->first('partcipation_amount')}}</small></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Currency : <em>*</em></label>
                                <select name="part_currency" class="form-control">
                                    <option value="">Select Currency</option>
                                    @if(isset($currencyList))
                                        @foreach($currencyList as $currency)
                                            <option value="{{ $currency->id }}"
                                                    @if(($tour_data->part_currency != '0') && ($tour_data->part_currency == $currency->id)) selected="selected" @endif>{{$currency->currency_name}}
                                                ({{$currency->currency_code}})
                                            </option>
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
                            <div class="form-group">
                                <label>Platforms: </label> <br>
                                @foreach($station as $stn)
                                    <input type="radio" name="ps_number" value="{{$stn->id}}"
                                           @if($stn->id == $tour_data->ps_number)) checked @endif/> {{$stn->name}} &nbsp;&nbsp;
                                    &nbsp;
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status : <em>*</em></label><br>
                                <input type="radio" name="tournament_status" value="1" checked="checked"> Active &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="tournament_status" value="2"> Deactive
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Partner : <em>*</em></label><br>
                                <select class="form-control" name="partner" id="partner">
                                    <option value="Gosu" {{ old("partner", $tour_data->partner) == "Gosu" ? "selected" : "" }}>Gosu Gamers</option>
                                    <!--<option value="flipkart" {{ old("partner", $tour_data->partner) == "flipkart" ? "selected" : "" }}>FlipKart</option>-->
                                </select>
                            </div>
                        </div>
                    </div>



                    <!-- Tournament Points Section -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Participation Point:</label>
                                <input type="text" name="participation_point" id="participation_point" class="form-control" placeholder="Participation Point" value="{{old("participation_point", $tour_data->participation_point)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Winner Point:</label>
                                <input type="text" name="winner_point" id="winner_point" class="form-control" placeholder="Winner Point" value="{{old("winner_point", $tour_data->winner_point)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Runner-Up Point:</label>
                                <input type="text" name="runnerup_point" id="runnerup_point" class="form-control" placeholder="Runner-Up Point" value="{{old("runnerup_point", $tour_data->runnerup_point)}}">
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
                            <div class="form-group">
                                <label>Meta Title:</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="Meta Title"
                                       value="@if(isset($tour_data)){{$tour_data->meta_title}}@endif">
                            </div>
                            <div class="form-group">
                                <label>Meta Keywords:</label>
                                <input type="text" name="metakeyword" class="form-control" placeholder="Meta Keywords"
                                       value="@if(isset($tour_data)){{$tour_data->metakeyword}}@endif">
                            </div>
                            <div class="form-group">
                                <label>Meta Description:</label>
                                <textarea name="metadescription" class="form-control"
                                          placeholder="Meta Description">@if(isset($tour_data)){{$tour_data->metadescription}}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <div class="header-elements">
                            <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link href="{{ asset('new-theme/css/fSelect.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('new-theme/js/fSelect.js') }}"></script>
    <script>
        (function ($) {
            $(function () {
                window.fs_test = $('.multiselect').fSelect();
            });
        })(jQuery);
     </script>
    <script type="text/javascript">
        $(function () {
            $("#start_date").datepicker();
            $("#end_date").datepicker();
            $("#reg_start_date").datepicker();
            $("#reg_end_date").datepicker();
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $("#start_time").timepicker();
            $("#end_time").timepicker();
            $("#reg_start_time").timepicker();
            $("#reg_end_time").timepicker();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.zone_type').change(function () {
                if ($(this).is(":checked")) { // check if the radio is checked
                    var zone = $(this).val(); // retrieve the value
                    if (zone == '1') {
                        $('#regn').show();
                        $('#con').hide();
                    } else if (zone == '2') {
                        $('#con').show();
                        $('#regn').hide();
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.prize_type').change(function () {
                if ($(this).is(":checked")) { // check if the radio is checked
                    var ptype = $(this).val(); // retrieve the value
                    if (ptype == '1') {
                        $('#money').show();
                        $('#reward').hide();
                    } else if (ptype == '2') {
                        $('#reward').show();
                        $('#money').hide();
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.is_free').change(function () {
                if ($(this).is(":checked")) { // check if the radio is checked
                    var free = $(this).val(); // retrieve the value
                    if (free == '0') {
                        $('#part_amount').show();
                    } else {
                        $('#part_amount').hide();
                    }
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(function () {
            $('#setPercentage').on('click', function () {
                var _prCurrency = $.trim($('#prize_currency').val());
                var _prMoney = parseInt($.trim($('#prize_money').val()));
                var _getNOU = parseInt($.trim($('#noufpmd').val()));
                //alert(_getNOU);
                if (_prMoney != '' && _prMoney != 'undefined' && _prCurrency != '' && _prCurrency != 'undefined' && _getNOU != '' && !isNaN(_getNOU)) {

                    var _html = '';
                    _html += '<table class="table table-bordered table-sm">';
                    _html += '<thead>';
                    _html += '<tr>';
                    _html += '<th>Rank</th>';
                    // _html += '<th>Percentage(%)</th>';
                    _html += '<th>Amount</th>';
                    _html += '</tr>';
                    _html += '</thead>';
                    _html += '<tbody>';
                    for (var i = 1; i <= _getNOU; i++) {
                        _html += '<tr>';
                        _html += '<td>Prize Amount Percentage For <strong>Rank-' + i + '</strong></td>';
                        // _html += '<td><input type="text" name="percVal[]" class="percVal artxtb onlyNumber"> %</td>';
                        _html += '<td><input type="text" name="percAmt[]" class="percAmt artxtb"></td>';
                        _html += '</tr>';
                    }
                    _html += '</tbody>';
                    _html += '</table>';

                    $('#AridynaBox').html(_html);
                } else {
                    alert('Please enter prize money, currency, No of distribution');
                }
            });

            $('body').on('blur', '.percVal', function () {
                var totPerc = 0;
                $('.percVal').each(function () {
                    if (!isNaN(parseInt($.trim($(this).val())))) {
                        totPerc = totPerc + parseInt($.trim($(this).val()));
                    }
                });
                if (totPerc <= 100) {
                    var _getPrMoney = parseInt($.trim($('#prize_money').val()));
                    var _getPrcVal = parseInt($.trim($(this).val()));
                    var _getAmt = (_getPrMoney * _getPrcVal) / 100;
                    $(this).closest('tr').find('td:eq(2)').find('.percAmt').val(_getAmt);
                } else {
                    alert('Total Percentage Should Not Grater Than 100%');
                    $(this).val('');
                    $(this).closest('tr').find('td:eq(2)').find('.percAmt').val('');
                }
            });

            $('body').on('blur', '.percAmt', function () {
                var totAmt = 0;
                $('.percAmt').each(function () {
                    if (!isNaN(parseInt($.trim($(this).val())))) {
                        totAmt = totAmt + parseInt($.trim($(this).val()));
                    }
                });
                var price = $('#prize_money').val()
                if (totAmt >= price) {
                    alert(`Total distribution price Should Not Grater Than ${price}`);
                    $(this).val('');
                    $(this).closest('tr').find('td:eq(2)').find('.percAmt').val('');
                }
            });
        });
    </script>


    {{-- <script type="text/javascript">
        $('#frmx').validate({
            errorElement: 'span',
            errorClass: 'roy-vali-error',
            rules: {

                tournament_name: {
                    required: true
                },
                /*slug: {
                   required: true,
                   nowhitespace: true,
                   pattern: /^[A-Za-z\d-.]+$/,
                   remote:{
                     url: "{{ route('checkSlugUrl') }}",
          type: "post",
          data: {
            "slug_url": function() {
              return $( "#pgSlug" ).val();
            },
            "_token": function() {
              return "{{ csrf_token() }}";
            },
            "id": function() {
              return $( "#table_id" ).val();
            },
            "row_id": function() {
              return $( "#row_id" ).val();
            }
          }
        }
      },*/
                game: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                start_time: {
                    required: true
                },
                end_time: {
                    required: true
                },
                reg_start_date: {
                    required: true
                },
                reg_end_date: {
                    required: true
                },
                reg_start_time: {
                    required: true
                },
                reg_end_time: {
                    required: true
                },
                zone_type: {
                    required: true
                },
                max_players: {
                    required: true,
                    number: true
                },
                room_size: {
                    required: true,
                    number: true
                }
            },

            messages: {

                tournament_name: {
                    required: 'Please Enter a name.'
                },
                slug: {
                    required: 'Please Enter Page URL or Link.',
                    nowhitespace: 'White Space or Blank Space Not Allowed, Use Hyphen.',
                    pattern: 'Any Special Character Not Allowed, Except Hyphen.',
                    remote: 'This URL Already Exist, Try Another.'
                },
                game: {
                    required: 'Please Select a game.'
                },
                start_date: {
                    required: 'Please Select a Start Date.'
                },
                end_date: {
                    required: 'Please Select a End Date.'
                },
                start_time: {
                    required: 'Please Enter a Start Time.'
                },
                end_time: {
                    required: 'Please Enter a End Time.'
                },
                reg_start_date: {
                    required: 'Please Enter Registration Start Date.'
                },
                reg_end_date: {
                    required: 'Please Enter Registration End Date.'
                },
                reg_start_time: {
                    required: 'Please Enter Registration Start Time.'
                },
                reg_end_time: {
                    required: 'Please Enter Registration End Time.'
                },
                zone_type: {
                    required: 'Please select zone type.'
                },
                max_players: {
                    required: 'Please enter maximum number of players.',
                    number: 'Please enter numeric value'
                },
                room_size: {
                    required: 'Please enter room size.',
                    number: 'Please enter numeric value'
                }

            }
        });
        $('#tournament_name').on('blur', function () {
            if ($.trim($(this).val()) != '') {
                $('#pgSlug').val(string_to_slug($(this).val()));
            }
        });

        function string_to_slug(str) {
            str = str.replace(/^\s+|\s+$/g, "");
            str = str.toLowerCase();
            var from = "åàáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to = "aaaaaaeeeeiiiioooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
            }
            str = str
                .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
                .replace(/\s+/g, "-") // collapse whitespace and replace by -
                .replace(/-+/g, "-") // collapse dashes
                .replace(/^-+/, "") // trim - from start of text
                .replace(/-+$/, ""); // trim - from end of text
            return str;
        }
    </script> --}}

    <script type="text/javascript">
        function TournamentDateCheck() {
            var StartDate = $('#start_date').val();
            var EndDate = $('#end_date').val();
            var eDate = new Date(EndDate);
            var sDate = new Date(StartDate);
            if (StartDate != '' && StartDate != '' && sDate > eDate) {
                alert("Please ensure that the End Date is greater than or equal to the Start Date.");
                $('#end_date').val('');
                return false;
            }
        }

        function RegistrationDateCheck() {
            var StartDate = $('#reg_start_date').val();
            var EndDate = $('#reg_end_date').val();
            var eDate = new Date(EndDate);
            var sDate = new Date(StartDate);
            if (StartDate != '' && StartDate != '' && sDate >= eDate) {
                alert("Please ensure that the End Date is greater than to the Start Date.");
                $('#reg_end_date').val('');
                return false;
            }
        }


    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.tournament_type').change(function () {
                if ($(this).is(":checked")) { // check if the radio is checked
                    var tourtype = $(this).val(); // retrieve the value
                    if (tourtype == '1') {
                        $('#roomk').show();
                        $('#kout').hide();
                    } else if (tourtype == '2') {
                        $('#kout').show();
                        $('#roomk').hide();
                    }
                }
            });
        });
    </script>


@endsection


