@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Banner Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('banner.index') }}"><i class="icon-exit ml-2">Back</i></a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Banner Image :</strong>
               <img src="{{URL::asset($banner->image)}}" style="width:150px; height:150px; float:left; 
                  border-radius:50%; margin-right:25px; float:right;margin-right:20px;">
            </div>
            <div class="form-group">
               <strong>Title :</strong>
               {{$banner->title}}
            </div>
            <div class="form-group">
               <strong>Description :</strong>
               {{strip_tags(html_entity_decode($banner->description))}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection