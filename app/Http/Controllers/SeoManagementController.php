<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Seo_management;
use Illuminate\Http\Request;
use Validator;

class SeoManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seo_management = Seo_management::where('is_deleted', 0)->get();
        return view('admin.seo_management.index', compact('seo_management'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seo_management.create');
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
            "page_name" => $request->page_name,
            "slug" => $request->slug,
            "meta_title" => $request->meta_title,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description,
        ), array(
            "page_name" => "required",
            "slug" => "required",
            "meta_title" => "required",
            "meta_keywords" => "required",
            "meta_description" => "required",
        ));
        if ($validator->fails()) {
            return redirect("seomanagement/create")->withErrors($validator)->withInput();
        } else {
            $faq = new Seo_management;
            $faq->page_name = $request->page_name;
            $faq->slug = $request->slug;
            $faq->meta_title = $request->meta_title;
            $faq->meta_keywords = $request->meta_keywords;
            $faq->meta_description = $request->meta_description;
            $faq->save();
            Alert::Html('Success', '<h2> Seo Management Added Successfully </h2>', 'success');
            return redirect("seomanagement");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Seo_management $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seo_management = Seo_management::find($id);
        return view('admin.seo_management.show', compact('seo_management'));
    }




    /*
     * Called from header.blade.php for dynamic meta
     */
    public static function getMetaTitle($slug = "/", $what = "meta_title")
    {
        $meta = $flight = Seo_management::firstWhere('slug', $slug);

        if($meta) {
            return $meta->$what;
        } else {
            return false;
        }
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Seo_management $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seo_management = Seo_management::find($id);
        return view('admin.seo_management.edit', compact('seo_management'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Seo_management $seo_management
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
        $faq = Seo_management::find($request->id);
        $faq->page_name = $request->page_name;
        $faq->slug = $request->slug;
        $faq->meta_title = $request->meta_title;
        $faq->meta_keywords = $request->meta_keywords;
        $faq->meta_description = $request->meta_description;
        $faq->save();
        Alert::Html('Success', '<h2> Seo Management Updated Successfully </h2>', 'success');
        return redirect("seomanagement");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Seo_management $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
         * Old method, no idea why it was soft deleting, changing it to hard delete - Nir
         */
        /*
        $Seo_management = Seo_management::find($id);
        $status = $Seo_management->is_deleted;
        if ($status == 0) {
            $Seo_management->is_deleted = '1';
        } else {
            $Seo_management->is_deleted = '0';
        }
        $Seo_management->save();
        */

        //  Hard delete added by Nir
        Seo_management::find($id)->delete();


        Alert::Html('Success', '<h2> Seo Management Deleted Successfully </h2>', 'success');
        return redirect('seomanagement');
    }

    public function changeStatus($id)
    {
        $Seo_management = Seo_management::find($id);
        $status = $Seo_management->is_active;
        if ($status == 1) {
            $Seo_management->is_active = '0';
        } else {
            $Seo_management->is_active = '1';
        }
        $Seo_management->save();
        Alert::Html('Success', '<h2> Seo Management Status Changed </h2>', 'success');
        return redirect('seomanagement');
    }

}
