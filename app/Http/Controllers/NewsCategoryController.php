<?php

namespace App\Http\Controllers;

use App\Models\News_category;
use Illuminate\Http\Request;
use Alert;
use Validator;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_category= News_category::where('is_deleted',0)->get();
          
        return view('admin.news_category.index', compact('news_category')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news_category.create');
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
                    "image" => $request->image,
                      ), array(
                    "name" => "required",
                    "image" => "required",
                            ));
        if ($validator->fails()) {
            return redirect("newscategory/create")->withErrors($validator)->withInput();
        } else {

            $newscategory = new News_category;
            $newscategory->name = $request->name;
           
            
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/newscategory/",$imageName);
                $uploadedImage = "new-theme/images/newscategory/".$imageName;
                $newscategory->image = $uploadedImage;
            }
            $newscategory->save();
            Alert::Html('Success', '<h2> News Category Added Successfully </h2>','success');
            return redirect("newscategory");
        }   



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News_category  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {
        $news_category = News_category::find($id);
        return view('admin.news_category.show', compact('news_category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News_category  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news_category = News_category::find($id);
        return view('admin.news_category.edit', compact('news_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News_category  $news_category
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {   
            $id=$request->id;
            $newscategory =  News_category::find($id);
            $newscategory->name = $request->name;
           
            
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/newscategory/",$imageName);
                $uploadedImage = "new-theme/images/newscategory/".$imageName;
                $newscategory->image = $uploadedImage;
            }
            $newscategory->save();
            Alert::Html('Success', '<h2> News Category Update Successfully </h2>','success');
            return redirect("newscategory");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News_category  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
         $News_category = News_category::find($id);
         $status = $News_category->is_deleted;

        if ($status == 0) {
            $News_category->is_deleted = '1';
        } else {
            $News_category->is_deleted = '0';
        }
        $News_category->save();
Alert::Html('Success', '<h2> News Category Deleted Successfully </h2>','success');
        return redirect('newscategory');
    }
    
    public function changeStatus($id)
    {
        $News_category = News_category::find($id);
        $status = $News_category->is_active;
        if ($status == 1) {
           $News_category->is_active = '0';
        } else {
            $News_category->is_active = '1';
            }
        $News_category->save();
    Alert::Html('Success', '<h2> News Category Status Changed </h2>','success');
        return redirect('newscategory');
    }

}
