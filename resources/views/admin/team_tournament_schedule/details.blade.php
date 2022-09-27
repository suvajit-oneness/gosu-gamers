@extends("admin.layouts.master")

@section("content")



<div class="content">

<div class="card">



<div class="card-header header-elements-inline">

   <h5 class="card-title">Team Tournament Schedule  List </h5>

         <div class="header-elements">
            @if($teamtournamentschedule)
               @foreach($teamtournamentschedule as $items)
               @endforeach
                  <a href="{{ route('deletefixture', [$items->tournament_id, $items->stage]) }}" class="btn" style="background-color: #26a69a; color:#fff;"> Edit Fixture</a>
               
            @endif
         </div>

</div>  

<div class="table-responsive">

         <table id="example1" class="table table-striped datatable-responsive">

            <thead>

               <tr class="bg-teal-400">

                  <th>SL No</th>

                  <th>Tournament Name</th>

                  <th>Team1</th>

                  <th>Team2 </th>                   

                  <th>Start Time</th>

                  <th>End Time</th>

                  <th>winner </th>

                  <th>Stage</th>                             

                  <th>Action</th>

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


               <td>

                <div class="list-icons">

                  @can('Tournaments-Edit')

                     <a class="badge bg-primary"href="{{ route('teamtournamentschedule.edit',$data->id) }}">Select Winner</a>

                     @endcan
                    
               </td>

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