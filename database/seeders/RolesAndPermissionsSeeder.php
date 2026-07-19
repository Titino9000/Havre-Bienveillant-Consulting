<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'manage_users',
            'manage_roles',
            'manage_services',
            'manage_team',
            'manage_achievements',
            'manage_sliders',
            'manage_faqs',
            'manage_knowledge_hub',
            'manage_inquiries',
            'manage_settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // create roles and assign created permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $contentEditorRole = Role::firstOrCreate(['name' => 'Content Editor']);
        $contentEditorRole->givePermissionTo([
            'manage_services',
            'manage_team',
            'manage_achievements',
            'manage_sliders',
            'manage_faqs',
            'manage_knowledge_hub',
        ]);
        
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
