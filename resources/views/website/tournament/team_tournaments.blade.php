@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Teams List </h5>
         <div class="header-elements">
            @can('Tournaments-Create')
            <div class="list-icons">
               <a href="{{route('tournaments.create')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Add Tournaments </a>
            </div>
            @endcan
         </div>
      </div>
      <form action="{{route('teamassignroom')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
         @csrf 
         <div class="row">
            <div class="col-md-6" style="float:left;margin-left:10px;">
               <div class="form-group" >
                  <label>Select Room : <em>*</em></label>
                  <select name="room" class="form-control">
                     @if(isset($room))
                     <option value="">--Select Room--</option>
                     @foreach($room as $r)
                     <option value="{{$r->room_code}}">{{$r->room_code}}</option>
                     @endforeach
                     @endif
                  </select>
               </div>
            </div>
         </div>
         @php 
        $tournament->max_players=intdiv($tournament->max_players,$tournament->room_size);
          @endphp
         <div class="row">
            <div class="col-md-6" style="float:left;margin-left:20px;">
               <div class="form-group" >
                  @for ($i = 0; $i<$tournament->max_players; $i++)
                  <select name="team_id[]" id="team_id" >
                     <option value="">--Select Gamer--</option>
                     @foreach($tournamentList as $s_key => $gammer)
                     <option value="{{$gammer->team_id}}">{{$gammer->team_name}}</option>
                     @endforeach
                  </select>
                  @endfor
               </div>
            </div>
         </div>
         <input type="hidden"name="tournament_id"value="{{$tournament->id}}">
            <div class="text-left" style="float: left;margin-left:10px;margin-bottom:10px; ">
               <div class="header-elements">
                 <button type="submit" class="btn bg-teal-400 form-group"><i class="fas fa-save mr-1"></i> Save</button>
               </div>
            </div>
      </form>
      <div class="box-footer">
      </div>
   </div>
</div>
<script type="text/javascript">
   function format ( d ) {
     expand_output = d[3].replace(`<span class="expand">Show</span><div class="hidden">`, '')
     return `<div>${expand_output}`
   }
   $(document).ready(function() {
     // data table column in same order
     dataTableColumns = ['Sl No.', 'Name', 'Email', 'Gaming ID', 'Payment Status', 'Transaction Id', 'Payment Amount', 'Payment By', 'Country']
     // Setup - add a text input to each header cell
     $('.ar-datatable thead th.search').each( function () {
         var title = $(this).text();
         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
     });
     // generate data table
     var dtTable = $('.ar-datatable').DataTable({
       "pageLength": 100,
       // "order": [[ 1, "asc" ]],
       "columnDefs": [ {
         "targets": [ 0 ],
         "orderable": false
       }],
       initComplete: function () {
         // add dropdown
         this.api().columns().every(function () {
           var column = this;
           if ([4, 8].indexOf(column[0][0]) != -1) {
             var select = $('<select><option value="">Select '+ dataTableColumns[column[0][0]] +'</option></select>')
             .appendTo( $(column.header()).empty() )
             .on( 'change', function () {
               var val = $.fn.dataTable.util.escapeRegex($(this).val());
               column
               .search( val ? '^'+val+'$' : '', true, false )
               .draw();
             });
             column.data().unique().sort().each( function ( d, j ) {
               if(column.index() == 0){ d = $(d).text(); }
               select.append( '<option value="'+d+'">'+d+'</option>')
             });  
           }
         })
       }
     });
     // Apply the search
     dtTable.columns().every( function () {
       var that = this;
   
       $( 'input:not([type="checkbox"])', this.header() ).on( 'keyup change clear', function () {
         if ( that.search() !== this.value ) {
           that.search( this.value ).draw();
         }
       });
     });
     // avoid sorting in click input, select in header
     dtTable.columns().eq(0).each( function ( colIdx ) {
       $('.no-order, input, select', dtTable.column(colIdx).header()).on('click', function(e) {
         e.stopPropagation();
       });
     });
   
     // Array to track the ids of the details displayed rows
     var detailRows = [];
   
     $('.dataTable tbody').on( 'click', 'tr td span.expand', function () {
         var tr = $(this).closest('tr');
         var row = dtTable.row( tr );
         var idx = $.inArray( tr.attr('id'), detailRows );
         // console.log(idx)
         if ( row.child.isShown() ) {
             tr.removeClass( 'details' );
             row.child.hide();
   
             // Remove from the 'open' array
             detailRows.splice( idx, 1 );
         }
         else {
             tr.addClass( 'details' );
             row.child( format( row.data() ) ).show();
   
             // Add to the 'open' array
             if ( idx === -1 ) {
                 detailRows.push( tr.attr('id') );
             }
         }
     } );
   
     // On each draw, loop over the `detailRows` array and show any child rows
     dtTable.on( 'draw', function () {
         $.each( detailRows, function ( i, id ) {
             $('#'+id+' td span.expand').trigger( 'click' );
         } );
     } );
   });
</script>
<script type="text/javascript">
   $('#selectallgamer').click(function(event) {   
      if(this.checked) {
          // Iterate each checkbox
          $(':checkbox').each(function() {
              this.checked = true;                        
          });
      } else {
          $(':checkbox').each(function() {
              this.checked = false;                       
          });
      }
   });
</script>
<script type="text/javascript">
   function gamerSelectLimit(){
                  var limit =  {{$tournament->max_players}};
   
                  var selected_option = $('#gamer_id option:selected').length;
                  if(selected_option > limit) {
                      
                     $(".error_mgs").html("Please Select Gammer under "+ limit);
                      
                      return false;
                  }
                  else{
                   $(".error_mgs").html("");
                   return true;
                  }
               }                  
   
</script>
<script>
$(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
}); 
</script>
@endsection