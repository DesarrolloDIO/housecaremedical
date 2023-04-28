<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class BasicAdminPermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [

            'ips.index',
            'ips.show',
            'ips.create',
            'ips.edit',
            'ips.delete',

            'result.index',
            'result.show',
            'result.create',
            'result.edit',
            'result.delete',

            'result-details.index',
            'result-details.show',
            'result-details.create',
            'result-details.edit',
            'result-details.delete',

            'roles.index',
            'roles.show',
            'roles.create',
            'roles.edit',
            'roles.delete',

            'users.index',
            'users.show',
            'users.create',
            'users.edit',
            'users.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Rosa Martinez Castro',
            'email' => 'cardio1@housecaremedical.com',
        ]);
        $user->assignRole($role3);

        // create roles and assign existing permissions
        
        $role2 = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $role2->givePermissionTo($permission);
        }

        $role1 = Role::create(['name' => 'writer']);
        // $role1->givePermissionTo('category.index');
        // $role1->givePermissionTo('proyect.index');
        // $role1->givePermissionTo('group.index');


        

        $user = \App\Models\User::factory()->create([
            'name' => 'Madeleine Terraza Jiménez', // 'Admin User' 
            'email' => 'admisiones1@housecaremedical.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);
    }
}
