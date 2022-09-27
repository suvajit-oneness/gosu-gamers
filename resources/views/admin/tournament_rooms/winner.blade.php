@extends("admin.layouts.master")
@section("content")

<div class="content">
   <div class="card">
	<div style=" margin-left:30%; margin-top:10px;margin-bottom: 10px;">
		<h3>Winners of Tournament {{$tournament->name}} : </h3> 	
		@foreach($tours as $name)
		<P>Winner of {{ $name->room_code}} is {{ $name->name }}</P>
		 @endforeach
	</div>
   </div>
</div>

@endsection