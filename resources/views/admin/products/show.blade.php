@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px">Product Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('product.index') }}"><i class="icon-exit ml-2"></i>Back</a>
         </div>
         <div class="content">
            <div class="row">
               <div class="col-md-7">
                  <div class="form-group">
                     <strong>Product Title :</strong>
                     {{$product->title}}
                  </div>
                  <div class="form-group">
                     <strong>Product Category :</strong>
                     @php
                        $productCategoryData = \App\Models\product_category::findOrFail($product->product_category);
                     @endphp {{$productCategoryData->name}}
                  </div>
                  <div class="form-group">
                     <strong>Product Space :</strong>
                     {{$product->product_space}}
                  </div>
                  <div class="form-group">
                     <strong>Product Performance :</strong>
                     {{$product->product_performance}}
                  </div>
                  <div class="form-group">
                     <strong>Product Link :</strong>
                     <a href="{{$product->product_link}}">{{$product->product_link}}</a>
                  </div>
                  <div class="form-group">
                     <strong>View count :</strong>
                     {{$product->view_counter}}
                  </div>
                  <div class="form-group">
                     <strong>View Click Count :</strong>
                     {{$product->click_count}}
                  </div>
                  <div class="form-group">
                     <strong>Games Name</strong>
                  </div>
                     
                     
     		<div class="row">
                     <div class="col-12">
                     <strong class="text-muted">More than 30 FPS</strong>
                     <br>
                     @php
                        if ($product->game_id !="") {
                        $gamesData = substr($product->game_id, 0, -1);
                        $gamesListArr = explode(',', $gamesData);
                        foreach ($gamesListArr as $gamesListKey => $gamesListValue) {
                           $gameSalesData = \App\Models\GameSale::findOrFail($gamesListValue);
                           echo $gameSalesData->name.', ';
                        }
                        }
                     @endphp
                     </div>
                     <div class="col-12">
                     @php
                        if ($product->game_id_medium !="") {
                     @endphp
                     <br>
                     <br>
                     <strong class="text-muted">Below 30 FPS but over 10 FPS</strong>
                     <br>
                     @php
                        $gamesData = substr($product->game_id_medium, 0, -1);
                        $gamesListArr = explode(',', $gamesData);
                        foreach ($gamesListArr as $gamesListKey => $gamesListValue) {
                           $gameSalesData = \App\Models\GameSale::findOrFail($gamesListValue);
                           echo $gameSalesData->name.', ';
                        }
                        }
                     @endphp
                     </div>
                     <div class="col-12">
                     @php
                        if ($product->game_id_low !="") {
                     @endphp
                     <br>
                     <br>
                     <strong class="text-muted">Less than 10 FPS</strong>
                     <br>
                     @php
                        $gamesData = substr($product->game_id_low, 0, -1);
                        $gamesListArr = explode(',', $gamesData);
                        foreach ($gamesListArr as $gamesListKey => $gamesListValue) {
                           $gameSalesData = \App\Models\GameSale::findOrFail($gamesListValue);
                           echo $gameSalesData->name.', ';
                        }
                        }
                     @endphp
                     </div>
                  </div>
                     
                     
               </div>
               <div class="col-md-5"><img src="{{URL::asset($product->image)}}" style="width:200px; height:200px; float:right; 
                     border-radius:10%;">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
