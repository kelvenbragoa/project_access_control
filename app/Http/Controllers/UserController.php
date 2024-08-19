<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        // $user->syncRoles($request->role);


        return to_route('users.index')->with('messagesuccess','Registro criado com sucesso');;
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

        // $user->syncRoles($request->role);

        return to_route('users.index')->with('messagesuccess','Registro criado com sucesso');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $users = User::findOrFail($id);
        $users->delete();
        return to_route('users.index');
    }
}
