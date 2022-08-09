<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{



    public function index(Request $request)
    {


        if ($request->ajax()) {
            $roles = Role::orderby('created_at','desc')->latest('id');

            return Datatables::of($roles)
            ->editColumn('created_at',function(Role $role){
                return $role->created_at->diffForHumans();
            })
            ->addColumn('permission',function($role){
                $permissions = $role->permissions;
                $perm = '';
                if($permissions){
                    foreach($permissions as $permission){
                        $perm = $perm. '<div class="badge badge-soft-info mr-1" >'. $permission->name .'</div>';
                    };
                }

                return $perm;//$permission;
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('role.edit',$data->id).'" class="badge badge-soft-primary mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-soft-danger delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','permission'])
            ->make(true);


        }
        $permissions = Permission::get();

        return view('admin.pages.role.role')->with('permissions',$permissions);

    }

    public function create()
    {
        $permissions = Permission::get();
        return view('admin.pages.role.role_add')->with('permissions',$permissions);
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $role = New Role;
        $role->name = $request->name;
        $role->description = $request->description;
        //$role->guard_name = 'web';
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index')
        ->with([
            'message'    =>'Role Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $role = Role::findOrFail($id);

        return response()->json($role);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        //return response()->json($role);

        return view('admin.pages.role.role_edit')->with('role',$role)->with('permissions',$permissions);
    }

    public function update(Request $request, Role $role)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);


        $role->name = $request->name;
        $role->description = $request->description;
        $role->update();

        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index')
        ->with([
            'message'    =>'Role Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $role = Role::destroy($id);

        if($role){
            return redirect()->route('role.index')
            ->with([
                'message'    =>'Role Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
