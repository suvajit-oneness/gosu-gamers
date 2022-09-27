<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\News_category;
use Illuminate\Http\Request;
use Alert;
use Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news= News::where('is_deleted',0)->get();
        return view('admin.news.index', compact('news')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=News_category::all();
        return view('admin.news.create', compact('category'));
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
                    "content" => $request->content,
                     "image" => $request->image,
                      "post_date" => $request->post_date,
                      "post_time" => $request->post_time,
                       "uploaded_by" => $request->uploaded_by,
                       ), array(
                    "content" => "required",
                    "title" => "required",
                    "image" => "required",
                    "post_date" => "required",
                    "post_time" => "required",
                    "uploaded_by" => "required",));
        if ($validator->fails()) {
            return redirect("news/create")->withErrors($validator)->withInput();
        }else {
            
            $News = new News;
            $News->category_id= $request->category_id;
            $News->content = $request->content;
            $News->title = $request->title;
            $News->post_date = $request->post_date;
            $News->post_time = $request->post_time;
            $News->uploaded_by = $request->uploaded_by;
            $News->partner = $request->partner;
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                // $imageName = time().".".$profile_image->getClientOriginalName();
                $imageName = time(). '_' .rand(1000, 9999).'.'. $profile_image->getClientOriginalExtension();
                $profile_image->move("new-theme/images/News/",$imageName);
                $uploadedImage = "new-theme/images/News/".$imageName;
                $News->image = $uploadedImage;
            }
            $News->save();
        Alert::Html('Success', '<h2> News Added Successfully </h2>','success');
            return redirect("news");
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=News_category::all();
        $news = News::find($id);
        $newscate = News_category::find($news->category_id);
        return view('admin.news.edit', compact('news','category','newscate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {       
            $id=$request->id;
            $News = News::find($id);
            $News->category_id= $request->category_id;
            $News->content = $request->content;
            $News->title = $request->title;
            $News->post_date = $request->post_date;
            $News->uploaded_by = $request->uploaded_by;
            $News->partner = $request->partner;
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                // $imageName = time().".".$profile_image->getClientOriginalName();
                $imageName = time(). '_' .rand(1000, 9999).'.'. $profile_image->getClientOriginalExtension();
                $profile_image->move("new-theme/images/News/",$imageName);
                $uploadedImage = "new-theme/images/News/".$imageName;
                $News->image = $uploadedImage;
            }
            $News->save();
    Alert::Html('Success', '<h2> News Updated Successfully </h2>','success');
            return redirect("news");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $News = News::find($id);
        $status = $News->is_deleted;

        if ($status == 0) {
        $News->is_deleted = '1';
        } else {
        $News->is_deleted = '0';
        }
        $News->save();
    Alert::Html('Success', '<h2> News Deleted Successfully </h2>','success');
        return redirect('news');
    }

    public function changeStatus($id) 
    {
        $News = News::find($id);
        $status = $News->is_active;
        if ($status == 1) {
            $News->is_active = '0';
        
        } else {
            $News->is_active = '1';
            }
        $News->save();
    Alert::Html('Success', '<h2> News Status Changed </h2>','success');
        return redirect('news');
    }

}
