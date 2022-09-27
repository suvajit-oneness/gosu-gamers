@extends("admin.layouts.master")
@section("content")
<div class="card-body">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Country Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('country.index') }}"><i class="icon-exit ml-2">Back</i></a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Country Name :</strong>
               {{$country->name}}
            </div>
            <div class="form-group">
               <strong>Region id :</strong>
               {{$country->region_id}}
            </div>
            <div class="form-group">
               <strong>Country Code :</strong>
               {{$country->iso3}}
            </div>
            <div class="form-group">
               <strong>Country NumCode :</strong>
               {{$country->numcode}}
            </div>
            <div class="form-group">
               <strong>Country PhoneCode :</strong>
               {{$country->phonecode}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection