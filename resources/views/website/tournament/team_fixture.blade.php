@extends("website.layouts.master")
@section("content")
<section class="banner__area inner">
   <!-- <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid"> -->
   <h2 class="text-center">{{$tournaments->name}}</h2>
   <div class="news__ticker">
      <span>Upcoming Tournaments</span>
      <div id="carouselTicker" class="carouselTicker">
         <ul class="carouselTicker__list">
            <!-- <li class="carouselTicker__item">
               <a href="" class="ticker_cat bg-primary">Strategy</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
            </li>
            <li class="carouselTicker__item">
               <a href="" class="ticker_cat bg-success">Shooter</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
            </li>
            <li class="carouselTicker__item">
               <a href="" class="ticker_cat bg-danger">Adventure</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
            </li>
            <li class="carouselTicker__item">
               <a href="" class="ticker_cat bg-warning">RPG</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
            </li>
            <li class="carouselTicker__item">
               <a href="" class="ticker_cat bg-info">Racing</a><a href="#">Mollis leo semper dictum ras ut magna met</a>
            </li> -->
         </ul>
      </div>
   </div>
</section>

<section class="sponser_bg pt-5 pb-5">
@foreach($stages as $stage)
   @php
   $stage_name = '';

   if(count($stage->schedules)==1){
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
      <ul class="fixture__list">   
      @php $match=1; @endphp
      @foreach($stage->schedules as $schedule)
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match {{$match }}<br/><span>{{date("d-M-Y",strtotime($schedule->start_date))}} {{date("h:i a",strtotime($schedule->start_time))}}</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        @if($schedule->team1_name!='')
                        <td>{{$schedule->team1_name}} </td>
                        @else
                        <td>BYE</td>
                        @endif
                        <td><span>{{$schedule->team1_score}}</span></td>
                     </tr>
                     <tr>
                        @if($schedule->team2_name!='')
                        <td>{{$schedule->team2_name}}</td>
                        @else
                        <td>BYE</td>
                        @endif
                        <td><span>{{$schedule->team2_score}}</span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         @php $match++; @endphp
         @endforeach
      </ul>
   </div>
   <div class="clearfix"></div>
@endforeach

   <!-- <div class="container mt-5 mb-5">
      <div class="familyTree">
      
        <div class="generation" id="grandParents">
          <div class="pair">
            <div class="card-m"><span>Team 1</span></div>
            <div class="card-f"><span>Team 3</span></div>
          </div>
          
          <div class="pair">
            <div class="card-m"><span>Team 2</span></div>
            <div class="card-f"><span>Team 4</span></div>
          </div>
          <div class="pair">
            <div class="card-m"><span>Team 5</span></div>
            <div class="card-f"><span>Team 7</span></div>
          </div>
          <div class="pair">
            <div class="card-m"><span>Team 6</span></div>
            <div class="card-f"><span>Team 8</span></div>
          </div>
        </div>
        
        <div class="generation" id="parents">
            <div class="pair">
              <div class="card-m"><h5>Quarter Final 1</h5><span>Team 1</span></div>
              <div class="card-f"><h5>Quarter Final 2</h5><span>Team 4</span></div>
            </div>
      
            <div class="pair">
              <div class="card-m"><h5>Quarter Final 3</h5><span>Team 5</span></div>
              <div class="card-f"><h5>Quarter Final 4</h5><span>Team 8</span></div>
            </div>
        </div>
      
        <div class="generation" id="parents">
            <div class="pair">
              <div class="card-m"><h5>Semi Final 1</h5><span>Team 1</span></div>
              <div class="card-f"><h5>Semi Final 2</h5><span>Team 8</span></div>
            </div>
      
        </div>
        
        <div class="generation" id="child">
          <div class="card-m"><h5>Finale</h5><span>Team 1</span></div>
        </div>
      </div>
      
      </div> -->

</section>

@endsection

