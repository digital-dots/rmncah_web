<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('roles')
            ->when($request->search, fn($query) => $query->where('name', 'like', "%{$request->search}%"))
            ->orderBy("id", "desc")
            ->paginate($request->limit ?? 10)
            ->withQueryString();

        return Inertia::render('User/Index', [
            'data'   => $users,
            'search' => $request->search,
        ]);
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'web')->cursor();
        return Inertia::render("User/Create", [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'roles'    => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->roles['name']);

            DB::commit();
            return to_route('users.index')->with('success', 'User is successfully created');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($id)
    {
        $user  = User::with('roles')->findOrFail($id);
        $roles = Role::where('guard_name', 'web')->cursor();
        return Inertia::render('User/Edit', [
            'user'  => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'roles'    => 'required|array',
        ]);

        $user = User::with('roles')->findOrFail($id);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles($request->roles['name']);

        return to_route('users.index')->with('success', 'User is successfully updated');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User is successfully deleted');
    }
}
