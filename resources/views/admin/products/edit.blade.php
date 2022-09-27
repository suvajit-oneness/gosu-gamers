@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('product.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('product.update')}}" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                     <td width="15%" class="text-right border-right text-uppercase">Product Title*</td>
                        <td>
                           <!-- <input type="text" class="form-control" value="{{$product->title}}" name="title"> -->
                           <div class="row">
                              <div class="col-8"><input type="text" class="form-control" name="title" value="{{$product->title}}">
                                 @error('title') {{$message}} @enderror</div>
                              <div class="col-4">
                                 <select class="form-select form-control" aria-label="Default select example" name="category">
                                 @if(isset($categories))
                                 <option>Select Product Category</option>
                                 @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $product->product_category) selected @endif>{{ $category->name }}</option>
                                 @endforeach
                                 @endif
                                 </select>
                                 @error('category') {{$message}} @enderror</div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Product Link*</td>
                        <td>
                           <input type="text" class="form-control" value="{{$product->product_link}}" name="product_link">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Product Specs*</td>
                        <td>
                           <input type="text" class="form-control" value="{{$product->product_space}}" name="product_space">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Product Performance*</td>
                        <td>
                           <input type="text" class="form-control" value="{{$product->product_performance}}" name="product_performance">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Games*</td>
                        <td>
                            @php
                                $available_games_id = explode(',', substr($product->game_id, 0, -1));
                            @endphp
                            <select class="selectpicker form-control" multiple data-live-search="true" name="games[]">
                               <!-- <option value="">---Select Games---</option> -->
                               @if(isset($gamesList))
                                  @foreach($gamesList as $games)
                                  <option value="{{ $games->id }}" @if(in_array($games->id, $available_games_id)) selected @endif>
                                    {{ $games->name }}
                                  </option>
                                  @endforeach
                               @endif
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image</td>
                        <td>
                          <div class="row">
                             <div class="col-md-9"><input type="file" value="{{$product->image}}" class="form-control" name="image"></div>
                             <div class="col-md-3"> 
                                <img src="{{URL::asset($product->image)}}" style="width:100px; height:100px; float:right; 
                        border-radius:10%;"></div>
                          </div>
                        </td>
                     </tr>
                     <input type="hidden" value="{{$product->id}}" class="form-control" name="id">
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

