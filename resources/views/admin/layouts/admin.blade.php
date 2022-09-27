@extends("admin.layouts.master")
@section("content")
<div class="content">
   <!-- Dashboard content -->
   <div class="row">
      <div class="col-xl-12">
         <!-- Quick stats boxes -->
         <div class="row">
            <div class="col-lg-3">
               <!-- Members online -->
               <div class="card bg-teal-400">
                  <div class="card-body">
                     <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0">{{$data['total_tournaments'][0]->total_tournaments}}</h3>
                        <!-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
                     </div>
                     <div>
                        Total Tournaments
                        <!-- <div class="font-size-sm opacity-75">489 avg</div> -->
                     </div>
                     <a href="{{route('tournaments.index')}}"class="small-box-footer">More info</a>
                  </div>
                  <div class="container-fluid">									
                  </div>
               </div>
               <!-- /members online -->
            </div>
            <div class="col-lg-3">
               <!-- Members online -->
               <div class="card bg-pink-400">
                  <div class="card-body">
                     <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0">{{$data['total_teams'][0]->total_gamers}}</h3>
                        <!-- <span class="badge bg-pink-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
                     </div>
                     <div>
                        Total Teams
                        <!-- <div class="font-size-sm opacity-75">489 avg</div> -->
                     </div>
                     <a href="{{route('teams.index')}}"class="small-box-footer">More info</a>
                  </div>
                  <div class="container-fluid">									
                  </div>
               </div>
               <!-- /members online -->
            </div>
            <div class="col-lg-3">
               <!-- Members online -->
               <div class="card bg-blue-400">
                  <div class="card-body">
                     <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0">{{$data['total_gamers'][0]->total_gamers}}</h3>
                        <!-- <span class="badge bg-blue-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
                     </div>
                     <div>
                        Total Gamers
                        <!-- <div class="font-size-sm opacity-75">489 avg</div> -->
                     </div>
                     <a href="{{route('gamers.index')}}"class="small-box-footer">More info</a>
                  </div>
                  <div class="container-fluid">
                  </div>
               </div>
               <!-- /members online -->
            </div>
            <div class="col-lg-3">
               <!-- Members online -->
               <div class="card bg-green-400">
                  <div class="card-body">
                     <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0">{{$data['ongoing_tournaments'][0]->ongoing_tournaments}}</h3>
                        <!-- <span class="badge bg-green-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
                     </div>
                     <div>
                        Ongoing Tournaments
                        <!-- <div class="font-size-sm opacity-75">489 avg</div> -->
                     </div>
                     <a href="{{route('tournaments.index')}}"class="small-box-footer">More info</a>
                  </div>
                  <div class="container-fluid">									
                  </div>
               </div>
               <!-- /members online -->
            </div>
         </div>
         <!-- /quick stats boxes -->
      </div>
   </div>
  
   <!-- /dashboard content -->
   <div class="row">
      <div class="col-md-6">
         <div class="card ">
            <div class="content-header" style="margin-top:8px;margin-left:10px;" >
               <a href="{{Route('tournaments.index')}}"><b>Tournaments</b></a>
            </div>
            <div class="content">
               <div class="table">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Name</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Prize </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $slno = 1; ?>
                        @if($tournaments)
                        @foreach($tournaments as $tournaments)
                        <tr>
                           <td>{{$slno}}</td>
                           <td>{{substr($tournaments->name,0,11)}}..</td>
                           <td>{{$tournaments->start_date}}</td>
                           <td >{{$tournaments->end_date}}</td>
                           <td >{{$tournaments->prize_money}}</td>
                        </tr>
                        <?php $slno = $slno + 1; ?>    
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="card ">
            <div class="content-header" style="margin-top:8px;margin-left:10px;">
               <a href="{{Route('gamers.index')}}"> <b> Gamer</b></a>
            </div>
            <div class="content">
               <div class="table">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Frist Name</th>
                           <th>Last Name</th>
                           <th>Mobile No.</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $slno = 1; ?>
                        @if($gamer)
                        @foreach($gamer as $gamer)
                        <tr>
                           <td>{{$slno}}</td>
                           <td>{{substr($gamer->fname,0,11)}}..</td>
                           <td>{{$gamer->lname}}</td>
                           <td >{{$gamer->mobile}}</td>
                        </tr>
                        <?php $slno = $slno + 1; ?>    
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
    <!-- /Count content -->
    <div class="row">
      <div class="col-md-6">
         <div class="card ">
            <div class="content-header" style="margin-top:8px;margin-left:10px;" >
               <a href="#"><b>Registration(Gamers)</b></a>
            </div>
            <div class="content">
               <div class="table">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Count</th>
                           <th>Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($dates as $date => $count) 
                        <tr>
                           <td>{{$count->count}}</td>
                           <td>{{$count->date}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- {{-- <div class="col-md-3">
         <div class="card ">
            <div class="content-header" style="margin-top:8px;margin-left:10px;">
               <a href="#"> <b> Social Media share</b></a>
            </div>
            <div class="content">
               <div class="table">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>SL no</th>
                           <th>Date</th>
                           <th>Count</th>
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div> --}} -->
      <div class="col-md-6">
         <div class="card ">
            <div class="content-header" style="margin-top:8px;margin-left:10px;" >
               <a href="#"><b>All referrer</b></a>
            </div>
            <div class="content">
               <div class="table">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Count</th>
                           <th>Referrer</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if($totalreferrer)
                        @foreach($totalreferrer as $totalreferrer)
                        <tr>
                           <td >{{$totalreferrer->count}}</td>
                           <td >{{$totalreferrer->referrer}}</td>
                        </tr>   
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="card ">
            <div class="content-header" style="margin-top:8px;margin-left:10px;">
               <a href="#"> <b> Vouchers Redeemed</b></a>
            </div>
            <div class="content">
               <div class="table">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Count</th>
                           <th>Points</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if($gamer_points)
                        @foreach($gamer_points as $gamer_points)
                        @if($gamer_points->points == -500 || $gamer_points->points == -1500 || $gamer_points->points == -1000 || $gamer_points->points == -750)
                        <tr>
                           <td >{{$gamer_points->count}}</td>
                           <td >{{$gamer_points->points}}</td>
                        </tr>  
                        @endif 
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="card ">
            <div class="content-header" style="margin-top:8px;margin-left:10px;">
              <a href="#"> <b> Social Media Share</b></a>
            </div>
            <div class="content">
               <div class="table">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Gamer ID</th>
                           <th>Count</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                        if($social_media_share){
                        foreach($social_media_share as $social_media_share){
                        $gamerID = $social_media_share->gamer_id;
                        $gamerData = \App\Models\Gamer::findOrFail($gamerID);
                        echo '<tr>';
                           echo '<td>'.$gamerData->fname.' '.$gamerData->lname.'</td>';
                        echo '<td>'.$social_media_share->count.'</td>';
                        echo '</tr>'; 
                           }
                        }
                        @endphp
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection