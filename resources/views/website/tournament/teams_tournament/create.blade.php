@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
   <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid">
   <h2 class="text-center">Create Team Tournament</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
   <div class="clearfix"></div>

   <div class="container">
      <div class="content">

         <div class="card">
            <div class="card-header">
               <a class="btn btn-danger float-right" href="{{ route('gamer.tournaments.show',$user->id) }}"><i
                     class="icon-exit ml-2"></i> Back</a>
            </div>
            <div class="card-body">
               <form method="post" enctype="multipart/form-data" action="{{route('gamer.teamstournament.store')}}">
                  @csrf
                  <fieldset class="mb-3">
                     <table class="table border-bottom border-top">
                        <tbody>
                           <tr>
                              <td width="15%" class="text-right border-right text-uppercase">team Name *</td>
                              <td>
                                 <select class='form-control select2' id='team_id' name='team_id'>
                                    @if($teams)
                                    @foreach($teams as $index => $teams)
                                    <option value="{{ $teams->id }}">{{ ucfirst($teams->team_name) }}</option>
                                    @endforeach
                                    @endif
                                 </select>
                              </td>
                           </tr>
                           <td width="15%" class="text-right border-right text-uppercase">tournament Name *</td>
                           <td>
                              <select class='form-control select2' id='tournaments' name='tournament_id'>
                                 @if($tournaments)
                                 @foreach($tournaments as $index => $tournaments)
                                 <option value="{{ $tournaments->id }}">{{ ucfirst($tournaments->name) }}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </td>
                           </tr>
                        </tbody>
                     </table>
                  </fieldset>
                  <div class="text-left">
                     <div class="header-elements">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Save</button>
                        <a href="{{route('gamer.teamstournament.create')}}" class="btn bg-warning ml-2"><i
                              class="fas fa-redo mr-1"></i> Clear</a>
                     </div>
                  </div>
               </form>
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