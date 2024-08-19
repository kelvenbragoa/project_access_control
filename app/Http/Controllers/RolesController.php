<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::paginate();

        // return view('roles.index', compact('roles'));
        return view('configuracoes.previlegios.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //
        // return view('roles.create');
        return view('configuracoes.previlegios.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'name' => ['required','string','max:255','unique:roles,name'],
        ]);
        $data = $request->all();
        Role::create($data);

        // return to_route('roles.index')->with('messagesuccess','Registro criado com sucesso');
        return to_route('roles.index')->with('messagesuccess','Registro criado com sucesso');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : View
    {
        //
        $role = Role::findOrFail($id);
        $rolepermissions = $role->permissions()->get();
        $userroles = DB::table('model_has_roles')->where('role_id',$role->id)->get();
        
        // return view('roles.show', compact('role','rolepermissions','userroles'));
        return view('configuracoes.previlegios.show', compact('role','rolepermissions','userroles'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //
        $role = Role::findOrFail($id);
        // return view('roles.edit', compact('role'));
        return view('configuracoes.previlegios.edit', compact('role'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        //
        $data = $request->all();
        $role = Role::findOrFail($id);
        $role->update($data);

        // return to_route('roles.index')->with('messagesuccess','Registro criado com sucesso');
        return to_route('roles.index')->with('messagesuccess','Registro criado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $role = Role::findOrFail($id);
        $role->delete();
        // return to_route('roles.index')->with('messagesuccess','Registro apagado com sucesso');
        return to_route('configuracoes.previlegios.index')->with('messagesuccess','Registro apagado com sucesso');;

    }

    public function addRolePermission(string $id) : View
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $rolepermissions = DB::table('role_has_permissions')->where('role_id',$role->id)->pluck('permission_id')->all();        
        // return view('roles.addpermission', compact('role','permissions','rolepermissions'));
        return view('configuracoes.previlegios.addpermission', compact('role','permissions','rolepermissions'));

    }

    public function storeRolePermission(string $id , Request $request) : RedirectResponse
    {
        $request->validate([
            'permission' =>'required',
        ]);

        $data = $request->all();
        $role = Role::findOrFail($id);

        $role->syncPermissions($data['permission']);

        // return to_route('roles.index')->with('messagesuccess','Registro criado com sucesso');
        return to_route('roles.index')->with('messagesuccess','Registro criado com sucesso');

    }

    public function addRoleToUser(string $id) : View
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        $rolesuser = DB::table('model_has_roles')->where('model_id', $user->id)->pluck('role_id')->all();
        // return view('users.roles.edit', compact('roles','user','rolesuser'));
        return view('configuracoes.utilizadores.previlegios.edit', compact('roles','user','rolesuser'));

    }

    public function storeRoleToUser(string $id , Request $request) : RedirectResponse
    {
        $request->validate([
            'role' =>'required',
        ]);

        $data = $request->all();
        $user = User::findOrFail($id);

        $user->syncRoles($data['role']);

        // return redirect()->back();
        return redirect()->back();

    }






}
