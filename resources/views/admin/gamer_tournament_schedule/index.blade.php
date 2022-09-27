@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Gamer Tournament Schedule  List </h5>
         <div class="header-elements">
         </div>
      </div>
      <div class="table-responsive">
         <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th width="3%">Tournament Name</th>
                  <th width="3%">player1</th>
                  <th width="3%">player2 </th>
                   <th width="3%">Winner</th>
                  <th width="3%">Stage</th>                             
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($gamertournamentschedule)
               @foreach($gamertournamentschedule as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->tname}}</td>
                  <td> {{$data->Player1fname}} {{$data->Player1lname}} |<br/>{{$data->Player1email}}</td>
                  <td> {{$data->Player2fname}} {{$data->Player2lname}} |<br/>{{$data->Player2email}}</td>
                 <td> {{$data->Player3fname}} {{$data->Player3lname}} |<br/>{{$data->Player3email}}</td>
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