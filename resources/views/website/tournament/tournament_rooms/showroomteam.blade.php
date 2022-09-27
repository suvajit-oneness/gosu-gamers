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
        <form method="post" enctype="multipart/form-data" action="{{route('saveteamroom')}}">
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
             @for ($i = 0; $i<$noofroom; $i++)  
            <div class="col-md-6">
              <div class="form-group">
                <label>Winner : <em>*</em></label>
                <select name="winner[]" class="form-control select2" id="winner" selected="selected">
                  <option value="">-Select Winner-</option>                         
                              @foreach($showroomplayers as $index => $t)
                              @if($t->room_code==$rooms[$i]->room_code)
                              <option value="{{ $t->gid }}">{{ ucfirst($t->team_name ) }} 
                              &nbsp &nbsp ({{ $t->email }})</option>
                              @endif
                              @endforeach
          
                </select>
              </div>
            </div>
            @endfor
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
                  <button type="submit" class="btn btn-primary"><i class="fas fa-edit mr-1"></i>Save </button>
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
</script>>

<script>
$(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
}); 
</script>

@endsection

