@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('teams.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('teams.store')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Team Name  *</td>
                        <td>
                           <input type="text" class="form-control" name="team_name">
                           @error('team_name') {{$message}} @enderror
                        </td>
                     </tr>

                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">First Name  *</td>
                        <td>
                           <input type="text" class="form-control" name="first_name">
                           @error('first_name') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Last Name  *</td>
                        <td>
                           <input type="text" class="form-control" name="last_name">
                           @error('last_name') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Country *</td>
                        <td>
                           <select class='form-control select2' id='region' name='country_id'>
                              @if($country)
                              @foreach($country as $index => $country)
                              <option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Email  *</td>
                        <td>
                           <input type="text" class="form-control" name="email">
                           @error('email') {{$message}} @enderror
                        </td>
                     </tr>
                        <tr>
                        <td width="15%" class="text-right border-right text-uppercase">mobile  *</td>
                        <td>
                           <input type="text" class="form-control" name="mobile">
                           @error('mobile') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Password *</td>
                        <td>
                           <input type="password" class="form-control" name="password">  
                           @error('password') {{$message}} @enderror
                        </td>
                     </tr>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                   <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('teams.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
@endsection

