<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    public function AllPermission(){

        $permissions = Permission::orderBy('id','desc')->get();
        return view('backend.pages.permission.all_permission', compact('permissions'));

    }//end method

    public function AddPermission(Request $request){


        return view('backend.pages.permission.add_permission');

    } //end method

    public function StorePermission(Request $request) {

        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Permission created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    } // end method

    public function  EditPermission($id) {

        $permission = Permission::findOrFail($id);

        return view('backend.pages.permission.edit_permission', compact('permission'));

    } //end method

    public function UpdatePermission(Request $request){

        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
                    'name' => $request->name,
                    'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Permission updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    } //end method

    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //end method


    //// roles ///


    public function AllRole(){

        $roles = Role::all();
        return view('backend.pages.role.all_role', compact('roles'));

    }//end method

    public function AddRole(Request $request){


        return view('backend.pages.role.add_role');

    } //end method

    public function StoreRole(Request $request) {

        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);

    } // end method

    public function  EditRole($id) {

        $role = Role::findOrFail($id);

        return view('backend.pages.role.edit_role', compact('role'));

    } //end method

    public function UpdateRole(Request $request){

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
                    'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    } //end method

    public function DeleteRole($id){

        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } //end method



    /// roles in permission methods

    public function AddRolesPermission(){

        $roles = Role::all();
        $permission = Permission::all();
        $permission_groups = User::GetPermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission',compact('roles','permission','permission_groups'));
    } // end method

    public function RolePermissionStore(Request $request){

        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item) {

            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);

    } // end method


    public function AllRolesPermission() {

        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission',compact('roles'));

    } // end method

    public function AdminEditRoles($id){

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::GetPermissionGroups();

        return view('backend.pages.rolesetup.edit_roles_permission',compact('role','permissions','permission_groups'));

    } // end method

    public function AdminRolesUpdate(Request $request, $id){

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);

    } // end method

    public function AdminDeleteRoles($id){

        $role = Role::findOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method





}
