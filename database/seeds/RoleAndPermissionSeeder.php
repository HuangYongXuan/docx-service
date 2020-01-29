<?php

use App\Models\Users\Permission;
use App\Models\Users\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Founder', 'display_name' => '创始人', 'description' => '创始人', 'can_delete' => false, 'flag' => 100]);
        Role::create(['name' => 'Admin', 'display_name' => '管理员', 'description' => '管理员', 'is_default' => false, 'flag' => 99]);
        Role::create(['name' => 'User', 'display_name' => '用户', 'description' => '用户', 'is_default' => true, 'can_delete' => false]);

        $user = User::all()->first();
        $user->attachRole($admin);
        $user->save();

        $role = Role::whereName('Founder')->first();
        if (!empty($role)) {
            $role->attachPermissions([
                Permission::create(['name' => 'administrator', 'description' => '超级管理员', 'display_name' => '拥有超级管理权限']),
                Permission::create(['name' => 'admin-web', 'description' => '管理面板', 'display_name' => 'web 管理面板']),
                Permission::create(['name' => 'admin-role', 'description' => '管理角色', 'display_name' => '管理角色']),
                Permission::create(['name' => 'admin-permission', 'description' => '管理角色许可', 'display_name' => '管理角色许可']),
                Permission::create(['name' => 'admin-user', 'description' => '用户管理', 'display_name' => '用户管理']),
                Permission::create(['name' => 'admin-menu', 'description' => '网站菜单设置', 'display_name' => '网站菜单设置']),
                Permission::create(['name' => 'admin-setting', 'description' => '网站设置', 'display_name' => '网站设置']),
                Permission::create(['name' => 'file-manager', 'description' => '文件管理', 'display_name' => '文件管理']),
                Permission::create(['name' => 'can-login', 'description' => '可以登录', 'display_name' => '可以登录'])
            ]);
        }

        factory(User::class, 50)->create();
    }
}
