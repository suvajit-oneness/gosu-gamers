@extends("website.layouts.master")
@section("content")
<section class="banner__area inner">
   <img src="{!!asset('letsgamenow/images/leaderboard-ban.jpg')!!}" class="img-fluid">
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
@php $i=0; @endphp
@foreach($stages as $stage)
   @if($i<6)
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


{{--      <ul class="fixture__list">--}}
      <div class="row">

      @php $match=1; @endphp
      @foreach($stage->schedules as $schedule)
{{--         <li>--}}
            <div class="fixture__box col-sm-3" style="background-color: #10133c;">
               <div class="py-3" style="background-color: #ffffff;">


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
{{--         </li>--}}
         @php $match++; @endphp
         @endforeach


      </div>
{{--      </ul>--}}


   </div>
   <div class="clearfix"></div>
   @php $i++; @endphp
   @endif
@endforeach
  <!-- <div class="title__area text-center">
      <div class="section__title">Quarter Final</div>
      <div class="section__subtitle">Fixture</div>
   </div> 
   <div class="clearfix"></div>
   <div class="container mt-5 mb-5">
      <ul class="fixture__list"> 
          <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 1<br/><span>22-Sep-2020 04:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Radiant esports</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>DropShot</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 2<br/><span>22-Sep-2020 05:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>DropShot</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Velocity Gaming</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 3<br/><span>22-Sep-2020 06:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Villainous</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>DropShot</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 4<br/><span>22-Sep-2020 07:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Velocity Gaming</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Radiant esports</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 5<br/><span>22-Sep-2020 08:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Radiant esports</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Villainous</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 6<br/><span>22-Sep-2020 09:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Velocity Gaming</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Villainous</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 7<br/><span>23-Sep-2020 04:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Nezuko Gaming</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Villainous</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 8<br/><span>23-Sep-2020 05:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Team Invictus</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>K/D Fixers</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 9<br/><span>23-Sep-2020 06:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Thane Peek</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>K/D Fixers</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 10<br/><span>23-Sep-2020 07:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Team Invictus</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Thane Peek</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
          <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 11<br/><span>23-Sep-2020 08:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>K/D Fixers </td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Nezuko Gaming</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 12<br/><span>23-Sep-2020 09:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Nezuko Gaming</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Team Invictus</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
      </ul>
    </div>
    <div class="title__area text-center">
      <div class="section__title">Semi Final</div>
      <div class="section__subtitle">Fixture</div>
   </div> 
   <div class="clearfix"></div>
   <div class="container mt-5 mb-5">
      <ul class="fixture__list">
        <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 1<br/><span>24-Sep-2020 05:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Velocity Gaming</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Nezuko Gaming</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
         <li>
            <div class="fixture__box">
               <table>
                  <caption>Match 2<br/><span>25-Sep-2020 05:00 pm</span></caption>
                  <thead class="sr-only">
                     <tr>
                        <th>Player</th>
                        <th>Score</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Team Invictus</td>
                        <td><span></span></td>
                     </tr>
                     <tr>
                        <td>Villainous</td>
                        <td><span></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </li>
      </ul>
    </div> -->
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
   <div class="clearfix p-5"></div>
   <div class="container mt-5">
      <div class="title__area text-center">
         <div class="section__title"><img data-aos="zoom-in" data-aos-easing="ease-in-back" data-aos-duration="1000" src="{!!asset('letsgamenow/images/foot-logo.png')!!}"></div>
         <div class="section__subtitle">About Us</div>
      </div>
   </div>
   <div class="clearfix"></div>
   <div class="container-fluid mt-5 mb-5">
      <div class="about_text" data-aos="fade-up" data-aos-easing="ease-in-back" data-aos-duration="1000">
         <p>Lets Game Now is a simple to use esports portal for all types of gamers. With a variety of online tournaments, gamer will get the chance to qualify for international tournaments, get noticed and build a career as a professional, or just play for fun against friend and compete regularly for cash prizes.</p>
      </div>
   </div>
</section>

@endsection

