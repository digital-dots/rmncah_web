<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::query()
            ->with(['permissions'])
            ->when($request->search, fn($query) => $query->where('name', 'like', "%{$request->search}%"))
            ->orderBy('id', 'desc')
            ->paginate($request->limit ?? 10)
            ->withQueryString();

        return Inertia::render('Role/Index', [
            'data' => $roles,
            'search' => $request->search
        ]);
    }

    public function create()
    {
        $permission_groups = PermissionGroup::with('permissions')->get();

        return Inertia::render('Role/Create', ['permission_groups' => $permission_groups]);
    }

    public function store(Request $request)
    {
        $role = Role::firstOrCreate(['name' => $request->name, 'guard_name' => 'web']);

        $role->syncPermissions($request->permissions);

        return to_route('roles.index')->with('success', 'Role is created successfully');
    }
}
