<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit assignments']);
        Permission::create(['name' => 'delete assignments']);
        Permission::create(['name' => 'publish assignments']);
        Permission::create(['name' => 'unpublish assignments']);
        Permission::create(['name' => 'submit assignments']);
        Permission::create(['name' => 'view assignments']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'teacher']);
        $role1->givePermissionTo('edit assignments');
        $role1->givePermissionTo('publish assignments');
        $role1->givePermissionTo('unpublish assignments');
        $role1->givePermissionTo('delete assignments');
        $role1->givePermissionTo('view assignments');

        $role2 = Role::create(['name' => 'student']);
        $role2->givePermissionTo('view assignments');
        $role2->givePermissionTo('submit assignments');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example Teacher',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Student',
            'email' => 'student@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Monarul Islam',
            'email' => 'monarul007@gmail.com',
        ]);
        $user->assignRole($role3);
    }
}
