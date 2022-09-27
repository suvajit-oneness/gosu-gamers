@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">FAQs Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('faq.index') }}"><i class="icon-exit ml-2"></i>Back</a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong>Question :</strong>
               {{$faq->question}}
            </div>
            <div class="form-group">
               <strong>Answer :</strong>
               {{strip_tags(html_entity_decode($faq->answer))}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection