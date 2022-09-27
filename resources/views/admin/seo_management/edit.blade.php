@extends("admin.layouts.master")
@section("content")
    <div class="content">
        <div class="card">
            <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "
                    href="{{ route('seomanagement.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
            <div class="card-body">
                <form method="post" action="{{route('seomanagement.update1')}}" id="seo_form">
                    @csrf
                    <fieldset class="mb-3">
                        <table class="table border-bottom border-top">
                            <tbody>
                            <tr>
                                <td width="15%" class="text-right border-right text-uppercase">Page Name *</td>
                                <td>
                                    <input type="text" value="{{$seo_management->page_name}}" class="form-control"
                                           name="page_name">
                                </td>
                            </tr>
                            <input type="hidden" value="{{$seo_management->id}}" class="form-control" name="id">
                            <tr>
                                <td width="15%" class="text-right border-right text-uppercase">slug *</td>
                                <td>
                                    <input type="text" value="{{$seo_management->slug}}" class="form-control"
                                           name="slug">
                                </td>
                            </tr>
                            <tr>
                                <td width="15%" class="text-right border-right text-uppercase">Meta Title *</td>
                                <td>
                                    <input type="text" value="{{$seo_management->meta_title}}" class="form-control"
                                           name="meta_title" id="meta_title">
                                    <span id="meta_title_count">0</span>
                                    @error('meta_title') {{$message}} @enderror
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td width="15%" class="text-right border-right text-uppercase">meta keywords *</td>
                                <td>
                                    <textarea class="form-control" name="meta_keywords"
                                              id="meta_keywords">{{$seo_management->meta_keywords}}</textarea>
                                    <span id="meta_keywords_count">0</span>
                                    @error('meta_keywords') {{$message}} @enderror
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td width="15%" class="text-right border-right text-uppercase">meta description *</td>
                                <td>
                                    <textarea class="form-control" name="meta_description"
                                              id="meta_description">{{$seo_management->meta_description}}</textarea>
                                    <span id="meta_description_count">0</span>
                                    @error('meta_description') {{$message}} @enderror
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="text-left">
                        <div class="header-elements">
                            <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Edit</button>
                            <a href="javascript:void(0)" class="btn bg-teal-400 ml-2" id="reset_form"><i
                                        class="fas fa-redo mr-1"></i> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('page-script')

    <script type="text/javascript" src="{!! asset('letsgamenow/js/seo_management_counter_fn.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/seo_management_counter_fn.js')) }}"></script>

    <script type="text/javascript" src="{!! asset('letsgamenow/js/seo_management_counter_exec.js')!!}?ver={{ filemtime(public_path('letsgamenow/js/seo_management_counter_exec.js')) }}"></script>

@endsection


