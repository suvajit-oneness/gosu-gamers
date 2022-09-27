

@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid">
  <h2 class="text-center">Team Position</h2>
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
               <form method="post" action="{{route('gamer.positionsteam.store')}}" enctype="multipart/form-data">
                  @csrf
                  <fieldset class="mb-3">
                        <div class="row">                  
                           @for ($i = 1; $i <= $tournament->max_players; $i++)
                           <div class="col-md-3">
                              <td width="15%" class="text-right border-right text-uppercase">{{$i}} Position *</td>
                              <td colspan="3">
                                 <select class='form-control select2'  name='team_id[]'>
                                 <option value="">--Select Team --</option>
                                    @if($players)
                                    @foreach($players as $index => $gamer)
                                    <option value="{{ $gamer->team_id }}">{{ ucfirst($gamer->teams) }}</option>
                                    @endforeach
                                    @endif
                                 </select>
                              </td>
                              </div>
                              @endfor
                              </div>
                        <input type='hidden' value="{{$tournament->id}}" name='tournament_id'>    
                  </fieldset>
                  <div class="text-left">
                     <div class="header-elements">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Save</button>
                     </div>
                  </div>
               </form>
            </div>

         </div>
         <div class="card">
            <div class="card-body">
            <div class="table-responsive">
         <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th width="3%">Tournament Name</th>
                  <th width="3%">1st Position</th>
                  <th width="3%">Player Name </th>
                  <th width="3%">Email</th>
                  <th width="3%">Mobile</th>
                  <th width="3%">Action</th>
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($position)
               @foreach($position as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->tournaments}}</td>
                  <td> {{$data->teams}} </td>
                  <td> {{$data->fname}} {{$data->lname}} </td>
                  <td> {{$data->email}}</td>
                  <td> {{$data->mobile}}</td>
                 <td> </td>
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
      </div>
   </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
@endsection
