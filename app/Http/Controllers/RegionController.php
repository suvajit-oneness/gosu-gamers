<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Alert;
use Validator;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $region= Region::where('regions.is_deleted',0)
        ->select("regions.*", "continents.name as continent")
        ->leftJoin("continents", "continents.id", "=", "regions.continent_id")
        ->get();
         return view('admin.region.index', compact('region')); 
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.region.create');
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
                    "Name" => $request->name,
                    "continent_id" => $request->continent_id,
                     ), array(                    
                    "Name" => "required",
                    "continent_id" => "required",
        ));
        if ($validator->fails()) {
            return redirect("region/create")->withErrors($validator)->withInput();
        } else {$region = new Region;

            $region->name = $request->name;
            $region->continent_id = $request->continent_id;
            $region->save();
            Alert::Html('Success', '<h2> Region Added Successfully </h2>','success');
            return redirect("region");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::find($id);
        return view('admin.region.show', compact('region'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regions = Region::findOrFail($id);
        return view('admin.region.edit', compact('regions'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {
           $region_id = $request->id;
            $region = Region::find($region_id);
            $region->name = $request->name;
            $region->continent_id = $request->continent_id;
            $region->save();
            Alert::Html('Success', '<h2> Region Updated Successfully </h2>','success');
            return redirect("region");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $region = Region::find($id);
        $status = $region->is_deleted;
        if ($status == 0) {
            $region->is_deleted = '1';
        } else {
            $region->is_deleted = '0';
        }
        $region->save();
        Alert::Html('Success', '<h2> region Deleted Successfully </h2>','success');
        return redirect('region');
    }
    public function changeStatus($id)
   {
        $region = Region::find($id);
        $status = $region->is_active;
        if ($status == 1) {
            $region->is_active = '0'; 
        } else {
            $region->is_active = '1';       
        }
        $region->save();
        Alert::Html('Success', '<h2> Region Status Changed </h2>','success');
        return redirect('region');
    }


}
