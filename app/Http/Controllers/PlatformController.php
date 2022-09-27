<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\Game;
use Illuminate\Http\Request;
use Alert;
use Validator;


class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $platform= Platform::where('is_deleted',0)->get();
       return view('admin.platform.index', compact('platform')); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $game=Game::where("is_deleted",0)->get();
        return view('admin.platform.create',compact('game'));
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
                    "game_id" => $request->game_id,
                    "name" => $request->name,
                    "image" => $request->image,
                      ), array(
                    "game_id" =>"required",
                    "name" => "required",
                    "image" => "required",
                            ));
        if ($validator->fails()) {
            return redirect("platform/create")->withErrors($validator)->withInput();
        } else {
            $platform = new Platform;
            $platform->name = $request->name;
            $platform->game_id = $request->game_id;
            $valid_images = array("png","jpg","jpeg","gif");
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/platform/",$imageName);
                $uploadedImage = "new-theme/images/platform/".$imageName;
                $platform->image = $uploadedImage;
            }
            $platform->save();
        Alert::Html('Success', '<h2> Platform Added Successfully </h2>','success');
            return redirect("platform");
                }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Platform  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $platform = Platform::find($id);
        return view('admin.platform.show', compact('platform'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Platform  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $platform = Platform::find($id);
        return view('admin.platform.edit',compact('platform'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Platform  $platform
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
            $platform = Platform::find($request->id);
            $platform->name = $request->name;            
            $valid_images = array("png","jpg","jpeg","gif");           
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images))
                {
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/platform/",$imageName);
                $uploadedImage = "new-theme/images/platform/".$imageName;
                $platform->image = $uploadedImage;
                }
            $platform->save();
    Alert::Html('Success', '<h2> Platform Updated Successfully </h2>','success');
            return redirect("platform");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Platform  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy( $id)
    {   
        $Platform = Platform::find($id);
        $status = $Platform->is_deleted;
        if ($status == 0) {
            $Platform->is_deleted = '1';
        } else {
            $Platform->is_deleted = '0';
        }
        $Platform->save();
    Alert::Html('Success', '<h2> Platform Deleted Successfully </h2>','success');
        return redirect('platform');
    }
public function changeStatus($id) 
    {
        $Platform = Platform::find($id);
        $status = $Platform->is_active;
        if ($status == 1) {
            $Platform->is_active = '0';        
        } else {
            $Platform->is_active = '1';            }
        $Platform->save();
    Alert::Html('Success', '<h2> Platform Status Changed </h2>','success');
        return redirect('platform');
    }
}
