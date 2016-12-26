<?php

use Illuminate\Database\Seeder;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;
use App\Models\User;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('permissions')->delete();

        // Create Default Roles
        $roleSuperAdmin = new Role();
        $roleSuperAdmin->id = -1;
        $roleSuperAdmin->name = 'Super Administrator';
        $roleSuperAdmin->slug = 'super-administrator';
        $roleSuperAdmin->description = 'Manage super administration privileges';
        $roleSuperAdmin->save();

        // Assign to default Super Administrator
        $superAdmin = User::find(-1);
        $superAdmin->assignRole($roleSuperAdmin);

        // Define Default Permission
        $permission = new Permission();
        $permission->create([
            'name'        => 'user',
            'slug'        => [
                'create'     => true,
                'view'       => true,
                'update'     => true,
                'delete'     => true,
            ],
            'description' => 'manage user permissions'
        ]);

        $permission = new Permission();
        $permission->create([
            'name'        => 'setting',
            'slug'        => [
                'create'     => true,
                'view'       => true,
                'update'     => true,
                'delete'     => true,
            ],
            'description' => 'manage setting permissions'
        ]);

        // Assign All Permission To Super Admin
        $roleSuperAdmin->assignPermission(Permission::all());
    }
}
