@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "
            href="{{ route('teamstournament.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" enctype="multipart/form-data" action="{{route('teamstournament.store')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">team Name *</td>
                        <td>
                           {{-- <!-- <select class='form-control select2' id='team_id' name='team_id'>
                              @if($teams)
                              @foreach($teams as $index => $teams)
                              <option value="{{ $teams->id }}">{{ ucfirst($teams->team_name) }}</option>
                              @endforeach
                              @endif
                           </select> --> --}}
                           <select name="team_id[]" id="team_id" class="form-control multiselect" multiple="multiple">
                              <option value="">---Select Team---</option>
                              @if($teams)
                              @foreach($teams as $index => $teams)
                              <option value="{{ $teams->id }}">{{ ucfirst($teams->team_name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <td width="15%" class="text-right border-right text-uppercase">tournament Name *</td>
                     <td>
                        <select class='form-control select2' id='tournaments' name='tournament_id'>
                           @if($tournaments)
                           @foreach($tournaments as $index => $tournaments)
                           <option value="{{ $tournaments->id }}">{{ ucfirst($tournaments->name) }}</option>
                           @endforeach
                           @endif
                        </select>
                     </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('teamstournament.create')}}" class="btn bg-teal-400 ml-2"><i
                        class="fas fa-redo mr-1"></i> Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<link href="{{ asset('new-theme/css/fSelect.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('new-theme/js/fSelect.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}
{{-- <script>
   $('.select2').select2();
</script> --}}
<script>
   (function ($) {
       $(function () {
           window.fs_test = $('.multiselect').fSelect();
       });
   })(jQuery);
</script>
@endsection