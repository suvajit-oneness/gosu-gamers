@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('news.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('news.store')}}" enctype="multipart/form-data" >
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">News Category *</td>
                        <td>
                           <select class='form-control' id='category' name='category_id'>
                              @if($category)
                              @foreach($category as $index => $category)
                              <option value="{{$category->id}}">{{ ucfirst($category->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Title  *</td>
                        <td>
                           <input type="text" class="form-control ckeditor " name="title">
                           @error('title') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Content *</td>
                        <td>
                           <textarea  class="form-control" id="content" name="content"></textarea>
                           @error('content') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image *</td>
                        <td>
                           <input type="file" class="form-control" name="image">  
                           @error('image') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Post Date *</td>
                        <td>
                           <input type="date" value={{Today()}} class="form-control" name="post_date"> 
                           @error('post_date') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Post Time *</td>
                        <td>
                           <input type="time" value={{time()}} class="form-control" name="post_time"> 
                           @error('post_time') {{$message}} @enderror 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Partner</td>
                        <td>
                           <select class="form-control" name="partner" id="partner">
                              <option value="Gosu" {{ old("partner") == "Gosu" ? "selected" : "" }}>Gosu</option>
                              <option value="flipkart" {{ old("partner") == "flipkart" ? "selected" : "" }}>FlipKart</option>
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Uploaded By *</td>
                        <td>
                           <input type="text" class="form-control" name="uploaded_by"> 
                           @error('uploaded_by') {{$message}} @enderror 
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                 <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('news.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
  CKEDITOR.replace('content');
</script>
@endsection