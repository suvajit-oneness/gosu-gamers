@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('region.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('region.store')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Name  *</td>
                        <td>
                           <input type="text" class="form-control" name="name">
                           @error('Name') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Continent Id</td>
                        <td>
                           <input type="text" class="form-control" name="continent_id">
                           @error('continent_id') {{$message}} @enderror
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('region.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

