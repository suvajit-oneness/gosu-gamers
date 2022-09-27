@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")
<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Gamer Tournament Schedule Details</h2>
</section>
<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>

<div class="container">
  <div><a href="{{ route('gamer.tournaments.show',$user->id) }}" class="edit__team__member text-decoration-none text-light float-right my-3">Back</a>
  </div>
    <div class="team__member__list__table">
      <div class="table-responive">
        <table class="table">
          <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Tournament Name</th>
            <th class="text-center" scope="col">player1</th>
            <th class="text-center" scope="col">player2</th>
            <th class="text-center" scope="col">Winner</th>
            <th class="text-center" scope="col">Stage</th>
            <th class="text-center" scope="col">Action</th>
          </tr>
          <?php $slno = 1; ?>
          @if($gamertournamentschedule)
          @foreach($gamertournamentschedule as $data)
            <tr>
              <td>{{$slno}}</td>
              <td class="text-center">{{$data->tname}}</td>
              <td class="text-center">{{$data->Player1fname}} {{$data->Player1lname}} {{$data->Player1email}}</td>
              <td class="text-center">{{$data->Player2fname}} {{$data->Player2lname}} {{$data->Player2email}}</td>
              <td class="text-center">{{$data->Player3fname}} {{$data->Player3lname}} {{$data->Player3email}}</td>
              <td class="text-center">{{$data->stage}}</td>
              <td>
              <a class="badge bg-primary text-light m-2"href="{{route('gamer.tournaments.gamertournamentschedule.edit',$data->id)}}">Select Winner</a>
              </td>
            </tr>
          <?php $slno = $slno + 1; ?>  
          @endforeach
          @endif
        </table>
      </div>
      </div>
</div>

<div class="clearfix p-5">

{{-- <div class="container">
    <div class="bracket">
        <section class="round quarterfinals">
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant winner"><span>Uno</span></div>
                            <div class="participant"><span>Ocho</span></div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant"><span>Dos</span></div>
                            <div class="participant winner"><span>Siete</span></div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant"><span>Treis</span></div>
                            <div class="participant winner"><span>Seis</span></div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant"><span>Cuatro</span></div>
                            <div class="participant winner"><span>Cinco</span></div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant"><span>Treis</span></div>
                            <div class="participant winner"><span>Seis</span></div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant"><span>Cuatro</span></div>
                            <div class="participant winner"><span>Cinco</span></div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant"><span>Treis</span></div>
                            <div class="participant winner"><span>Seis</span></div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant"><span>Cuatro</span></div>
                            <div class="participant winner"><span>Cinco</span></div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
        </section>
        <section class="round semifinals">
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant winner"><span>Uno</span></div>
                            <div class="participant"><span>Dos</span></div>
                        </div>
                    </div>
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant winner"><span>Seis</span></div>
                            <div class="participant"><span>Cinco</span></div>
                        </div>
                    </div>
                </div>
                <div class="connector">
                    <div class="merger"></div>
                    <div class="line"></div>
                </div>
            </div>
        </section>
        <section class="round finals">
            <div class="winners">
                <div class="matchups">
                    <div class="matchup">
                        <div class="participants">
                            <div class="participant winner"><span>Uno</span></div>
                            <div class="participant"><span>Seis</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
    </div>
</div> --}}

</section>
@endsection

