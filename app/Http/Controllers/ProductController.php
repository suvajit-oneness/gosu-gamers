<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\GameSale;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PCExport;
use App\Exports\LaptopExport;
use App\Models\product_category;
use Alert;
use Validator;

class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $product= Product::all();
           $gamesList = GameSale::all();
           $categories = product_category::all();

        return view('admin.products.desktop', compact('product', 'gamesList', 'categories')); 
    }
    public function desktop()
    {
           $product= Product::where('product_category',1)->get();
           $gamesList = GameSale::all();
           $categories = product_category::all();

        return view('admin.products.desktop', compact('product', 'gamesList', 'categories')); 
    }
    public function laptop()
    {
           $product= Product::where('product_category',2)->get();
           $gamesList = GameSale::all();
           $categories = product_category::all();

        return view('admin.products.laptop', compact('product', 'gamesList', 'categories')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = GameSale::all();
        $categories = product_category::all();
        return view('admin.products.create', compact( 'games', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
          $validator = Validator::make(array(
                    "title" => $request->title,
                    "product_link" => $request->product_link,
                    "product_space" => $request->product_space,
                    "product_performance" => $request->product_performance,
                      ), array(
                    "title" => "required",
                    "product_link" => "required",
                    "product_space" => "required",
                    "product_performance" => "required",
                            ));
        if ($validator->fails()) {
            return redirect("product/create")->withErrors($validator)->withInput();
        } else {
            $game_id = '';
            $product = new Product;
            $product->title = trans($request->title);
            $product->product_link = $request->product_link;
            $product->product_space = $request->product_space;
            $product->product_performance = $request->product_performance;
            $product->product_category = $request->category;

            $valid_images = array("png","jpg","jpeg","webp");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/product_image/",$imageName);
                $uploadedImage = "new-theme/images/product_image/".$imageName;
                $product->image = $uploadedImage;
            }

            if ( $request->game_id == '' ) {
                $product->game_id = '0';
            } else {
                $gameg = $request->game_id;
                for ( $k = 0; $k < count( $gameg );
                $k++ ) {
                    $game_id = $game_id . $gameg[$k] . ',';
                }
                $product->game_id = $game_id;
            }

            $product->save();
            Alert::Html('Success', '<h2> Product Added Successfully </h2>','success');
            return redirect("product");
    }
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $id
     * @return \Illuminate\Http\Response
     */
  public function show($id)
    {
        $gamesList = GameSale::where( 'is_deleted', 0 )->get();
        $product = Product::find($id);
        return view('admin.products.show', compact('product','gamesList'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $gamesList = GameSale::where( 'is_deleted', 0 )->get();
        $categories = product_category::where( 'is_deleted', 0 )->get();
        return view('admin.products.edit', compact('product', 'gamesList', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
            $id = $request->id;
            $product = Product::find($id);
            $product->title = $request->title;
            $product->product_link = $request->product_link;
            $product->product_space = $request->product_space;
            $product->product_performance = $request->product_performance;
            $product->product_category = $request->category;
            

            $valid_images = array("png","jpg","jpeg","webp");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/product_image/",$imageName);
                $uploadedImage = "new-theme/images/product_image/".$imageName;
                $product->image = $uploadedImage;

            }
            $gameg = $request->input( 'games' );
                $games = '';
                for ( $k = 0; $k < count( $gameg );
                $k++ ) {
                    $games = $games . $gameg[$k] . ',';
                }
                $product['game_id'] = $games;

            $product->save();
            Alert::Html('Success', '<h2> Product Updated Successfully </h2>','success');
            return redirect("product");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
        public function destroy( $id)
    {
         $product = Product::find($id);
        $status = $product->is_deleted;

        if ($status == 0) {
            $product->is_deleted = '1';
        } else {
            $product->is_deleted = '0';
        }
        $product->save();

       Alert::Html('Success', '<h2> Product Deleted Successfully </h2>','success');
        return redirect('product');
    }


    public function changeStatus($id) 
   {
        $product = Product::find($id);
        $status = $product->is_active;
        if ($status == 1) {
        $product->is_active = '0';
        } else {
            $product->is_active = '1';
            }
        $product->save();
        Alert::Html('Success', '<h2> Product Status Changed </h2>','success');
        return redirect('product');
    }
    
    public function pc_details_export() {
        return Excel::download( new PCExport(), 'PC.xlsx' );
    }
    public function laptop_details_export() {
        return Excel::download( new LaptopExport(), 'laptop.xlsx' );
    }
}
