@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "
            href="{{ route('product.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-3">
               <table class="table border-bottom border-top">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Product Title*</td>
                        <td>
                           <div class="row">
                              <div class="col-8"><input type="text" class="form-control" name="title">
                                 @error('title') {{$message}} @enderror</div>
                              <div class="col-4">
                                 <select class="form-select form-control" aria-label="Default select example" name="category">
                                 @if(isset($categories))
                                 <option>Select Product Category</option>
                                 @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
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
                           <input type="text" class="form-control" name="product_link">
                           @error('product_link') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Product Specs*</td>
                        <td>
                           <input type="text" class="form-control" name="product_space">
                           @error('product_space') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Product Performance*</td>
                        <td>
                           <input type="text" class="form-control" name="product_performance">
                           @error('product_performance') {{$message}} @enderror
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Image *</td>
                        <td>
                           <input type="file" class="form-control" name="image">
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right border-right text-uppercase">Games*</td>
                        <td>
                           <select class="selectpicker form-control" multiple data-live-search="true" name="game_id[]">
                              <!-- <option value="">---Select Games---</option> -->
                              @if(isset($games))
                              @foreach($games as $games)
                              <option value="{{ $games->id }}">{{ $games->name }}</option>
                              @endforeach
                              @endif
                           </select>
                           @error('games') {{$message}} @enderror
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                  <a href="{{route('product.create')}}" class="btn bg-teal-400 ml-2"><i class="fas fa-redo mr-1"></i>
                     Clear</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection