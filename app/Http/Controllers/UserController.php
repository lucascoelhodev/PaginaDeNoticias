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
        // if ($request->has('role_id')) {
        //     $item->roles()->sync($request->input('role_id'));
        // } else {
        //     $item->roles()->detach(); // Remove todos os papéis se nenhum papel for selecionado
        // }
        if ($request->has('role_id')) {
            $requestedRoles = array($request->input('role_id'));
        
            // Obtenha a lista de papéis que o usuário já possui
            $userRoles = $item->roles->pluck('id')->toArray();
        
            // Verifique se os papéis solicitados não estão na lista de papéis do usuário
            $rolesToAdd = array_diff($requestedRoles, $userRoles);
        
            // Verifique se o usuário já possui pelo menos um dos papéis solicitados
            if (count($rolesToAdd) > 0) {
                $item->roles()->syncWithoutDetaching($rolesToAdd);
            }
        } else {
            $item->roles()->detach(); // Remove todos os papéis se nenhum papel for selecionado
        }
        return redirect()->route('user.index');
    }
    public function removeRole(Request $request,$id){
        $user = User::find($id); // Substitua $userId pelo ID do usuário
        $roleIdToRemove = $request->input('role_id'); // Substitua 2 pelo ID do papel que deseja remover
        $user->roles()->detach($roleIdToRemove);

        return redirect()->route('user.index');
    }
    public function destroy(string $id){
        $item = User::with('roles')->findOrfail($id);
        $isAdmin = $item->roles->contains('slug','administrador');
        if($isAdmin){
            return redirect()->route('users.index')->with('error','Não é permitido excluir um administrador');
        }
        
        $item->delete();
        return redirect()->route('users.index');
    }
    public function edit(string $id){
        $item = User::findOrfail($id);
        $roles = Role::all();
        $userRoles = $item->roles;
        return view('users.edit',compact('roles','item','userRoles'));
    }
    public function isAdmin() {
        $data = User::with('roles')->get();
        return $this->roles()->slug === 'administrador'; // Suponha que 'role' seja o atributo que define o papel do usuário.
    }
}