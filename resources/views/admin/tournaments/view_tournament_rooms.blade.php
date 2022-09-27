@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Room </h5>
         <div class="header-elements">
            @can('Tournaments-Create')
            <div class="list-icons">
               <a href="{{route('tournaments.index')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Add Tournaments </a>
            </div>
            @endcan
         </div>
      </div>
      <div class="table-responsive">
         <table id="example1" class="table table-striped datatable-responsive">
            <thead>              
               <tr class="bg-teal-400">
                  <th>Sl No.</th>
                  <th>Tournament Name</th>
                  <th>Game Name</th>
                  <th>Room Code</th>
                  <th>Status</th>
               </tr>
               @if(isset($roomData))
               @php $sl = 1; @endphp
               @forelse($roomData as $list) 
               <tbody>                  
               <tr>
                  <td>{{ $sl }}</td>
                  <td>{{ $list->get_tournament->name }}</td>
                  <td>{{ $list->get_tournament->game_name->name }}</td>
                  <td>{{ $list->room_code }}</td>
                  <td>@if($list->status == '1') <span class="base-green">Active</span> @endif
                     @if($list->status == '2') <span class="base-red">Inactive</span> @endif
                  </td>
               </tr>
               @php $sl++; @endphp
               @empty
               <tr>
                  <td colspan="9">No Rooms Found!</td>
               </tr>
               @endforelse
               @endif
             </thead>            
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection

