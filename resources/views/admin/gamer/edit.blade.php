@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('gamers.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('gamer.update1')}}" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Country *</td>
                        <td>
                           <select class='form-control' id='country' name='country_id'>
                        <option value="{{ $countryname->id }}">{{ ucfirst($countryname->name) }}</option>
                              @if($country)
                              @foreach($country as $index => $country)
                              <option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <input type="hidden" value="{{$gamer->id}}" class="form-control" name="id">
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">First Name  *</td>
                        <td>
                           <input type="text" value="{{$gamer->fname}}" class="form-control" name="fname">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Last Name  *</td>
                        <td>
                           <input type="text" value="{{$gamer->lname}}" class="form-control" name="lname">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Username *</td>
                        <td>
                           <input type="text" value="{{$gamer->username}}" class="form-control" name="username">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Password</td>
                        <td>
                           <input type="password" value="" class="form-control" name="password">
                           (Leave empty to keep the current password)
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase"> 	email *</td>
                        <td>
                           <input type="text" value="{{$gamer->email}}" class="form-control" name="email">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase"> mobile  *</td>
                        <td>
                           <input type="text" value="{{$gamer->mobile}}" class="form-control" name="mobile">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">DOB  *</td>
                        <td>
                           <input type="date" class="form-control" name="dob" value="{{$gamer->dob}}">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Gender *</td>
                        <td>
                           <select class="form-control"id='gender' name='gender' >
                              <option value="Male"@if ($gamer->gender == "Male") selected @endif>Male</option>
                              <option value="Female"@if ($gamer->gender == "Female") selected @endif>Female</option>
                              <option value="Other"@if ($gamer->gender == "Other") selected @endif>Other</option>
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Partner  *</td>
                        <td>
                           <select class="form-control"id='partner' name='partner' >
                              <option value="Gosu"@if ($gamer->partner == "Gosu") selected @endif>Gosu Gamers</option>
                           </select>
                        </td>
                     </tr>

                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image</td>
                        <td>
                           <input type="file" class="form-control" name="image">
                           @if(isset($gamer) && !empty($gamer->image))
                              <br>
                              <img id="image_id" src="{{ asset($gamer->image) }}" height="100px" weight="150px">
                           @endif
                        </td>
                     </tr>

                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">ID Proof</td>
                        <td>
                           @if(isset($gamer) && !empty($gamer->id_proof))
                              <br>
                              <a href="{{ asset($gamer->id_proof) }}" target="_blank"><img id="id_proof" src="{{ asset($gamer->id_proof) }}" height="100px" weight="150px"></a>
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Verified</td>
                        <td>
                           <input type="radio" name="is_verified" value="1" @if($gamer->is_verified == 1) checked @endif>Yes
                           <input type="radio" name="is_verified" value="0" @if($gamer->is_verified == 0) checked @endif>No
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Active</td>
                        <td>
                           <input type="radio" name="is_active" value="1" @if($gamer->is_active == 1) checked @endif>Yes
                           <input type="radio" name="is_active" value="0" @if($gamer->is_active == 0) checked @endif>No
                        </td>
                     </tr>

                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-edit mr-1"></i>Save</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

