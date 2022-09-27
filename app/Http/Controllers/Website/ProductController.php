<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\GameSale;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function desktop()
    {
        $product= Product::where('product_category',1)->paginate(20);
        $gamesList = GameSale::all();

     return view('website.products.desktop', compact('product', 'gamesList')); 
    }
    
    public function laptop()
    {
        $product= Product::where('product_category',2)->paginate(20);
        $gamesList = GameSale::all();

     return view('website.products.laptop', compact('product', 'gamesList')); 

    }
    public function saving()
    {
        $product= Product::where('product_category',1)->paginate(20);
        $gamesList = GameSale::all();

     return view('website.products.saving', compact('product', 'gamesList')); 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function desktopdetails($id)
    {
        $gamesList = GameSale::where('is_deleted', 0 )->get();
        $product = Product::find($id);
        return view('website.products.desktopdetails', compact('product','gamesList'));
    }

    public function laptopdetails($id)
    {
        $gamesList = GameSale::where( 'is_deleted', 0 )->get();
        $product = Product::find($id);
        return view('website.products.laptopdetails', compact('product','gamesList'));
    }

    public function newsclickcount(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        $product->click_count += 1;
        $resp = $product->update();
        $product_link = $product->product_link;

        if ($resp) {
            return response()->json(['status' => 200, 'message' => 'Click counter updated', 'data' => $product_link], 200);
        } else {
            return response()->json(['status' => 400, 'message' => 'Something happened'], 400);
        }
    }
}
