<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RolesController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'role_or_permission: Super Admin|roles',
        ];
    }
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
        try {
            $request->validate([
                'name' => ['required','string','max:255','unique:roles,name'],
            ]);
            $data = $request->all();
            Role::create($data);
            Alert::success('Success', __('text.success_save'));
            return to_route('roles.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_save').'. '.$th->getMessage());
            return to_route('roles.index');  
        }
        

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
        try {
            $data = $request->all();
            $role = Role::findOrFail($id);
            $role->update($data);
            Alert::success('Success', __('text.success_update'));
            return to_route('roles.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_update').'. '.$th->getMessage());
            return to_route('roles.index');  
        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            Alert::success('Success', __('text.success_delete'));
            return to_route('roles.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_delete').'. '.$th->getMessage());
            return to_route('roles.index');
        }
        

    }

    public function addRolePermission(string $id) : View
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $rolepermissions = DB::table('role_has_permissions')->where('role_id',$role->id)->pluck('permission_id')->all();        
        return view('configuracoes.previlegios.addpermission', compact('role','permissions','rolepermissions'));

    }

    public function storeRolePermission(string $id , Request $request) : RedirectResponse
    {

        try {
            $request->validate([
                'permission' =>'required',
            ]);
    
            $data = $request->all();
            $role = Role::findOrFail($id);
    
            $role->syncPermissions($data['permission']);
            Alert::success('Success', __('text.success_save'));
            return to_route('roles.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_delete').'. '.$th->getMessage());
            return to_route('roles.index');
        }
        

    }

    public function addRoleToUser(string $id) : View
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        $rolesuser = DB::table('model_has_roles')->where('model_id', $user->id)->pluck('role_id')->all();
        return view('configuracoes.utilizadores.previlegios.edit', compact('roles','user','rolesuser'));

    }

    public function storeRoleToUser(string $id , Request $request) : RedirectResponse
    {
        try {
            $request->validate([
                'role' =>'required',
            ]);
    
            $data = $request->all();
            $user = User::findOrFail($id);
    
            $user->syncRoles($data['role']);
    
            Alert::success('Success', __('text.success_save'));
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_save').'. '.$th->getMessage());
            return to_route('roles.index');
        }
        

    }






}
