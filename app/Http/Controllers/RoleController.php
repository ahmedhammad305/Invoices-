<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
//////////////////////////
function __construct()
{

$this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
$this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
$this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
$this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

}

/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
$roles = Role::orderBy('id','DESC')->paginate(5);
return view('role.index',['roles' => $roles])
->with('i', ($request->input('page', 1) - 1) * 5);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
$permission = Permission::get();
return view('role.CreateRole',['permission' => $permission]);
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
'name' => 'required|unique:roles,name',
'permission' => 'required',
]);
$role = Role::create(['name' => $request->input('name')]);
$role->permissions()->sync($request->input('permission'));
return to_route('role')
->with('success','Role created successfully');
}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$role = Role::findorFail($id);
$rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
->where("role_has_permissions.role_id",$id)
->get();
return view('role.ShowRole',['role' => $role,'rolePermissions'=>$rolePermissions]);
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$role = Role::find($id);
$permission = Permission::get();
$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
->all();
return view('role.EditeRole',['role' => $role,'permission' => $permission,'rolePermissions' => $rolePermissions]);
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$this->validate($request, [
'name' => 'required',
'permission' => 'required',
]);
$role = Role::findorFail($id);
$role->name = $request->input('name');
$role->save();
$role->permissions()->sync($request->input('permission'));
return to_route('role')
->with('edit','Role updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
DB::table("roles")->where('id',$id)->delete();
return to_route('role')
->with('success','Role deleted successfully');
}
}
