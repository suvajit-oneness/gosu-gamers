@extends("admin.layouts.master")


@section("content")

    <div class="content">
        <div class="card">
            <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "
                    href="{{ route('tournaments.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
            <div class="card-body">
                <h5 class="card-title">Add Tournaments</h5>
                <form name="frm" id="frmx" method="post" enctype="multipart/form-data"
                      action="{{route('tournaments.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name : <em>*</em></label>
                                <input type="text" name="tournament_name" id="tournament_name"
                                       class="typeahead form-control " placeholder="Tournament Name" autocomplete="off">
                                @error('name') {{$message}} @enderror
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
                                <select name="game_id" id="game_id" class="form-control">
                                    <option value="">-Select Game-</option>
                                    @if(isset($game))
                                        @foreach($game as $data)
                                            <option value="{{ $data->id }}">{{ ucfirst($data->name) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('game_id'))
                                    <span class="roy-vali-error"><small>{{$errors->first('game_id')}}</small></span>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Zone Type: <em>*</em></label><br>
                                        <input type="radio" name="zone_type" class="zone_type" value="1"> Region &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="zone_type" class="zone_type" value="2"> Country
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="con" style="display:none;">
                                        <label>Country : <em>*</em></label>
                                        <select name="country_id[]" class="form-control multiselect"
                                                multiple="multiple">
                                            <option value="">---Select Region---</option>
                                            @if(isset($country))
                                                @foreach($country as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group" id="regn" style="display:none;">
                                        <label>Region : <em>*</em></label>
                                        <select name="region_id[]" class="form-control multiselect" multiple="multiple">
                                            <option value="">---Select Region---</option>
                                            @if(isset($regions))
                                                @foreach($regions as $regions)
                                                    <option value="{{ $regions->id }}">{{ $regions->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description :</label>
                                        <textarea name="description" id="description" class="form-control"
                                                  rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>User Type : <em>*</em></label>
                                        <select name="user_type" class="form-control">
                                            <option value="">Select User Type</option>
                                            <option value="1">Individual</option>
                                            <option value="2">Team</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date : <em>*</em></label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                               autocomplete="off">
                                        @if($errors->has('start_date'))
                                            <span class="roy-vali-error"><small>{{$errors->first('start_date')}}</small></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date : <em>*</em></label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                               autocomplete="off">
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
                                        <input type="time" name="start_time" id="start_time" class="form-control"
                                               autocomplete="off">
                                        @if($errors->has('start_time'))
                                            <span class="roy-vali-error"><small>{{$errors->first('start_time')}}</small></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End time : <em>*</em></label> <br>
                                        <input type="time" name="end_time" id="end_time" class="form-control"
                                               autocomplete="off">
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
                                        <input type="date" name="reg_start_date" id="reg_start_date"
                                               class="form-control" autocomplete="off">
                                        @if($errors->has('reg_start_date'))
                                            <span class="roy-vali-error"><small>{{$errors->first('reg_start_date')}}</small></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Registration End : <em>*</em></label>
                                        <!-- <input type="text" name="reg_end_date" id="reg_end_date" class="form-control" onchange="RegistrationDateCheck();" autocomplete="off"> -->
                                        <input type="date" name="reg_end_date" id="reg_end_date" class="form-control"
                                               autocomplete="off">
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
                                        <input type="time" name="reg_start_time" id="reg_start_time"
                                               class="form-control" autocomplete="off">
                                        @if($errors->has('reg_start_time'))
                                            <span class="roy-vali-error"><small>{{$errors->first('reg_start_time')}}</small></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Registration End time : <em>*</em></label> <br>
                                        <input type="time" name="reg_end_time" id="reg_end_time" class="form-control"
                                               autocomplete="off">
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
                                        <input type="radio" name="prize_type" class="prize_type" value="1"> Prize Money
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="prize_type" class="prize_type" value="2"> Other
                                        Rewards
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="money" style="display:none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Prize Money : <em>*</em></label>
                                        <input type="text" name="prize_money" id="prize_money"
                                               class="form-control onlyNumber" autocomplete="off">
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
                                            @if(isset($currencyList))
                                                @foreach($currencyList as $currency)
                                                    <option value="{{ $currency->id }}">{{ $currency->currency_name }}
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
                                               placeholder="How many users to distribute prize money">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="button" id="setPercentage" class="btn bg-teal-400"
                                               value="Set Percentage" style="margin-top: 24px;">
                                    </div>
                                </div>
                                <div class="col-md-12" id="AridynaBox" style="background-color: #ccc;"></div>
                            </div>

                            <div class="row" id="reward" style="display:none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Other Reward : <em>*</em></label>
                                        <input type="text" name="other_reward" id="other_reward" class="form-control"
                                               autocomplete="off">
                                        @if($errors->has('other_reward'))
                                            <span class="roy-vali-error"><small>{{$errors->first('other_reward')}}</small></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="">
                                        <label>Upload an Image : <em>*</em></label>
                                        <input type="file" name="image">
                                        @error('image') {{$message}} @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tournament Type: <em>*</em></label><br>
                                    <label> <input type="radio" name="tournament_type" class="tournament_type"
                                                   value="2"> Konck Out</label>
                                    <label> <input type="radio" name="tournament_type" class="tournament_type"
                                                   value="1"> Room wise </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Maximum Player Allowed: <em>*</em></label>
                                        <input type="number" name="max_players" id="max_players" class="form-control"
                                               autocomplete="off">
                                        @if($errors->has('max_players'))
                                            <span class="roy-vali-error"><small>{{$errors->first('max_players')}}</small></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6" id="roomk" style="display:none;">
                                    <div class="form-group">
                                        <label>No. Of Player : <em>*</em></label>
                                        <input type="number" name="room_size" id="room_size" class="form-control"
                                               autocomplete="off">
                                        @if($errors->has('room_size'))
                                            <span class="roy-vali-error"><small>{{$errors->first('room_size')}}</small></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Rules :</label>
                                        <textarea name="rulesdescription" id="rulesdescription" class="form-control"
                                                  rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Participation :</label>
                                        <input type="radio" name="is_free" class="is_free" value="1"> Free &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="is_free" class="is_free" value="0"> Payable
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="part_amount" style="display:none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Participation Amount : <em>*</em></label>
                                        <input type="text" name="partcipation_amount" id="partcipation_amount"
                                               class="form-control" autocomplete="off">
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
                                                    <option value="{{ $currency->id }}">{{ $currency->currency_name }}
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

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Platforms: </label> <br>
                                        @foreach($station as $stn)
                                            <input type="radio" name="ps_number"
                                                   value="{{ $stn->id }}"/> {{ $stn->name }} &nbsp;&nbsp;&nbsp;
                                            @error('ps_number') {{$message}} @enderror
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status : <em>*</em></label><br>
                                        <input type="radio" name="tournament_status" value="1" checked="checked"> Active
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="tournament_status" value="0"> Deactive
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Partner : <em>*</em></label><br>
                                        <select class="form-control" name="partner" id="partner">
                                            <option value="Gosu" {{ old("partner") == "Gosu" ? "selected" : "" }}>Gosu Gamers</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- Tournament Points Section -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Participation Point:</label>
                                        <input type="text" name="participation_point" id="participation_point" class="form-control" placeholder="Participation Point" value="{{old("participation_point", 250)}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Winner Point:</label>
                                        <input type="text" name="winner_point" id="winner_point" class="form-control" placeholder="Winner Point" value="{{old("winner_point", 1000)}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Runner-Up Point:</label>
                                        <input type="text" name="runnerup_point" id="runnerup_point" class="form-control" placeholder="Runner-Up Point" value="{{old("runnerup_point", 500)}}">
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
                                        <input type="text" name="meta_title" class="form-control"
                                               placeholder="Meta Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keywords:</label>
                                        <input type="text" name="metakeyword" class="form-control"
                                               placeholder="Meta Keywords">
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description:</label>
                                        <textarea name="metadescription" class="form-control"
                                                  placeholder="Meta Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            </fieldset>

                            <div class="text-left">
                                <div class="header-elements">
                                    <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save
                                    </button>
                                    <a href="{{route('tournaments.create')}}" class="btn bg-teal-400 ml-2"><i
                                                class="fas fa-redo mr-1"></i> Clear</a>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>



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



    <script type="text/javascript">

        $(function () {

            $("#start_date").datepicker();

            $("#end_date").datepicker();

            $("#reg_start_date").datepicker();

            $("#reg_end_date").datepicker();

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
                price++
                if (totAmt >= price) {
                    price--

                    alert(`Total distribution price Should Not Grater Than ${price}`);

                    $(this).val('');

                    $(this).closest('tr').find('td:eq(2)').find('.percAmt').val('');

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


        $('#frmx').validate({

            errorElement: 'span',

            errorClass: 'roy-vali-error',

            rules: {


                tournament_name: {

                    required: true

                },

                slug: {

                    required: true,

                    nowhitespace: true,

                    pattern: /^[A-Za-z\d-.]+$/,

                    remote: {

                        url: "{{ route('checkSlugUrl') }}",

                        type: "post",

                        data: {

                            "slug_url": function () {

                                return $("#pgSlug").val();

                            },

                            "_token": function () {

                                return "{{ csrf_token() }}";

                            },

                            "id": function () {

                                return $("#table_id").val();

                            },

                            "row_id": function () {

                                return $("#row_id").val();

                            }

                        }

                    }

                },

                game_id: {

                    required: true

                },

                user_type: {

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

                prize_type: {

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

                },

                is_free: {

                    required: true

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

                game_id: {

                    required: 'Please Select a game.'

                },

                user_type: {

                    required: 'Please Select a user type.'

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

                prize_type: {

                    required: 'Please Enter Prize Type.'

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

                },

                is_free: {

                    required: 'Please Enter Participation Amount.'

                }

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

    </script>

    <link href="{{ asset('new-theme/css/fSelect.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/typehead.js') }}"></script>
    <script src="{{ asset('new-theme/js/fSelect.js') }}"></script>
    <script type="text/javascript">

        var path = "{{ route('autocomplete') }}";

        $('input.typeahead').typeahead({

            source: function (query, process) {

                return $.get(path, {query: query}, function (data) {

                    return process(data);

                });

            }

        });

    </script>


    <script>
        (function ($) {
            $(function () {
                window.fs_test = $('.multiselect').fSelect();
            });
        })(jQuery);
    </script>

    <script type="text/javascript">
        CKEDITOR.replace('description');
        CKEDITOR.replace('rulesdescription');
        CKEDITOR.replace('metadescription');
    </script>


@endsection



