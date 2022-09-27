<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Alert;
use Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $game= Game::where('is_deleted',0)->get();

        return view('admin.game.index', compact('game')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game.create');
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
                    "description" => $request->description,
                      ), array(
                    "description" => "required",
                    "name" => "required",
                            ));
        if ($validator->fails()) {
            return redirect("game/create")->withErrors($validator)->withInput();
        } else {

            $Game = new Game;
            $Game->description = $request->description;
            $Game->name = $request->name;
            
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/game/",$imageName);
                $uploadedImage = "new-theme/images/game/".$imageName;
                $Game->image = $uploadedImage;
            }
            $Game->save();
            Alert::Html('Success', '<h2> Game Added Successfully </h2>','success');
            return redirect("game");
    }
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $id
     * @return \Illuminate\Http\Response
     */
  public function show($id)
    {
         $game = Game::find($id);
        return view('admin.game.show', compact('game'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $game = Game::findOrFail($id);
       
   
        return view('admin.game.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {   
            $id = $request->id;
            $Game = Game::find($id);
            $Game->description = $request->description;
            $Game->name = $request->name;
            
            $valid_images = array("png","jpg","jpeg","gif");
            
            if($request->hasFile("image") && in_array($request->image->extension(),$valid_images)){
                
                $profile_image = $request->image;
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("new-theme/images/game/",$imageName);
                $uploadedImage = "new-theme/images/game/".$imageName;
                $Game->image = $uploadedImage;
            }
            $Game->save();
            Alert::Html('Success', '<h2> Game Updated Successfully </h2>','success');
            return redirect("game");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
        public function destroy( $id)
    {
         $Game = Game::find($id);
        $status = $Game->is_deleted;

        if ($status == 0) {
            $Game->is_deleted = '1';
        } else {
            $Game->is_deleted = '0';
        }
        $Game->save();

       Alert::Html('Success', '<h2> Game Deleted Successfully </h2>','success');
        return redirect('game');
    }


public function changeStatus($id) 
   {
        $game = Game::find($id);
        $status = $game->is_active;
        if ($status == 1) {
        $game->is_active = '0';
        } else {
            $game->is_active = '1';
            }
        $game->save();
        Alert::Html('Success', '<h2> Game Status Changed </h2>','success');
        return redirect('game');
    }

}
