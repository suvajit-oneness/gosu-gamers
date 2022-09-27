@extends("website.layouts.master")
@section("content")
<section class="banner__area inner">
   <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->
   <h2 class="text-center">{{$tournaments->name}}</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
   @php
   $total_user = \App\Models\Gamers_tournaments::where('tournament_id', $tournaments->id)->count();
   @endphp
   @if($total_user > 4)
   <div class="container tournament-container">
      <main id="tournament">
         @php
         $s = 1;
         @endphp
            @foreach($stages as $stage)
               @if($stage->stage<=$s)
               <ul class="round round-{{ $s }}">
                  @foreach($stage->schedules as $schedule)
                  <li class="spacer">&nbsp;</li>
                  <li class="game game-top @if($schedule->winner_point) @if($schedule->winner_point>$schedule->runner_point)winner-color @else runner-color
                           @endif
                     @endif
                     ">
                     @if($schedule->player1_name!='')
                     {{ $schedule->player1_name }}
                     @else
                     BYE
                     @endif
                     {{-- <span>{{$schedule->player1_score ? $schedule->player1_score : ""}}</span> --}}
                     {{-- <small class="d-block">{{date("d-M-Y",strtotime($schedule->start_date))}} / {{date("h:i A",strtotime($schedule->start_time))}}</small> --}}
                  </li>
                  <li class="game game-spacer">&nbsp;</li>
                  <li class="game game-bottom 
                           @if($schedule->runner_point)
                           @if($schedule->runner_point>$schedule->winner_point)
                     winner-color
                           @else
                           runner-color
                           @endif
                     @endif">
                     @if($schedule->player2_name!='')
                     {{$schedule->player2_name}}
                     @else
                     BYE
                     @endif
                     {{-- <span>{{$schedule->player2_score ? $schedule->player2_score : $schedule->player2_score}}</span> --}}
                  </li>
                  <li class="spacer">&nbsp;</li>
                  @endforeach
               </ul>
               @endif
               @php
               $s++;
               @endphp
            @endforeach
                {{--@if($stages)
                  @if($schedule->final_winner)
                     <div class="win_trophy">
                        <div class="win">
                           <img src="{{ asset('letsgamenow/images/win/trophy.png') }}">
                           @php
                           $getGamer = App\Models\Gamer::where('id', $schedule->winner)->first();
                           @endphp
                           <p>{{ $getGamer->fname }}</p>
                        </div>
                     </div>
                  @endif
               @endif--}}
            
      </main>
   </div>
   @else
   @php $i=0; @endphp
      @foreach($stages as $stage)
      @if($i<6) @php $stage_name='' ; if(count($stage->schedules)==1){
         $stage_name = 'Final';
         }else if(count($stage->schedules)==2){
         $stage_name = 'Semi Final';
         }else if(count($stage->schedules)==4){
         $stage_name = 'Quarter Final';
         }else{
         $stage_name = 'Round '.$stage->stage;
         }
         @endphp
         <div class="title__area text-center">
               <div class="section__title">{{$stage_name}}</div>
               <div class="section__subtitle">Fixture</div>
         </div>
         <div class="clearfix"></div>
         <div class="container mt-5 mb-5">
               <div class="row">
                  @php $match=1; @endphp
                  @foreach($stage->schedules as $schedule)
                  <div class="fixture__box col-sm-3" style="background-color: #10133c;">
                     <div class="py-3" style="background-color: #ffffff;">
                           <table>
                              <caption>Match {{$match }}<br /><span>{{date("d-M-Y",strtotime($schedule->start_date))}}
                                       {{date("h:i a",strtotime($schedule->start_time))}}</span></caption>
                              <thead class="sr-only">
                                 <tr>
                                       <th>Player</th>
                                       <th>Score</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                       @if($schedule->player1_name!='')
                                       <!-- <td>{{$schedule->player1_name}} <br>(PSN : {{$schedule->player1_psn}})</td> -->
                                       <td>{{$schedule->player1_name}}</td>
                                       @else
                                       <td>BYE</td>
                                       @endif
                                       <td><span>{{$schedule->player1_score}}</span></td>
                                 </tr>
                                 <tr>
                                       @if($schedule->player2_name!='')
                                       <!-- <td>{{$schedule->player2_name}} <br>(PSN : {{$schedule->player2_psn}})</td> -->
                                       <td>{{$schedule->player2_name}}</td>
                                       @else
                                       <td>BYE</td>
                                       @endif
                                       <td><span>{{$schedule->player2_score}}</span></td>
                                 </tr>
                              </tbody>
                           </table>
                     </div>
                  </div>
                  @php $match++; @endphp
                  @endforeach
               </div>
         </div>
         <div class="clearfix"></div>
      @php $i++; @endphp
      @endif
      @endforeach
   @endif
</section>

@endsection

