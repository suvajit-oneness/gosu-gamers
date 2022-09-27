@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Testimonial Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('testimonial.index') }}"><i class="icon-exit ml-2">Back</i></a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Testimonial Image :</strong>
               <img src="{{URL::asset($testimonial->image)}}" style="width:150px; height:150px; float:left; 
                  border-radius:50%; margin-right:25px; float:right;margin-right:20px;">
            </div>
            <div class="form-group">
               <strong>Title :</strong>
               {{$testimonial->title}}
            </div>
            <div class="form-group">
               <strong>Author :</strong>
               {{$testimonial->author}}
            </div>
            <div class="form-group">
               <strong>Content :</strong>
               {{strip_tags(html_entity_decode($testimonial->content))}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection