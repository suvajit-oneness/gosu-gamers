<?php

namespace App\Http\Controllers;
use App\Models\product_category;
use Illuminate\Http\Request;
use Alert;
use Validator;
class ProductCategoryController extends Controller
{    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
          $category= product_category::where('is_deleted',0)->get();

       return view('admin.product_category.index', compact('category')); 
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('admin.product_category.create');
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
                   "name" => $request->name,
                     ), array(
                   "name" => "required",
                           ));
       if ($validator->fails()) {
           return redirect("category/create")->withErrors($validator)->withInput();
       } else {

           $category = new product_category;
           $category->name = trans($request->name);
           $category->save();
           Alert::Html('Success', '<h2> Category Added Successfully </h2>','success');
           return redirect("category");
   }
}
   /**
    * Display the specified resource.
    *
    * @param  \App\Models\product_category  $id
    * @return \Illuminate\Http\Response
    */
 public function show()
   {

   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\product_category  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       $category = product_category::findOrFail($id);
      
  
       return view('admin.product_category.edit', compact('category'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\product_category  $game
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request)
   {   
           $id = $request->id;
           $category = product_category::find($id);
           $category->name = trans($request->name);
           
           $category->save();
           Alert::Html('Success', '<h2> Category Updated Successfully </h2>','success');
           return redirect("category");
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\product_category  $category
    * @return \Illuminate\Http\Response
    */
       public function destroy( $id)
   {
        $category = product_category::find($id);
       $status = $category->is_deleted;

       if ($status == 0) {
           $category->is_deleted = '1';
       } else {
           $category->is_deleted = '0';
       }
       $category->save();

      Alert::Html('Success', '<h2> Category Deleted Successfully </h2>','success');
       return redirect('category');
   }


   public function changeStatus($id) 
  {
       $category = product_category::find($id);
       $status = $category->is_active;
       if ($status == 1) {
       $category->is_active = '0';
       } else {
           $category->is_active = '1';
           }
       $category->save();
       Alert::Html('Success', '<h2> Category Status Changed </h2>','success');
       return redirect('category');
   }
    
}
