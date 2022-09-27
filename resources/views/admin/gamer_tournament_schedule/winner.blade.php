@extends("admin.layouts.master")
@section("content")

<div class="content">
   <div class="card">
	<div style=" margin-left:30%; margin-top:10px;margin-bottom: 10px;">
		Winner of this Tournament {{$tournament->name}} 	
		is {{$tours[0]->fname}} {{$tours[0]->lname}}
	</div>
   </div>
</div>

@endsection