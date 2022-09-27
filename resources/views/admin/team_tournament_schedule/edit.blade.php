@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('teamtournamentschedule.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" enctype="multipart/form-data" action="{{route('teamtournamentschedule.update1')}}">
            @csrf
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tournament Name : <em>*</em></label>
                <input type="text" readonly="readonly" name="tournament_name" class="form-control" placeholder="Enter Name" value="{{$team1[0]->tname}}">
                <input type="hidden" name="id" class="form-control" value="{{$team1[0]->gtsid}}">
              </div>
            </div>
          </div>
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Winner : <em>*</em></label>
                <select name="winner" class="form-control" id="winner" selected="selected">
                  <option value="">-Select Winner-</option>
                   <option value="{{$team1[0]->gid}}">{{$team1[0]->team_name}} </option>
                   <option value="{{$team2[0]->gid ?? '0'}}">{{$team2[0]->team_name ?? '0'}} </option>
                </select>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
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
              <div class="form-group">
                <label>Winner Point  : <em>*</em></label>
                <input type="text" readonly="readonly" name="winner_point" class="form-control" placeholder="Enter Name" value="2">
               </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Runner Point : <em>*</em></label>
                <input type="text" readonly="readonly" name="runner_point" class="form-control" placeholder="Enter Name" value="1">
              </div>
            </div>
          </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{$team1[0]->team_name}}  : <em>*</em></label>
                <input type="text" required name="team1_score" class="form-control" placeholder="Enter team1 Score">
               </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>{{$team2[0]->team_name ?? ''}} : <em>*</em></label>
                <input type="text" required  name="team2_score" class="form-control" placeholder="Enter team2 Score" >
              </div>
            </div>
          </div>

          <input type="hidden"  name="tournament_id" class="form-control" value="{{$team1[0]->tid}}" >
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Winner Screen Shot  : <em>*</em></label>
                <input type="file"  name="winner_image" class="form-control"  >
               </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Runner Screen Shot : <em>*</em></label>
                <input type="file"  name="runner_image" class="form-control">
              </div>
            </div>
          </div>

            <div class="text-left">
               <div class="header-elements">
                   <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Save</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<script>
$(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
}); 
</script>
@endsection