<?php

namespace App\Http\Controllers;

use App\Models\CmsContent;
use Illuminate\Http\Request;
use Alert;

class CmsContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cmsList = CmsContent::where('is_deleted', '=', '0')
        ->get();
        return view('admin.contents.index',compact('cmsList'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'page_name' => 'required',
            'title' => 'required',
            'slug' => 'required'
        ]);

        $Cms = new CmsContent;
        $Cms->page_name = trim($request->input('page_name'));
        $Cms->title = trim($request->input('title'));
        $Cms->slug = trim($request->input('slug'));
        $Cms->content = htmlentities(trim($request->input('description')), ENT_QUOTES);


        $Cms->meta_title = $request->input('meta_title');
        $Cms->meta_keyword = $request->input('meta_keyword');
        $Cms->meta_description = $request->input('meta_description');
        
         $Cms->save();
        Alert::Html('Success', '<h2> CMS Added Successfully </h2>', 'success');
            return redirect("cmscontent");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CmsContent  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $CmsContent = CmsContent::find($id);
        return view('admin.contents.show', compact('CmsContent'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CmsContent  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cmscontent = CmsContent::findOrFail($id);
        
        return view('admin.contents.edit', compact('cmscontent'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CmsContent  $cmsContent
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
         $Cms = CmsContent::find($request->id);
        $Cms->page_name = trim($request->input('page_name'));
        $Cms->title = trim($request->input('title'));
        $Cms->slug = trim($request->input('slug'));
        $Cms->content = htmlentities(trim($request->input('description')), ENT_QUOTES);


        $Cms->meta_title = $request->input('meta_title');
        $Cms->meta_keyword = $request->input('meta_keyword');
        $Cms->meta_description = $request->input('meta_description');
        
         $Cms->save();
        Alert::Html('Success', '<h2> CMS updated Successfully </h2>', 'success');
            return redirect("cmscontent");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmsContent  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CmsContent = CmsContent::find($id);
        $status = $CmsContent->is_deleted;
        
        if ($status == 0) {
            $CmsContent->is_deleted = '1';
        } else {
            $CmsContent->is_deleted = '0';
        }
        $CmsContent->save();
        
        Alert::Html('Success', '<h2> CmsContent Deleted Successfully </h2>', 'success');
        return redirect('cmscontent');
    }
       
    public function changeStatus($id)
    {
        
        $CmsContent = CmsContent::find($id);
        $status = $CmsContent->is_active;
        
        if ($status == 1) {
            $CmsContent->is_active = '0';
            
        } else {
            $CmsContent->is_active = '1';
        }
        $CmsContent->save();
        
        Alert::Html('Success', '<h2> CmsContent Status Changed </h2>', 'success');
        return redirect('cmscontent');
    }

}
