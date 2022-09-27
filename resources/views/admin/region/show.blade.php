@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Region Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('region.index') }}"><i class="icon-exit ml-2">Back</i></a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Region Name :</strong>
               {{$region->name}}
            </div>
            <div class="form-group">
               <strong>Continent Id  :</strong>
               {{$region->continent_id}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection