
@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")

<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Tournament Rooms List </h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>
   <div class="container">
      <div class="content">

         <div class="">
            <div class="text-right mb-3">
            <a class="btn btn-danger" href="{{ route('gamer.tournaments.show',$user->id) }}"><i class="icon-exit ml-2"></i> Back</a>
            </div>
            <div class="">
         <form method="post" enctype="multipart/form-data" action="{{route('gamer.tournaments.teamtournamentschedule.update1')}}">
            @csrf
             <div class="row profile_upadate_field custom_layouts">
            <div class="col-md-12">
              <div class="form-group upadate_field custom_layout">
                <label>Tournament Name : <em>*</em></label>
                <input type="text" readonly="readonly" name="tournament_name" class="form-control" placeholder="Enter Name" value="{{$team1[0]->tname}}">
                <input type="hidden" name="id" class="form-control" value="{{$team1[0]->gtsid}}">
              </div>
            </div>
          </div>
             <div class="row">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout select">
                <label>Winner : <em>*</em></label>
                <select name="winner" class="form-control" id="winner" selected="selected">
                  <option value="">-Select Winner-</option>
                   <option value="{{$team1[0]->gid}}">{{$team1[0]->team_name}} </option>
                   <option value="{{$team2[0]->gid ?? '0'}}">{{$team2[0]->team_name ?? '0'}} </option>
                </select>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group upadate_field custom_layout select">
                <label>Runner : <em>*</em></label>
                <select name="runner" class="form-control" id="runner" selected="selected">
                  <option value="">-Select Runner-</option>
                      <option value="{{$team1[0]->gid}}">{{$team1[0]->team_name}}</option>
                   <option value="{{$team2[0]->gid ?? '0'}}">{{$team2[0]->team_name ?? '0'}}</option>
                </select>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Winner Point  : <em>*</em></label>
                <input type="text" readonly="readonly" name="winner_point" class="form-control" placeholder="Enter Name" value="2">
               </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>Runner Point : <em>*</em></label>
                <input type="text" readonly="readonly" name="runner_point" class="form-control" placeholder="Enter Name" value="1">
              </div>
            </div>
          </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>{{$team1[0]->team_name}}  : <em>*</em></label>
                <input type="text"  name="team1_score" class="form-control" placeholder="Enter team1 Score">
               </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout">
                <label>{{$team2[0]->team_name ?? ''}} : <em>*</em></label>
                <input type="text"  name="team2_score" class="form-control" placeholder="Enter team2 Score" >
              </div>
            </div>
          </div>

          <input type="hidden"  name="tournament_id" class="form-control" value="{{$team1[0]->tid}}" >
          <div class="row">
            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout file">
                <label>Winner Screen Shot  : <em>*</em></label>
                <input type="file"  name="winner_image">
               </div>
            </div>

            <div class="col-md-6">
              <div class="form-group upadate_field custom_layout file">
                <label>Runner Screen Shot : <em>*</em></label>
                <input type="file"  name="runner_image">
              </div>
            </div>
          </div>

            <div class="text-left">
               <div class="header-elements">
                   <button type="submit" class="btn btn-primary"><i class="fas fa-edit mr-1"></i>Save</button>
               </div>
            </div>
         </form>
      </div>

         </div>
      </div>
   </div>

</section>

<script>
$(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
}); 
</script>

@endsection