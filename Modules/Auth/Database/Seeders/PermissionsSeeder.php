<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Model::unguard();
        $role = Role::firstOrCreate(['name' => 'Administrator']);
        foreach ($this->getAllPermissions() as $permission) {
            foreach ($this->getAllPermissionTypes() as $type) {
                $a = Permission::firstOrCreate(
                    [
                        'name' => $permission . '-' . $type
                    ]);
                $role->givePermissionTo($a);
            }

        }


    }

    public function getAllPermissions()
    {
        return [
            'news',
            'news-category',
            'gallery',
            'advertisement',
            'setting',
            'role',
            'user',
            'contact',
            'team'
        ];
    }

    public function getAllPermissionTypes()
    {
        return [
            'view',
            'edit',
            'create',
            'delete',
        ];
    }
}
