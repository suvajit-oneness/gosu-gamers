<?php

namespace App\Http\Controllers;

use App\Models\SocialLinks;
use Illuminate\Http\Request;
use Validator;
use Alert;

class SocialLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sociallinks = SocialLinks::where('is_deleted', 0)->get();
        
        return view('admin.social_links.index', compact('sociallinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.social_links.create');
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
            "link" => $request->link
        ), array(
            "name" => "required",
            "link" => "required"
        ));
        if ($validator->fails()) {
            return redirect("banner/create")->withErrors($validator)->withInput();
        } else {            
            $sociallinks              = new SocialLinks;
            $sociallinks->name =     $request->name;
            $sociallinks->link       = $request->link;
            $valid_images = array(
                "png",
                "jpg",
                "jpeg",
                "gif"
            );
        if ($request->hasFile("image") && in_array($request->image->extension(), $valid_images)) {
            $profile_image = $request->image;
            $imageName     = time() . "." . $profile_image->getClientOriginalName();
            $profile_image->move("new-theme/images/socialLinks/", $imageName);
            $uploadedImage = "new-theme/images/socialLinks/" . $imageName;
            $sociallinks->image = $uploadedImage;
            }$sociallinks->save();
            Alert::Html('Success', '<h2> Social Link Added Successfully </h2>', 'success');
            return redirect("sociallinks");
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialLinks  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sociallinks = SocialLinks::find($id);
        return view('admin.social_links.show',compact('sociallinks'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialLinks  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $sociallinks = SocialLinks::findOrFail($id);
       return view('admin.social_links.edit', compact('sociallinks'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialLinks  $socialLinks
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
            $sociallinks       = SocialLinks::find($request->id);
            $sociallinks->name = $request->name;
            $sociallinks->link = $request->link;
            $valid_images = array(
                "png",
                "jpg",
                "jpeg",
                "gif"
            );
     if ($request->hasFile("image") && in_array($request->image->extension(), $valid_images)) {
            $profile_image = $request->image;
            $imageName     = time() . "." . $profile_image->getClientOriginalName();
            $profile_image->move("new-theme/images/socialLinks/", $imageName);
            $uploadedImage = "new-theme/images/socialLinks/" . $imageName;
            $sociallinks->image = $uploadedImage;
            }$sociallinks->save();
            Alert::Html('Success', '<h2> Social Link Updated Successfully </h2>', 'success');
            return redirect("sociallinks");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialLinks  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $sociallinks = SocialLinks::find($id);
        $status = $sociallinks->is_deleted;
        if ($status == 0) {
          $sociallinks->is_deleted = '1';
        } else {
            $sociallinks->is_deleted = '0';
        }
        $sociallinks->save();
        Alert::Html('Success', '<h2> Social Links Deleted Successfully </h2>', 'success');
        return redirect('sociallinks');
    }
    public function changeStatus($id)
    {
        $sociallinks = SocialLinks::find($id);
        $status = $sociallinks->is_active;
        if ($status == 1) {
            $sociallinks->is_active = '0';
        } else {
            $sociallinks->is_active = '1';
        }
        $sociallinks->save();
        Alert::Html('Success', '<h2> Social Links Status Changed </h2>', 'success');
        return redirect('sociallinks');
    }

}
