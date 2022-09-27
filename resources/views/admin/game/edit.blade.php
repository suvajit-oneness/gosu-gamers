@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('game.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('game.update1')}}" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Name  *</td>
                        <td>
                           <input type="text" value="{{$game->name}}" class="form-control" name="name">
                        </td>
                     </tr>
                     <input type="hidden" value="{{$game->id}}" class="form-control" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Description *</td>
                        <td>
                           <textarea  class="form-control" name="description"> {{$game->description}}</textarea>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image *</td>
                        <td>
                           <input type="file" value="{{$game->image}}" class="form-control" name="image">  
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

