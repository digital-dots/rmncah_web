<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use Illuminate\Http\Request;
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
}
