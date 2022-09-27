@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Sponsor Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('sponsor.index') }}"><i class="icon-exit ml-2">Back</i></a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Sponsor Image :</strong>
               <img src="{{URL::asset($sponsor->image)}}" style="width:150px; height:150px; float:left; 
                  border-radius:50%; margin-right:25px; float:right;margin-right:20px;">
            </div>
            <div class="form-group">
               <strong>Name :</strong>
               {{$sponsor->name}}
            </div>
            <div class="form-group">
               <strong>Title :</strong>
               {{$sponsor->title}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection