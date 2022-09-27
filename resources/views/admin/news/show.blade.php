@extends("admin.layouts.master")
@section("content")
    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="panel-title">
                    <h3 style="float:left;margin-left:20px;margin-top:15px">News Details </h3>
                    <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "
                       href="{{ route('news.index') }}"><i class="icon-exit ml-2">Back</i></a>
                </div>
                <div class="content">
                    <div class="form-group">
                        <strong>Title :</strong>
                        {{$news->title }}
                    </div>
                    <div class="form-group">
                        <strong>Content :</strong>
                        {{$news->content}}
                    </div>
                    <div class="form-group">
                        <strong>Image:</strong>
                        <img src="{{URL::asset($news->image)}}" style="width:150px; height:150px; float:left;
                  border-radius:50%; margin-right:25px; float:right;margin-right:20px;">
                    </div>
                    <div class="form-group">
                        <strong>Date :</strong>
                        {{$news->post_date}}
                    </div>
                    <div class="form-group">
                        <strong>Time :</strong>
                        {{$news->post_time}}
                    </div>
                    <div class="form-group">
                        <strong>Partner :</strong>
                        {{$news->partner}}
                    </div>
                    <div class="form-group">
                        <strong>Uploaded By :</strong>
                        {{$news->uploaded_by }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection