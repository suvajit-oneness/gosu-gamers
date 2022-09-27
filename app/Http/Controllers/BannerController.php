<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Banner;
use Illuminate\Http\Request;
use Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::where('is_deleted', 0)->get();

        return view('admin.banner.index', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banner $banner)
    {
        $partners = $banner->getPartners();
        return view('admin.banner.create', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(array(
            "description" => $request->description,
            "title" => $request->title
        ), array(
            "description" => "required",
            "title" => "required"
        ));
        if ($validator->fails()) {
            return redirect("banner/create")->withErrors($validator)->withInput();
        } else {
            $Banner = new Banner();
            $Banner->description = $request->description;
            $Banner->title = $request->title;
            $Banner->partner = $request->partner;

            $valid_images = array(
                "png",
                "jpg",
                "jpeg",
                "gif"
            );
            if ($request->hasFile("image") && in_array($request->image->extension(), $valid_images)) {
                $profile_image = $request->image;
                $imageName = time() . "." . $profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/banner/", $imageName);
                $uploadedImage = "new-theme/images/banner/" . $imageName;
                $Banner->image = $uploadedImage;
            }
            $Banner->save();
            Alert::Html('Success', '<h2> Banner Added Successfully </h2>', 'success');
            return redirect("banner");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Banner $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Banner $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        $banner2 = new Banner();
        $partners = $banner2->getPartners();

        return view('admin.banner.edit', compact('banner', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $id = $request->id;
        $Banner = Banner::find($id);

        $Banner->description = $request->description;
        $Banner->title = $request->title;
        $Banner->partner = $request->partner;

        $valid_images = array(
            "png",
            "jpg",
            "jpeg",
            "gif"
        );

        if ($request->hasFile("image") && in_array($request->image->extension(), $valid_images)) {
            $old_image = $Banner->image;

            $profile_image = $request->image;
            $imageName = time() . "." . $profile_image->getClientOriginalName();
            $profile_image->move("new-theme/images/banner/", $imageName);
            $uploadedImage = "new-theme/images/banner/" . $imageName;
            $Banner->image = $uploadedImage;

            // now delete the old image
            if(file_exists(public_path($old_image))){
                @unlink(public_path($old_image));
            }
        }
        $Banner->save();
        Alert::Html('Success', '<h2> Banner Updated Successfully </h2>', 'success');
        return redirect("banner");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Banner $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Banner = Banner::find($id);
        $status = $Banner->is_deleted;

        if ($status == 0) {
            $Banner->is_deleted = '1';
        } else {
            $Banner->is_deleted = '0';
        }
        $Banner->save();

        Alert::Html('Success', '<h2> Banner Deleted Successfully </h2>', 'success');
        return redirect('banner');
    }


    public function changeStatus($id)
    {

        $Banner = Banner::find($id);
        $status = $Banner->is_active;

        if ($status == 1) {
            $Banner->is_active = '0';
        } else {
            $Banner->is_active = '1';
        }
        $Banner->save();

        Alert::Html('Success', '<h2> Banner Status Changed </h2>', 'success');
        return redirect('banner');
    }
}
