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

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'role_or_permission: Super Admin|permissions',
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permissions = Permission::paginate();

        return view('configuracoes.permissoes.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //
        return view('configuracoes.permissoes.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
            $data = $request->all();
            Permission::create($data);
            Alert::success('Success', __('text.success_save'));
            return to_route('permissions.index');        
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_save').'. '.$th->getMessage());
            return to_route('permissions.index');      
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        //
        $permission = Permission::findOrFail($id);
        $roles = $permission->roles();
        $users = $permission->users();
        return view('configuracoes.permissoes.show', compact('permission','roles','users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //
        $permission = Permission::findOrFail($id);
        return view('configuracoes.permissoes.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        //
        try {
            $data = $request->all();
            $permission = Permission::findOrFail($id);
            $permission->update($data);
            Alert::success('Success', __('text.success_update'));
            return to_route('permissions.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_update').'. '.$th->getMessage());
            return to_route('permissions.index');   
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();
            Alert::success('Success', __('text.success_delete'));
            return to_route('permissions.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_delete').'. '.$th->getMessage());
            return to_route('permissions.index');
        }
        
    }


    public function addPermissionToUser(string $id) : View
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all();

        $permissionsuser = DB::table('model_has_permissions')->where('model_id', $user->id)->pluck('permission_id')->all();
        return view('configuracoes.utilizadores.permissoes.edit', compact('permissions','user','permissionsuser'));
    }

    public function storePermissionToUser(string $id , Request $request) : RedirectResponse
    {
        try {
            $request->validate([
                'permission' =>'required',
            ]);
    
            $data = $request->all();
            $user = User::findOrFail($id);
    
            $user->syncPermissions($data['permission']);
            Alert::success('Success', __('text.success_save'));
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_delete').'. '.$th->getMessage());
            return to_route('permissions.index');
        }
        
    }
}
