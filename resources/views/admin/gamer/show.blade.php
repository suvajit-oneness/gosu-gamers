@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Gamer Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('gamers.index') }}"><i class="icon-exit ml-2"></i>Back</a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Name :</strong>
               {{$gamer->fname}} {{$gamer->lname}}
            </div>
            <div class="form-group">
               <strong>Email :</strong>
               {{$gamer->email}}
            </div>
            <div class="form-group">
               <strong>Mobile :</strong>
               {{$gamer->mobile}}
            </div>
            <div class="form-group">
               <strong>Image :</strong>
               <img src="{{URL::asset($gamer->image)}}" style="width:150px; height:150px; float:left; 
                  border-radius:50%; margin-right:25px; float:right;margin-right:20px;">  
            </div>
            <div class="form-group">
               <strong>Description :</strong>
               {{strip_tags($gamer->description)}}
            </div>
            <div class="form-group">
               <strong>Partner :</strong>
               {{strip_tags($gamer->partner)}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

