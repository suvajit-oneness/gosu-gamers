@extends("admin.layouts.master")
@section("content")
@php
$tournament->max_players=intdiv ($tournament->max_players,2)
@endphp

<div class="content">
   <div class="card">
    <div class="card-body">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Tournament Schedule</h5>
         <div class="header-elements">
            @can('Tournaments-Create')
            <div class="list-icons">
               <a href="{{route('tournaments.index')}}" class="btn bg-teal-400 text-uppercase">Tournaments </a>
            </div>
            @endcan
         </div>
      </div>
       <form action="{{route('teamtournamentsched')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
         @csrf 
      <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                @for ($i = 0; $i<$tournament->max_players; $i++)
                <label>Player1 : <em>*</em></label>
                <div class="form-group">
                  <select name="player1[]" id="player1" selected="selected" >
                     <option value="">--Select Gamer--</option>
                     @foreach($tournamentList as $s_key => $gammer)
                     <option value="{{$gammer->team_id}}">{{$gammer->team_name}}</option>
                     @endforeach
                  </select>
                  </div>
                  @endfor
              </div>
            </div>
 
            <div class="col-md-2">
              <div class="form-group">
                @for ($i = 0; $i<$tournament->max_players; $i++)
                <label>Player2 : <em>*</em></label>  
                 <div class="form-group">             
                  <select name="player2[]" id="player2" selected="selected" >
                     <option value="">--Select Gamer--</option>
                     @foreach($tournamentList as $s_key => $gammer)
                     <option value="{{$gammer->team_id}}">{{$gammer->team_name}} </option>
                     @endforeach
                  </select>
                  </div>
                  @endfor                   
                 </div>
            </div>
          </div>
        <div class="row">           
          <div class="col-md-6">
            <div class="form-group">
                <label>Start time : <em>*</em></label> <br>
                <input type="time" name="start_time" id="start_time" class="form-control" autocomplete="off">
                @if($errors->has('start_time'))
                <span class="roy-vali-error"><small>{{$errors->first('start_time')}}</small></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>End time : <em>*</em></label> <br>
                <input type="time" name="end_time" id="end_time" class="form-control" autocomplete="off">
                @if($errors->has('end_time'))
                <span class="roy-vali-error"><small>{{$errors->first('end_time')}}</small></span>
                @endif
              </div>
            </div>
          </div>
        <div class="row">           
          <div class="col-md-6">
            <div class="form-group">
                <label>Start date : <em>*</em></label> <br>
                <input type="date" name="start_date" id="start_date" class="form-control" autocomplete="off">
                @if($errors->has('start_date'))
                <span class="roy-vali-error"><small>{{$errors->first('start_date')}}</small></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>End date : <em>*</em></label> <br>
                <input type="date" name="end_date" id="end_date" class="form-control" autocomplete="off">
                @if($errors->has('end_date'))
                <span class="roy-vali-error"><small>{{$errors->first('end_date')}}</small></span>
                @endif
              </div>
            </div>
          </div>
        @if($stage->isEmpty())
        @php $stage = 1 @endphp
        @endif
          <div class="row">
           <div class="col-md-6">
              <div class="form-group">
                <label>Stage : <em>*</em></label> <br>
              <input type="number" readonly="readonly"  value="{{$stage}}" name="stage" id="stage" class="form-control" autocomplete="off">
                @if($errors->has('stage'))
                <span class="roy-vali-error"><small>{{$errors->first('stage')}}</small></span>
                @endif
              </div>
            </div>
          </div> 
  <input type="hidden"name="tournament_id"value="{{$tournament->id}}">
            <div class="text-right" >
               <div class="header-elements">
                 <button type="submit" class="btn bg-teal-400 form-group"><i class="fas fa-save mr-1"></i> Save</button>
               </div>
            </div>

      </form>
     </div>

   </div>
</div>

<script>
$(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
}); 
</script>

<script type="text/javascript">
function format ( d ) {
  console.log(d[1].replace(/(.+?\n\n|.+?hidden">)/, ''))
  expand_output = d[1].replace(/(.+?\n\n|.+?hidden">)/, '')
  expand_output = d[1].replace(/(.+?\n\n|.+?hidden">)/, '')
  return `<div>${expand_output}`
}
$(document).ready(function() {
  // data table column in same order
  dataTableColumns = ['Sl No.', 'Team1', 'Team2', 'Start Time', 'End Time', 'Round', 'Image1', 'Image2', 'Winner', 'Action']
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
      "targets": [ 0, 6 ],
      "orderable": false
    }]
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

  $('.dataTable tbody').on( 'click', 'tr td span.expand1', function () {
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

  $('.dataTable tbody').on( 'click', 'tr td span.expand2', function () {
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
<script src="{{ asset('public/assets/lightbox/cartonbox.js') }}"></script>

<script type="text/javascript">
(function($) {
  'use strict';

  // Settings
  var options = {
    onStartBefore: function() {
      $('body').addClass('cartonbox-zoom-start');
      $('.cartonbox-body').addClass('cartonbox-go');
    },
    onShowNow: function() {
      $('body').addClass('cartonbox-zoom-finish');
    },
    onShowAfter: function() {
      $('body').removeClass('cartonbox-zoom-start cartonbox-zoom-finish');
    },
    onClosedBefore: function() {
      $('body').addClass('cartonbox-up');
      $('.cartonbox-body').removeClass('cartonbox-go');
    },
    onClosedAfter: function() {
      $('body').removeClass('cartonbox-up');
    }
  }

  // Initialization
  $.cartonbox(options);
})(jQuery);

</script>

@endsection

