@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('region.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('region.update1')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <input type="hidden" class="form-control" value="{{$regions->id}}" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Name  *</td>
                        <td>
                           <input type="text" class="form-control" value="{{$regions->name}}" name="name">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Continent Id *</td>
                        <td>
                           <input type="text" class="form-control" value="{{$regions->continent_id}}" name="continent_id">
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
              <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Edit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

