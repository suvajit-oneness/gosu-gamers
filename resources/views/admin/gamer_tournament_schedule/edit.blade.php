@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('gamertournamentschedule.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
       <form method="post" enctype="multipart/form-data" action="{{route('gamertournamentschedule.update1')}}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tournament Name : <em>*</em></label>
                        <input type="text" readonly="readonly" name="tournament_name" class="form-control" placeholder="Enter Name" value="{{$player1[0]->tname}}">
                        <input type="hidden" name="id" class="form-control" value="{{$player1[0]->gtsid}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Final Winner : <em>*</em></label>
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="final_winner" value="1" id="flexRadioDefault1">
                          <label class="form-check-label" for="flexRadioDefault1">
                              Decided
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="final_winner" value="0" id="flexRadioDefault2" checked>
                          <label class="form-check-label" for="flexRadioDefault2">
                          Not Decided
                          </label>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Winner : <em>*</em></label>
                <select name="winner" class="form-control" id="winner" selected="selected">
                  <option value="">-Select Winner-</option>
                   <option value="{{$player1[0]->gid}}">{{$player1[0]->fname}} {{$player1[0]->fname}} ({{$player1[0]->email}} )</option>
                   <?php
                   if(isset($player2) && count($player2)>0){
                   ?>
                   <option value="{{$player2[0]->gid}}">{{$player2[0]->fname}} {{$player2[0]->fname}} ({{$player2[0]->email}} )</option>
                 <?php } ?>
                </select>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label>Runner : <em>*</em></label>
                <select name="runner" class="form-control" id="runner" selected="selected">
                  <option value="">-Select Runner-</option>
                      <option value="{{$player1[0]->gid}}">{{$player1[0]->fname}} {{$player1[0]->fname}} ({{$player1[0]->email}} )</option>
                      <?php
                   if(isset($player2) && count($player2)>0){
                   ?>
                   <option value="{{$player2[0]->gid}}">{{$player2[0]->fname}} {{$player2[0]->fname}} ({{$player2[0]->email}} )</option>
                   <?php } ?>
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
                <label>{{$player1[0]->fname}} {{$player1[0]->fname}} ({{$player1[0]->email}} ) : <em>*</em></label>
                <input type="text"  name="player1_score" class="form-control" placeholder="Enter Player1 Score">
               </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <?php
                   if(isset($player2) && count($player2)>0){
                   ?>
                <label>{{$player2[0]->fname}} {{$player2[0]->fname}} ({{$player2[0]->email}} ) : <em>*</em></label>
              <?php } ?>
                <input type="text"  name="player2_score" class="form-control" placeholder="Enter Player2 Score" >
              </div>
            </div>
          </div>
          <input type="hidden"  name="tournament_id" class="form-control" value="{{$player1[0]->tid}}" >
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

