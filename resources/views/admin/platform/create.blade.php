@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('platform.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('platform.store')}}" enctype="multipart/form-data" >
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Game *</td>
                        <td>
                           <select class='form-control' id='game' name='game_id'>
                              @if($game)
                              @foreach($game as $index => $game)
                              <option value="{{$game->id}}">{{ ucfirst($game->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">name  *</td>
                        <td>
                           <input type="text" class="form-control ckeditor " name="name">
                           @error('name') {{$message}} @enderror
                        </td>
                     </tr>

                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image *</td>
                        <td>
                           <input type="file" class="form-control" name="image">  
                           @error('image') {{$message}} @enderror
                        </td>
                     </tr>
                    </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                 <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('platform.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection