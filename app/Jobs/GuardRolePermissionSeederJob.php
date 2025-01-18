<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\PermissionGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GuardRolePermissionSeederJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Collection $chunk_data,
        protected string $guard_name,
        protected string $type
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle() : void
    {
        if ($this->type === 'permission' && in_array($this->guard_name, config('auth.guard_names.default'))) {
            foreach ($this->chunk_data as $permission_group) {
                $rank        = $permission_group['rank'] ?? null;
                $name        = $permission_group['name'];
                $permissions = $permission_group['permissions'];

                $permission_group = PermissionGroup::firstOrCreate(
                    ['name' => $name, 'guard_name' => $this->guard_name],
                    ['rank' => $rank]
                );

                foreach ($permissions as $permission) {
                    Permission::updateOrCreate(
                        [
                            'name'       => $permission,
                            'guard_name' => $this->guard_name,
                        ],
                        [
                            'permission_group_id' => $permission_group->id,
                        ]
                    );
                }
            }
        }

        if ($this->type == 'role' && in_array($this->guard_name, config('auth.guard_names.default'))) {
            foreach ($this->chunk_data as $role) {
                $role_created = Role::firstOrCreate(['guard_name' => $this->guard_name, 'name' => $role]);

                if (in_array($role_created->name, ['Super Admin', 'Admin'])) {
                    $role_created->syncPermissions(Permission::where('guard_name', $this->guard_name)->get());
                }

                if ($this->guard_name == 'web' && $role_created->name == 'Super Admin') {
                    $user = User::first();
                    if ($user) {
                        try {
                            $user->assignRole([$role_created->id]);
                        } catch (\Exception $e) {
                            Log::error('Failed to sync roles for user: ' . $e->getMessage());
                        }
                    } else {
                        Log::warning('No user found to sync roles.');
                    }
                }
            }
        }
    }
}
