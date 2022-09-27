<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Alert;
use Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $faq= Faq::where('is_deleted',0)->get();

        
        return view('admin.faq.index', compact('faq')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
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
                    "question" => $request->question,
                    "answer" => $request->answer,
                      ), array(
                    "question" => "required",
                    "answer" => "required",
                            ));
        if ($validator->fails()) {
            return redirect("faq/create")->withErrors($validator)->withInput();
        } else {
            $faq = new Faq;
            $faq->question = $request->question;
            $faq->answer = $request->answer;      
            $faq->save();
            Alert::Html('Success', '<h2> FAQ Added Successfully </h2>','success');
            return redirect("faq");}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $id
     * @return \Illuminate\Http\Response
     */
      public function show($id)
    {
         $faq = Faq::find($id);
        return view('admin.faq.show', compact('faq'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
            $faq = Faq::find($request->id);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
            Alert::Html('Success', '<h2> FAQ Updated Successfully </h2>','success');
            return redirect("faq");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
         $Faq = Faq::find($id);
        $status = $Faq->is_deleted;

        if ($status == 0) {
            $Faq->is_deleted = '1';
        } else {
            $Faq->is_deleted = '0';
        }
        $Faq->save();

     Alert::Html('Success', '<h2> Faq Deleted Successfully </h2>','success');
        return redirect('faq');
    }   

public function changeStatus($id)
    {

        $Faq = Faq::find($id);
        $status = $Faq->is_active;

        if ($status == 1) {
            $Faq->is_active = '0';
        
        } else {
            $Faq->is_active = '1';
            }
        $Faq->save();

        Alert::Html('Success', '<h2> Faq Status Changed </h2>','success');
        return redirect('faq');
    }

   

    
}
