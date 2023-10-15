<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Kodeine\Acl\Models\Eloquent\Permission;
use Kodeine\Acl\Models\Eloquent\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
//         $permission = new Permission();
//         $permUser = $permission->create([ 
//     'name'        => 'user',
//     'slug'        => [          // pass an array of permissions.
//         'create'     => true,
//         'view'       => true,
//         'update'     => true,
//         'delete'     => true,
//         'view.phone' => true
//     ],
//     'description' => 'manage user permissions'
// ]);
// $roleAdmin = Role::first(); 
// $roleAdmin->assignPermission('user');

        $data = User::with('roles')->orderBy('created_at')->get();
        // $data = User::select('users.*')
        // ->join('role_user', 'users.id', '=', 'role_user.user_id')
        // ->join('roles', 'role_user.role_id', '=', 'roles.id')
        // ->orderBy('roles.name')
        // ->get();
        return view('users.index', compact('data'));
    }
    public function show(string $id)
    {
        $item = User::findOrfail($id);
        // return view('users.show',compact('item'));
    }
    public function update(Request $request, string $id)
    {
        // dd($request);
        $item = User::findOrfail($id);
        $item->fill($request->all())->save();
        if ($request->has('role_id')) {
            $item->roles()->sync($request->input('role_id'));
        } else {
            $item->roles()->detach(); // Remove todos os papéis se nenhum papel for selecionado
        }
        return redirect()->route('user.index');
    }
    public function destroy(string $id){
        $item = User::findOrfail($id);
        $item->delete();
        return redirect()->route('users.index');
    }
    public function edit(string $id){
        $item = User::findOrfail($id);
        $roles = Role::all();
        return view('users.edit',compact('roles','item'));
    }
}