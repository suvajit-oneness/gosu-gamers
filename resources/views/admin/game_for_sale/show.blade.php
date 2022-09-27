@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Game Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('game.index') }}"><i class="icon-exit ml-2"></i>Back</a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Game Name :</strong>
               {{$game->name}}
            </div>
            <div class="form-group">
               <strong>Description :</strong>
               {{strip_tags(html_entity_decode($game->description))}}
            </div>
            <div class="form-group">
               <strong>Image :</strong>
               <img src="{{URL::asset($game->image)}}" style="width:150px; height:150px; float:left; 
                  border-radius:50%; margin-right:25px; float:right;margin-right:20px;">  
            </div>
         </div>
      </div>
   </div>
</div>
@endsection