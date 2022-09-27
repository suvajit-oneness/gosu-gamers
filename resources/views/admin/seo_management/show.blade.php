@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Seo Managements Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('seomanagement.index') }}"><i class="icon-exit ml-2"></i>Back</a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Page Name :</strong>
               {{$seo_management->page_name}}
            </div>
            <div class="form-group">
               <strong>Slug :</strong>
               {{$seo_management->slug}}
            </div>
            <div class="form-group">
               <strong>Meta Title :</strong>
               {{$seo_management->meta_title}}
            </div>
            <div class="form-group">
               <strong>Meta Keywords :</strong>
              {{strip_tags(html_entity_decode($seo_management->meta_keywords))}}
            </div>
            <div class="form-group">
               <strong>Meta Description:</strong>
               {{strip_tags(html_entity_decode($seo_management->meta_description))}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

