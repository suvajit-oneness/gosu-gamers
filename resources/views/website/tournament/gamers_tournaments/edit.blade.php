@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Tournament Schedule</h2>
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
         <form method="post" enctype="multipart/form-data" action="{{route('gamer.gamerstournaments.update1')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">tournaments Name *</td>
                        <td>
                           <select class='form-control' id='tournaments' name='tournaments_id'>
                           <option value="{{ $gamerstourname->id }}">{{ ucfirst($gamerstourname->name) }}</option>
                              @if($tournaments)
                              @foreach($tournaments as $index => $tournaments)
                              <option value="{{ $tournaments->id }}">{{ ucfirst($tournaments->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                        <input type="hidden" value="{{$gamerstournaments->id}}" class="form-control" name="id">
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">user id  *</td>
                        <td>
                           <input type="number" value="{{$gamerstournaments->user_id}}" class="form-control" name="user_id">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">room code *</td>
                        <td>
                           <input type="text"  value="{{$gamerstournaments->room_code}}"class="form-control" name="room_code">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">point *</td>
                        <td>
                           <input type="number"  value="{{$gamerstournaments->point}}"class="form-control" name="point">  
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">payment status *</td>
                        <td>
                           <input  type="number" value="{{$gamerstournaments->payment_status}}"class="form-control" name="payment_status"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">score *</td>
                        <td>
                           <input  type="number" value="{{$gamerstournaments->score}}"class="form-control" name="score"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">earning *</td>
                        <td>
                           <input  type="number" value="{{$gamerstournaments->earning}}" class="form-control" name="earning"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">currency id *</td>
                        <td>
                           <input  type="number"value="{{$gamerstournaments->currency_id}}" class="form-control" name="currency_id"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">status *</td>
                        <td>
                           <input  type="number"value="{{$gamerstournaments->status}}" class="form-control" name="status"> 
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Edit</button>
               </div>
            </div>
         </form>
      </div>

    </div>

    </div>
  </div>

</section>

@endsection


