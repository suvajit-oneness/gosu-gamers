@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('tournaments.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
       <form method="post" enctype="multipart/form-data" action="{{route('roomtournamentsave')}}">
            @csrf
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tournament Name : <em>*</em></label>
                <input type="text" readonly="readonly" name="tournament_name" class="form-control" placeholder="Enter Name" value="{{$tournaments->name}}">
                <input type="hidden" name="id" class="form-control" value="{{$tournaments->id}}">
              </div>
            </div>
          </div>
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Winner : <em>*</em></label>
                <select name="winner" class="form-control select2" id="winner" selected="selected">
                  <option value="">-Select Winner-</option>
                         
                              @foreach($showroomplayers as $index => $g)
                              <option value="{{ $g->gid }}">{{ ucfirst($g->fname) }} {{ ucfirst($g->lname) }}  
                              &nbsp &nbsp ({{ $g->email }})</option>
                              @endforeach
          
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
                <label>Winner Screen Shot  : <em>*</em></label>
                <input type="file"  name="winner_image" class="form-control"  >
               </div>
            </div>
            <div class="col-md-6">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>>

<script>
$(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
}); 
</script>
@endsection
