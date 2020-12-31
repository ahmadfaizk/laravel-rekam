<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolePenjual = Role::create(['name' => 'penjual']);
        $rolePembeli = Role::create(['name' => 'pembeli']);

        $permissions = [
            'show makam',
            'create makam',
            'edit makam',
            'delete makam',
            'show marketplace',
            'create transaction',
            'show my transaction',
            'show transaction',
            'cancel transaction',
            'approve transaction',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $permissionPenjual = [
            'show makam',
            'create makam',
            'edit makam',
            'delete makam',
            'show transaction',
            'approve transaction'
        ];
        $permissionPembeli = [
            'show marketplace',
            'show makam',
            'create transaction',
            'show my transaction',
            'cancel transaction'
        ];
        $rolePenjual->givePermissionTo($permissionPenjual);
        $rolePembeli->givePermissionTo($permissionPembeli);

    }
}
