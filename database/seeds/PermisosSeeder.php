<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

       Permission::create(['name' => 'index_users']);
       // create roles and assign created permissions
       $role = Role::create(['name' => 'operador']);
       $role->givePermissionTo('edit articles');
       $role = Role::create(['name' => 'admin']);
       $role->givePermissionTo(Permission::all());
    }
}
