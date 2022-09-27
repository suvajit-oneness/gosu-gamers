@extends("admin.layouts.master")
@section("content")
<style>
   #room_card .card-title {
      padding-top: 20px;
      margin-bottom: -21px;
   }

   .sortable-group {
  border: dashed 2px #dedede;
  background: #f2f2f2;
  padding: 10px;
}

.sortable-group li {
  cursor: move;
  margin-left: 20px;
}

.sortable-group--empty {
  pointer-events: none;
}

.ui-sortable-placeholder {
  outline: 2px solid red;
  visibility: visible !important;
}

</style>
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Teams List </h5>
         <div class="header-elements">
            @can('Tournaments-Create')
            <div class="list-icons">
               <a href="{{route('tournaments.create')}}" class="btn bg-teal-400 text-uppercase"><i
                     class="fas fa-plus mr-1"></i>Add Tournaments </a>
            </div>
            @endcan
         </div>
      </div>
      
      <form action="{{route('teamassignroom')}}" method="post" accept-charset="utf-8"
         onSubmit="return gamerSelectLimit();">
         @csrf
         <div class="row" id="room_card">
            @if(isset($room))
            @php
            $maxplayer=intdiv($tournament->max_players, $tournament->room_size);
            @endphp
            {{-- <input type="hidden" name="room_size" value="{{ $maxplayer }}"> --}}
            @foreach($room as $key => $r)
            <div class="col-md-3">
               <div class="card">
                  <div class="card-title text-center">
                     <input type="hidden" name="room_code[]" value="{{ $r->room_code }}">
                     <h5>Group {{ $key+1 }}</h5>
                  </div>
                  <div class="card-body">
                     <div class="form-group sortable-container js-sortable-parent js-drop-target">
                           <ol class="sortable-group js-sortable-group js-drop-target">
                              @foreach($tournamentList as $s_key => $gammer)
                                    <li>{{ $gammer->team_name}}
                                       <input name="order" id="{{$gammer->team_id}}" value="" type="hidden">
                                    </li>
                              @endforeach
                           </ol>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            @endif
         </div>
         <input type="hidden" name="tournament_id" value="{{$tournament->id}}">
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
   // sortable data

   var wasMovedOut = function (elem) {
  return $(elem).parent().hasClass("js-sortable-parent");
};

function stopHandler(event, obj) {
  var elem = obj.item[0];
  var sampleSortableGroup = $(".js-sortable-group").first().clone().html("");

  // Wrap an item in a group
  if (wasMovedOut(elem)) {
    $(elem).wrap(sampleSortableGroup);
    sortableGroup = $(".js-sortable-group")
      .sortable({
        connectWith: ".js-drop-target",
        stop: stopHandler
      })
      .disableSelection();
  }

  // Remove
  if (this.children.length === 0) {
    this.remove();
  }
}

// Sortable Configuration
$(".js-sortable-parent").sortable().disableSelection();

