<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            'role_or_permission: Super Admin|users',
        ];
    }
    public function index()
    {
        //
        $users = User::paginate();


        return view('configuracoes.utilizadores.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //
        $roles = Role::all();
        return view('configuracoes.utilizadores.create',compact('roles'));

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
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Alert::success('Success', __('text.success_save'));
            return to_route('users.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_save').'. '.$th->getMessage());
            return to_route('users.index'); 
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        //
        $user = User::findOrFail($id);
        return view('configuracoes.utilizadores.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::all();
        $rolesuser = DB::table('model_has_roles')->where('model_id', $user->id)->pluck('role_id')->all();
        return view('configuracoes.utilizadores.edit', compact('user','roles','rolesuser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        //
        try {
            $data = $request->all();

        $user = User::findOrFail($id);
        if(isset($data['password']) ){
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $data['password'] ? $data['password'] : Hash::make($request->password),
        ]);

        Alert::success('Success', __('text.success_update'));
        return to_route('users.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_update').'. '.$th->getMessage());
            return to_route('users.index'); 
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $users = User::findOrFail($id);
            $users->delete();
            Alert::success('Success', __('text.success_delete'));
            return to_route('users.index');
        } catch (\Throwable $th) {
            Alert::error('Error', __('text.error_delete').'. '.$th->getMessage());
            return to_route('users.index'); 
        }
        
    }
}
