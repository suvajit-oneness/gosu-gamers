<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission:: where('is_deleted',0)->get();
        return view('admin.permissions.index',compact('permissions'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles
        return view('admin.permissions.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        if ($request->roles <> '') { 
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value); 
                $role->permissions()->attach($permission);
            }
        }
        Alert::Html('Success', '<h2> Permission Created Successfully </h2>','success');
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
        $permission->name=$request->name;
        $permission->save();
 Alert::Html('Success', '<h2> Permission '. $permission->name.' Updated Successfully </h2>','success');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {   
        $status = $permission->is_deleted;
        if ($status == 0)
        {
            $permission->is_deleted = '1';
        }
        $permission->save();
         Alert::Html('Success', '<h2> Permission Removed </h2>','success');
         return redirect()->route('permissions.index');
    }
}