var sortableGroup = $(".js-sortable-group")
  .sortable({
    connectWith: ".js-drop-target",
    stop: stopHandler
  })
  .disableSelection();



   $(document).ready(function () {
      /********* Adding more items ************/
      $("#listing > li").draggable({
         connectToSortable: ".sortable",
         cursor: "pointer",
         helper: "clone",
         revert: "true"
      });

      $(".sortable").sortable({
         revert: true,
         update: function (event, ui) {
            //$('#console').html('<b>posts[id] = pos:</b><br>');

            $(".sortable")
               .children()
               .each(function (i) {
                  //var id = $(this).attr('data-post-id')
                  // ,order = $(this).index() + 1;
                  $(this).attr("id", i);

                  var x = $(this).find(".hidden");
                  $(this).find("input").val(i);
                  // $(this).find(x).removeClass("hidden").addClass("remove");

                  // $(this).find(".remove").attr("id", i);
               });
         }
      });

      // $(".remove").click(function () {
      //    $(this).parent().remove();
      //    $(".sortable")
      //       .children()
      //       .each(function (i) {
      //          //var id = $(this).attr('data-post-id')
      //          // ,order = $(this).index() + 1;
      //          $(this).attr("id", i);

      //          var x = $(this).find(".hidden");
      //          $(this).find("input").val(i);
      //          $(this).find(x).removeClass("hidden").addClass("remove");

      //          $(this).find(".remove").attr("id", i);
      //       });
      // });
   });

   // sortable data


   function format(d) {
      expand_output = d[3].replace(`<span class="expand">Show</span><div class="hidden">`, '')
      return `<div>${expand_output}`
   }
   $(document).ready(function () {
      // data table column in same order
      dataTableColumns = ['Sl No.', 'Name', 'Email', 'Gaming ID', 'Payment Status', 'Transaction Id',
         'Payment Amount', 'Payment By', 'Country'
      ]
      // Setup - add a text input to each header cell
      $('.ar-datatable thead th.search').each(function () {
         var title = $(this).text();
         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });
      // generate data table
      var dtTable = $('.ar-datatable').DataTable({
         "pageLength": 100,
         // "order": [[ 1, "asc" ]],
         "columnDefs": [{
            "targets": [0],
            "orderable": false
         }],
         initComplete: function () {
            // add dropdown
            this.api().columns().every(function () {
               var column = this;
               if ([4, 8].indexOf(column[0][0]) != -1) {
                  var select = $('<select><option value="">Select ' + dataTableColumns[column[0][
                        0]] + '</option></select>')
                     .appendTo($(column.header()).empty())
                     .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column
                           .search(val ? '^' + val + '$' : '', true, false)
                           .draw();
                     });
                  column.data().unique().sort().each(function (d, j) {
                     if (column.index() == 0) {
                        d = $(d).text();
                     }
                     select.append('<option value="' + d + '">' + d + '</option>')
                  });
               }
            })
         }
      });
      // Apply the search
      dtTable.columns().every(function () {
         var that = this;

         $('input:not([type="checkbox"])', this.header()).on('keyup change clear', function () {
            if (that.search() !== this.value) {
               that.search(this.value).draw();
            }
         });
      });
      // avoid sorting in click input, select in header
      dtTable.columns().eq(0).each(function (colIdx) {
         $('.no-order, input, select', dtTable.column(colIdx).header()).on('click', function (e) {
            e.stopPropagation();
         });
      });

      // Array to track the ids of the details displayed rows
      var detailRows = [];

      $('.dataTable tbody').on('click', 'tr td span.expand', function () {
         var tr = $(this).closest('tr');
         var row = dtTable.row(tr);
         var idx = $.inArray(tr.attr('id'), detailRows);
         // console.log(idx)
         if (row.child.isShown()) {
            tr.removeClass('details');
            row.child.hide();

            // Remove from the 'open' array
            detailRows.splice(idx, 1);
         } else {
            tr.addClass('details');
            row.child(format(row.data())).show();

            // Add to the 'open' array
            if (idx === -1) {
               detailRows.push(tr.attr('id'));
            }
         }
      });

      // On each draw, loop over the `detailRows` array and show any child rows
      dtTable.on('draw', function () {
         $.each(detailRows, function (i, id) {
            $('#' + id + ' td span.expand').trigger('click');
         });
      });
   });
</script>
<script type="text/javascript">
   $('#selectallgamer').click(function (event) {
      if (this.checked) {
         // Iterate each checkbox
         $(':checkbox').each(function () {
            this.checked = true;
         });
      } else {
         $(':checkbox').each(function () {
            this.checked = false;
         });
      }
   });
</script>
<script type="text/javascript">
   function gamerSelectLimit() {
      var limit = {
         {
            $tournament - > max_players
         }
      };

      var selected_option = $('#gamer_id option:selected').length;
      if (selected_option > limit) {

         $(".error_mgs").html("Please Select Gammer under " + limit);

         return false;
      } else {
         $(".error_mgs").html("");
         return true;
      }
   }
</script>
<script>
   $(document).ready(function () {
      $("select").change(function () {
         $("select").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
      });
   });
</script>
@endsection