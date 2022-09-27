@extends("admin.layouts.master")

@section("content")



<div class="content">

<div class="card">



<div class="card-header header-elements-inline">

   <h5 class="card-title">Team Tournament Schedule  List </h5>

         <div class="header-elements">

             

            </div>

      </div>  

<div class="table-responsive">

         <table id="example1" class="table table-striped datatable-responsive">

            <thead>

               <tr class="bg-teal-400">

                  <th width="3%">SL No</th>

                  <th width="3%">Tournament Name</th>

                  <th width="3%">Team1</th>

                  <th width="3%">Team2 </th>                   

                  <th width="3%">Start Time</th>

                  <th width="3%">End Time</th>

                  <th width="3%">winner </th>

                  <th width="3%">Stage</th>                             

            </tr>

         </thead>

         <tbody>

            <?php $slno = 1; ?>

            @if($teamtournamentschedule)

            @foreach($teamtournamentschedule as $data)

            <tr>

                 <td>{{$slno}}</td>

                  <td> {{$data->tname}}</td>

                  <td> {{$data->Team1name}} </td>

                  <td> {{$data->Team2name}} </td>                 

                  <td> {{$data->start_time}}</td>

                  <td> {{$data->end_time}}</td>

                  <td> {{$data->Team3name}} </td>

                  <td> {{$data->stage}}</td>

            </tr>

            <?php $slno = $slno + 1; ?>    

            @endforeach

            @endif

         </tbody>

      </table>

      <div>

      </div>

   </div>

</div>

</div>













@endsection