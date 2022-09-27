<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Validator;
use Alert;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country= Country::where('countries.is_deleted',0)
            ->select("countries.*", "regions.name as region")
            ->leftJoin("regions as regions", "regions.id", "=", "countries.region_id")
           ->get();

        return view('admin.country.index', compact('country')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $regions= Region::all();

        return view('admin.country.create', compact('regions'));
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
                    "region_id" => $request->region_id,
                    "Name" => $request->name,
                    "Iso3" => $request->iso3,
                    "Num code" => $request->numcode,
                    "Phone code" => $request->phonecode
                        ), array(
                    "region_id" => "required",
                    "Name" => "required",
                    "Iso3" => "required",
                    "Num code" => "required",
                    "Phone code" => "required",
        ));
        if ($validator->fails()) {
            return redirect("country/create")->withErrors($validator)->withInput();
        } else {$country = new Country;
            $country->region_id = $request->region_id;
            $country->name = $request->name;
            $country->iso3 = $request->iso3;
            $country->numcode = $request->numcode;
            $country->phonecode = $request->phonecode;
            $country->save();
            Alert::Html('Success', '<h2> Country Added Successfully </h2>','success');
            return redirect("country");
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $country = Country::find($id);
         return view('admin.country.show', compact('country'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $country = Country::find($id);
        $regionname = Region::find($country->region_id);
        $regions= Region::all();

        return view('admin.country.edit', compact('country','regions','regionname'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request)
    {   
            $country_id = $request->id;
            $country = Country::find($country_id);
            $country->region_id = $request->region_id;
            $country->name = $request->name;
            $country->iso3 = $request->iso3;
            $country->numcode = $request->numcode;
            $country->phonecode = $request->phonecode;
            $country->save();
            Alert::Html('Success', '<h2> Country Updated Successfully </h2>','success');
            return redirect("country");     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
         $country = Country::find($id);
        $status = $country->is_deleted;

        if ($status == 0) {
            $country->is_deleted = '1';
        } else {
            $country->is_deleted = '0';
        }
        $country->save();

        Alert::Html('Success', '<h2> Country Deleted Successfully </h2>','success');
        return redirect('country');
    }

 
        public function changeStatus($id) {

        $country = Country::find($id);
        $status = $country->is_active;

        if ($status == 1) {
            $country->is_active = '0';

        } else {
            $country->is_active = '1';
        }
        $country->save();

        Alert::Html('Success', '<h2> Country Status Changed </h2>','success');
        return redirect('country');
    }
   
}