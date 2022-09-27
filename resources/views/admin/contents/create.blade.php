@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('cmscontent.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('cmscontent.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Page Name : <em>*</em></label>
                <input type="text" name="page_name" class="form-control" placeholder="Enter Page Name">
                @if($errors->has('page_name'))
                <span class="roy-vali-error"><small>{{$errors->first('page_name')}}</small></span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Page Title : <em>*</em></label>
                <input type="text" name="title" class="form-control" placeholder="Enter Page Title">
                @if($errors->has('title'))
                <span class="roy-vali-error"><small>{{$errors->first('title')}}</small></span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Slug : <em>*</em></label>
                <input type="text" name="slug" class="form-control" placeholder="Enter Page Title">
                @if($errors->has('slug'))
                <span class="roy-vali-error"><small>{{$errors->first('slug')}}</small></span>
                @endif
              </div>
            </div>
          </div>

        <!------------------------------------------------------------------------------------------------------->
        <!-- META INFO -->
         <div class="row">
            <div class="col-md-10">
              <h3>Page Meta Information</h3>
              <hr/>
            </div>
            <div class="col-md-10">
              <div class="form-group">
                <label>Meta Title:</label>
                <input type="text" name="meta_title" class="form-control" placeholder="Meta Title">
              </div>
              <div class="form-group">
                <label>Meta Keywords:</label>
                <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keywords">
              </div>
              <div class="form-group">
                <label>Meta Description:</label>
                <textarea name="meta_description" class="form-control" placeholder="Meta Description"></textarea>
              </div>
            </div>
         </div>
        <!------------------------------------------------------------------------------------------------------->
        <!-- END META INFO -->

        <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label>Description : </label>
                <textarea name="description" id="description" class="form-control" rows="10"></textarea>
                @if($errors->has('description'))
                <span class="roy-vali-error"><small>{{$errors->first('description')}}</small></span>
                @endif
              </div>
            </div>
          </div>
          <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('cmscontent.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection