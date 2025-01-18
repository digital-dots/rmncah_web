<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Jobs\GuardRolePermissionSeederJob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuardRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        // User Permissions
        foreach (collect(config('user_permissions.default'))->chunk(100) as $user_permission_group) {
            GuardRolePermissionSeederJob::dispatch($user_permission_group, config('auth.guard_names.default.user'), 'permission');
        }

        // Admin Roles
        foreach (collect(config('custom_roles.user'))->chunk(100) as $user_roles) {
            GuardRolePermissionSeederJob::dispatch($user_roles, config('auth.guard_names.default.user'), 'role');
        }
    }
}
