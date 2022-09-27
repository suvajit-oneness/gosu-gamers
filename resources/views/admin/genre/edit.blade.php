@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('banner.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('banner.update1')}}" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Description  *</td>
                        <td>
                           <textarea class="form-control" name="description">{{$banner->description}}</textarea> 
                        </td>
                     </tr>
                     <input type="hidden" value="{{$banner->id}}" class="form-control" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Title *</td>
                        <td>
                           <input type="text" value="{{$banner->title}}" class="form-control" name="title">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image *</td>
                        <td>
                           <input type="file" class="form-control" name="image">  
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Save</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection