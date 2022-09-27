<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Alert;
use Validator;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $sponsor= Sponsor::where('is_deleted',0)->get();

        return view('admin.sponsor.index',compact('sponsor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sponsor.create');
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
                    "title" => $request->title,
                    "image" => $request->image,
                      ), array(
                    "title" =>"required",
                    "name" => "required",
                    "image" => "required",
                            ));
        if ($validator->fails()) {
            return redirect("sponsor/create")->withErrors($validator)->withInput();
        } else {
            $sponsor = new Sponsor;
            $sponsor->name = $request->name;
            $sponsor->title = $request->title;           
            $valid_images = array("png","jpg","jpeg","gif");
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/sponsor/",$imageName);
                $uploadedImage = "new-theme/images/sponsor/".$imageName;
                $sponsor->image = $uploadedImage;
            }
            $sponsor->save();
            Alert::Html('Success', '<h2> Sponsor Added Successfully </h2>','success');
            return redirect("sponsor");
                }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sponsor = Sponsor::find($id);
        return view('admin.sponsor.show', compact('sponsor'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);        
        return view('admin.sponsor.edit', compact('sponsor'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $sponsor =  Sponsor::find($request->id);
        $sponsor->name = $request->name;
        $sponsor->title = $request->title;
        $valid_images = array("png","jpg","jpeg","gif");
              if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/sponsor/",$imageName);
                $uploadedImage = "new-theme/images/sponsor/".$imageName;
                $sponsor->image = $uploadedImage;
                }
            $sponsor->save();
            Alert::Html('Success', '<h2> Sponsor Updated Successfully </h2>','success');
            return redirect("sponsor");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $Sponsor = Sponsor::find($id);
        $status = $Sponsor->is_deleted;
        if ($status == 0) {
            $Sponsor->is_deleted = '1';
        } else {
            $Sponsor->is_deleted = '0';
        }
        $Sponsor->save();        
        Alert::Html('Success', '<h2> Sponsor Deleted Successfully </h2>', 'success');
        return redirect('sponsor');
    }
    
    public function changeStatus($id)
    {
        $Sponsor = Sponsor::find($id);
        $status = $Sponsor->is_active;
        if ($status == 1) {
            $Sponsor->is_active = '0';
           } else {
            $Sponsor->is_active = '1';
        }
        $Sponsor->save();        
        Alert::Html('Success', '<h2> Sponsor Status Changed </h2>', 'success');
            return redirect('sponsor');
    }
}
