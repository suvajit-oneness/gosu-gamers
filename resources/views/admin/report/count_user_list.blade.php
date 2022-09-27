<p><b>Total Joined Gamers : {{ $total }}</b></p>
<table class="table table-bordered table-hover table-striped ar-datatable display nowrap" style="width:100%;">
	<thead>
		<tr>
			<td>Date</td>
			<td>Joined Gamers</td>
		</tr>
	</thead>
	<tbody>
		@foreach($list as $key=>$val)
			<tr>
				<td>{{ date('d/m/Y',strtotime($key)) }}</td>
				<td>{{ $val }}</td>
			</tr>
		@endforeach
	</tbody>
</table>