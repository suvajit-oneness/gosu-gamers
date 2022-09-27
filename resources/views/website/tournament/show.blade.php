@if(Auth::guard('gamer')->check())
@php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")
<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">All Tournaments</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
  <div class="clearfix"></div>

  <div class="container">
    <div><a href="{{ route('gamer.tournaments.create',$user->id) }}" class="btn btn-danger  text-light float-md-right my-3">Add
        Tournament</a></div>
    <div class="team__member__list__table">
      <div class="table-responive">
        <table class="table">
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Strating date</th>
            <th class="text-center">Ending date</th>
            <th class="text-center">Prize Money</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
          </tr>
          <?php $slno = 1; ?>
          @if($tournaments)
          @foreach($tournaments as $data)
          <tr>
            <td>{{$slno}}</td>
            <td class="text-center">{{$data->name}}</td>
            <td class="text-center">{{$data->start_date}}</td>
            <td class="text-center">{{$data->end_date}}</td>
            <td class="text-center">{{$data->prize_money}}</td>
            <td class="text-center">
              <div class="list-icons">
                @if($data->is_active == 0)
                <a class="btn-outline-theme"
                  href="{{ URL::to('gamer/tournaments/change-status/'.$data->id) }}" data-toggle="tooltip" title="Inactive"><i class="fas fa-eye-slash"></i></a>
                @else
                <a class="btn-outline-theme"
                  href="{{ URL::to('gamer/tournaments/change-status/'.$data->id) }}" data-toggle="tooltip" title="Active"><i class="fas fa-eye"></i></a>
                @endif
                <a href="#" data-toggle="modal" data-target="#exampleModalCenter{{$data->id}}" class="btn-outline-theme m-1"><i class="fas fa-trash"></i></a>
                @if($data->stop_joining == 1)
                <a class="btn-outline-theme" href="{{ URL::to('gamer/tournaments/stop-joining/'.$data->id) }}" data-toggle="tooltip" title="Joining
                  Stopped"><i class="fas fa-ban"></i></a>
                @else
                <a class="btn-outline-theme" href="{{ URL::to('gamer/tournaments/stop-joining/'.$data->id) }}" data-toggle="tooltip" title="Can
                  Join"><i class="fas fa-plus"></i></a>
                @endif
              </div>
            </td>
            <td>
              <div class="list-icons text-center">
                <div class="btn-group">
                  <a class="btn-outline-theme" href="{{ route('gamer.tournaments.edit',$data->id) }}" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>

                  <a class="btn-outline-theme position-relative" href="{{ route('gamer.tournaments.chat-list', $data->id) }}" data-toggle="tooltip" title="SMS"><i class="fas fa-sms"></i>
                    {{-- <span class="sms_count">12</span> --}}
                  </a>

                  <a class="btn-outline-theme"
                    href="{{ route('gamer.tournaments.view-tournament-rooms',$data->id) }}" data-toggle="tooltip" title="Room"><i class="fa fa-home"></i></a>
                  <a class="btn-outline-theme" href="{{ route('gamer.gamerteam',$data->id) }}" data-toggle="tooltip" title="Gamer"><i class="fas fa-headset"></i></a>
                  <a class="btn-outline-theme" href="{{ route('gamer.tournaments.schedule-details',$data->id) }}" data-toggle="tooltip" title="Full Schedule"><i class="fas fa-calendar"></i></a>
                  <a class="btn-outline-theme" href="{{ route('gamer.tournaments.user_list',$data->id) }}" data-toggle="tooltip" title="Make Schedule"><i class="fas fa-calendar-plus"></i></a>
                </div>
              </div>


              <!-- Modal -->
              <div class="modal fade addGameId_modal" id="exampleModalCenter{{$data->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Confirm Delete</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.
                      </p>
                      <p>Do you want to proceed?</p>
                    </div>
                    <div class="modal-footer add_game_field">
                      {!! Form::open(['method' => 'delete','route' => ['gamer.tournaments.destroy',
                      $data->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'add_game_id_submit d-inline-block w-auto']) !!}
                      <button type="button" class="add_game_id_submit w-auto d-inline-block" data-dismiss="modal">Cancel</button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <?php $slno = $slno + 1; ?>
          @endforeach
          @endif
        </table>
      </div>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endsection