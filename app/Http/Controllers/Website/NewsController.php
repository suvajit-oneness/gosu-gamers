<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\News_category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('is_active', 1)->where('is_deleted', 0)->where('partner', 'lgn')->orderby('post_date', 'desc')->paginate(16);

        $news_categories = News_category::where('is_active', 1)->where('is_deleted', 0)->orderby('id', 'desc')->get();

        return view('website.news.index', compact('news', 'news_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id, $slug)
    {
        $news = News::find($id);
        return view('website.news.detail', compact('news'));
    }

    public function newsSorting($id, $slug)
    {
        $news = News::where('is_active', 1)->where('is_deleted', 0)->where('category_id', $id)->orderby('id', 'desc')->paginate(16);
        $news_categories = News_category::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.news.index', compact('news', 'news_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function newsclickcount(Request $request){
        $news = News::findOrFail($request->newsId);
        $news->view_count += 1;
        $data = $news->update();

        if ($data) {
            return response()->json(['status' => 200, 'message' => 'Click counter updated'], 200);
        } else {
            return response()->json(['status' => 400, 'message' => 'Something happened'], 400);
        }
    }
}
