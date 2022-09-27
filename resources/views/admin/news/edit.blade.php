@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('news.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('news.update1')}}" enctype="multipart/form-data" >
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">News Category *</td>
                        <td>
                           <select class='form-control' id='category' name='category_id'>
                           <option value="{{$newscate->id}}">{{ ucfirst($newscate->name) }}</option>
                              @if($category)
                              @foreach($category as $index => $category)
                              <option value="{{$category->id}}">{{ ucfirst($category->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <input type="hidden" value="{{$news->id}}" class="form-control" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Title  *</td>
                        <td>
                           <input type="text" value="{{$news->title}}" class="form-control" name="title">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Content *</td>
                        <td>
                           <textarea  class="form-control" id="content" name="content">{{$news->content}}</textarea>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image *</td>
                        <td>
                           <input type="file" value="{{$news->image}}" class="form-control" name="image">  
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Post Date *</td>
                        <td>
                           <input type="date" value="{{$news->post_date}}" class="form-control" name="post_date"> 
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Post Time *</td>
                        <td>
                           <input type="time" value="{{$news->post_time}}" class="form-control" name="post_time"> 
                           
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Partner *</td>
                        <td>
                           <select class="form-control" name="partner" id="partner">
                              <option value="Gosu" {{ old("partner", $news->partner) == "Gosu" ? "selected" : "" }}>Gosu</option>
                              <option value="flipkart" {{ old("partner", $news->partner) == "flipkart" ? "selected" : "" }}>FlipKart</option>
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Uploaded By *</td>
                        <td>
                           <input type="text" value="{{$news->uploaded_by}}" class="form-control" name="uploaded_by"> 
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
<script type="text/javascript">
   CKEDITOR.replace('content');
</script>
@endsection