<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Game;
use Illuminate\Http\Request;
use Alert;
use Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
    {   
        $game=Game::where("is_deleted",0)->get();
        return view('admin.genre.create',compact('game'));
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
            return redirect("genre/create")->withErrors($validator)->withInput();
        } else {

            $Genre = new Genre;
            $Genre->name = $request->name;
            $Genre->game_id = $request->game_id;
           
            
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/genre/",$imageName);
                $uploadedImage = "new-theme/images/genre/".$imageName;
                $Genre->image = $uploadedImage;
            }
            $Genre->save();
            Alert::Html('Success', '<h2> Genre Added Successfully </h2>','success');
            return redirect("genre/create");
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        //
    }
}
