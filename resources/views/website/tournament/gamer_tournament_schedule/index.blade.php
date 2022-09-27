
@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Gamer Tournament Schedule  List </h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>
   <div class="container">
      <div class="content">

         <div class="card">
            <div class="card-header">
            <a class="btn btn-danger float-right" href="{{ route('gamer.tournaments.show',$user->id) }}"><i class="icon-exit ml-2"></i> Back</a>
            </div>
            <div class="card-body">
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
                           <td> {{$data->Player1fname}} {{$data->Player1lname}} {{$data->Player1email}}</td>
                           <td> {{$data->Player2fname}} {{$data->Player2lname}} {{$data->Player2email}}</td>
                        <td> {{$data->Player3fname}} {{$data->Player3lname}} {{$data->Player3email}}</td>
                           <td> {{$data->stage}}</td>
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

</section>

@endsection