@if(Auth::guard('gamer')->check())
   @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.master")
@section("content")
<section class="banner__area game inner">
  <!-- <img src="{!!asset('new-theme\images\site banner\Tournaments.jpg')!!}" class="img-fluid"> -->
  <h2 class="text-center">Tournament Room Details</h2>
</section>

<section class="sponser_bg pt-5 pb-5">
<div class="clearfix"></div>

<div class="container">
  <div><a href="{{ route('gamer.tournaments.show',$user->id) }}" class="edit__team__member text-decoration-none text-light float-right my-3">Back</a>
  </div>
    <div class="team__member__list__table">
      <div class="table-responive">
        <table class="table">
          <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Tournament Name</th>
            <th class="text-center" scope="col">Game Name</th>
            <th class="text-center" scope="col">Room Code</th>
            <th class="text-center" scope="col">Status</th>
          </tr>
          <?php $slno = 1; ?>
          @if($roomData)
          @forelse($roomData as $list)
            <tr>
              <td scope="text-center">{{$slno}}</td>
              <td class="text-center">{{$list->get_tournament->name}}</td>
              <td class="text-center">{{$list->get_tournament->game_name->name}}</td>
              <td class="text-center">{{$list->room_code}}</td>
              <td>@if($list->status == '1') <span class="base-green">Active</span> @endif
                  @if($list->status == '2') <span class="base-red">Inactive</span> @endif
              </td>
            </tr>
          <?php $slno = $slno + 1; ?>  
          @empty
          <tr>
              <td colspan="9">No Rooms Found!</td>
          </tr>
          @endforelse
          @endif
        </table>
      </div>
    </div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection

