<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
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
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);

        // create roles and assign existing permissions

//        $role2 = Role::create(['name' => 'DEI']);
//        $role3 = Role::create(['name' => 'AEI']);
//        $role4 = Role::create(['name' => 'SDO']);
//        $role5 = Role::create(['name' => 'X-En']);
//        $role6 = Role::create(['name' => 'Electric Inspector']);
//        $role7 = Role::create(['name' => 'Super-Admin']);

        $role1 = Role::create(['name' => 'Wiring Contractor']);
        $role1->givePermissionTo('create');
        $role1->givePermissionTo('edit');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('delete');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
            'password' => \Hash::make('123456'),
            'status' => 1,
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
            'password' => \Hash::make('123456'),
            'status' => 1,
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Ali Raza Marchal',
            'email' => 'kh.marchal@gmail.com',
            'password' => \Hash::make('123456'),
            'status' => 1,
        ]);
        $user->assignRole($role3);
    }
}
