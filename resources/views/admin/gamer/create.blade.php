@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('gamers.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('gamers.store')}}" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Country *</td>
                        <td>
                           <select class='form-control select2' id='country' name='country_id'>
                              @if($country)
                              @foreach($country as $index => $country)
                              <option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">First Name  *</td>
                        <td>
                           <input type="text" class="form-control" name="fname">
                           @error('fname') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Last Name  *</td>
                        <td>
                           <input type="text" class="form-control" name="lname">
                           @error('lname') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Username *</td>
                        <td>
                           <input type="text" value="{{old('username','')}}" class="form-control" name="username">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Password *</td>
                        <td>
                           <input type="password" class="form-control" name="password">
                           @error('password') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">email *</td>
                        <td>
                           <input type="text" class="form-control" name="email" value="{{old('email','')}}">
                           @error('email') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase"> mobile  *</td>
                        <td>
                           <input type="text" class="form-control" name="mobile" value="{{old('mobile','')}}">
                           @error('mobile') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">DOB  *</td>
                        <td>
                        
                            <input type="date" class="form-control" name="dob">
                           @error('dob') {{$message}} @enderror
                        </td>
                     </tr>

                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Gender *</td>
                        <td>
                           <select class="form-control"id='gender' name='gender' >
                              <option value="Male"@if (old('gender') == "Male") selected @endif>Male</option>
                              <option value="Female"@if (old('gender') == "Female") selected @endif>Female</option>
                              <option value="Other"@if (old('gender') == "Other") selected @endif>Other</option>
                           </select>
                        </td>
                     </tr>

                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Partner  *</td>
                        <td>
                           <select class="form-control"id='partner' name='partner' >
                              <option value="Gosu"@if (old('partner') == "Gosu") selected @endif>Gosu Gamers</option>
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image *</td>
                        <td>
                           <input type="file" class="form-control" name="image">  
                           @error('Num code') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Verified</td>
                        <td>
                           <input type="radio" name="is_verified" value="1" @if(old('is_verified') == 1) checked @endif>Yes
                           <input type="radio" name="is_verified" value="0" @if(old('is_verified') == 0) checked @endif>No
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Active</td>
                        <td>
                           <input type="radio" name="is_active" value="1" @if(old('is_active') == 1) checked @endif>Yes
                           <input type="radio" name="is_active" value="0" @if(old('is_active') == 0) checked @endif>No
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('gamers.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i> Clear</a>
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