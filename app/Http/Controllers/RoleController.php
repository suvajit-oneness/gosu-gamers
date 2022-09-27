<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function index()
    {
       $roles= Role::where('is_deleted',0)->get();
       $user=  User::all();
       return view('admin.roles.index', compact('roles','user'));
    }
    public function create()
    {
        $permissions = Permission::all();//Get all permissions

        return view('admin.roles.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
        'name'=>'required|unique:roles|max:10',
        'permissions' =>'required',
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        if($request->permissions <> ''){
        $role->permissions()->attach($request->permissions);
        }
        Alert::Html('Success', '<h2> Role Created Successfully </h2>','success');
        return redirect()->route('role.index');
    }
    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }
    public function update(Request $request,$id)
    {   
        $role = Role::findOrFail($id);//Get role with the given id
        //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);
        $input = $request->except(['permissions']);
        $role->fill($input)->save();
        if($request->permissions <> ''){
            $role->permissions()->sync($request->permissions);
            }
        Alert::Html('Success', '<h2> Role Update Successfully </h2>','success');
        return redirect()->route('role.index');
    }
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if (isset($role->id))
        {
            $status = $role->is_deleted;
            if ($status == 0)
            {
                $role->is_deleted = '1';
            }
            $role->save();
        }
        Alert::Html('Success', '<h2> Role Deleted </h2>','success');
        return redirect()->route('role.index');
    }
}
