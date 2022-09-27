@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('country.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('country.update1')}}">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Region Name *</td>
                        <td>
                           <select class='form-control' id='region' name='region_id'>
                              @if($regions)
                              @foreach($regions as $index => $region)
                              <option value="{{ $region->id }}">{{ ucfirst($region->name) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                        <input type="hidden" class="form-control" value="{{$country->id}}" name="id">
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Name  *</td>
                        <td>
                           <input type="text" class="form-control" value="{{$country->name}}" name="name">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">iso3 *</td>
                        <td>
                           <input type="text" class="form-control" value="{{$country->iso3}}" name="iso3">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">num code *</td>
                        <td>
                           <input type="text" class="form-control" value="{{$country->numcode}}" name="numcode">  
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">phone code *</td>
                        <td>
                           <input type="text" class="form-control" value="{{$country->phonecode}}" name="phonecode"> 
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

