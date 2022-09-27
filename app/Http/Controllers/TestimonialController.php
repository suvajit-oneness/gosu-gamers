<?php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Validator;
use Alert;

class TestimonialController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $testimonial = Testimonial::Where( 'is_deleted', 0 )->get();
        return view( 'admin.testimonial.index', compact( 'testimonial' ) );
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.testimonial.create' );
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $validator = Validator::make( array(
            'content' => $request->content,
            'title' => $request->title,
            'image' => $request->image,
            'author' => $request->author,
        ), array(
            'content' => 'required',
            'title' => 'required',
            'image' => 'required',
            'author' => 'required',
        ) );
        if ( $validator->fails() ) {
            return redirect( 'testimonial/create' )
            ->withErrors( $validator )->withInput();
        } else {
            $testimonial = new Testimonial;
            $testimonial->content = $request->content;
            $testimonial->title = $request->title;
            $testimonial->author = $request->author;
            $valid_images = array(
                'png',
                'jpg',
                'jpeg',
                'gif'
            );
            if ( $request->hasFile( 'image' ) && in_array( $request
            ->image
            ->extension(), $valid_images ) ) {
                $profile_image = $request->image;
                $imageName = time() . '.' . $profile_image->getClientOriginalName();
                $profile_image->move( 'new-theme/images/testimonial/', $imageName );
                $uploadedImage = 'new-theme/images/testimonial/' . $imageName;
                $testimonial->image = $uploadedImage;
            }
            $testimonial->save();
            Alert::Html( 'Success', '<h2> Testimonial Added Successfully </h2>', 'success' );
            return redirect( 'testimonial/create' );
        }
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Testimonial  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        $testimonial = Testimonial::find( $id );
        return view( 'admin.testimonial.show', compact( 'testimonial' ) );
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Testimonial  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        $testimonial = Testimonial::findOrFail( $id );
        return view( 'admin.testimonial.edit', compact( 'testimonial' ) );
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Testimonial  $testimonial
    * @return \Illuminate\Http\Response
    */

    public function update1( Request $request ) {
        $testimonial = Testimonial::find( $request->id );
        $testimonial->content = $request->content;
        $testimonial->title = $request->title;
        $testimonial->author = $request->author;
        $valid_images = array(
            'png',
            'jpg',
            'jpeg',
            'gif'
        );
        if ( $request->hasFile( 'image' ) && in_array( $request
        ->image
        ->extension(), $valid_images ) ) {
            $profile_image = $request->image;
            $imageName = time() . '.' . $profile_image->getClientOriginalName();
            $profile_image->move( 'new-theme/images/testimonial/', $imageName );
            $uploadedImage = 'new-theme/images/testimonial/' . $imageName;
            $testimonial->image = $uploadedImage;
        }
        $testimonial->save();
        Alert::Html( 'Success', '<h2> Testimonial Updated Successfully </h2>', 'success' );
        return redirect( 'testimonial' );
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Testimonial  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        $Testimonial = Testimonial::find( $id );
        $status = $Testimonial->is_deleted;
        if ( $status == 0 ) {
            $Testimonial->is_deleted = '1';
        } else {
            $Testimonial->is_deleted = '0';
        }
        $Testimonial->save();
        Alert::Html( 'Success', '<h2> Testimonial Deleted Successfully </h2>', 'success' );
        return redirect( 'testimonial' );
    }

    public function changeStatus( $id ) {
        $Testimonial = Testimonial::find( $id );
        $status = $Testimonial->is_active;
        if ( $status == 1 ) {
            $Testimonial->is_active = '0';
        } else {
            $Testimonial->is_active = '1';
        }
        $Testimonial->save();
        Alert::Html( 'Success', '<h2> Testimonial Status Changed </h2>', 'success' );
        return redirect( 'testimonial' );
    }
}

