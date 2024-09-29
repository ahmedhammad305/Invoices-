<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CreateAminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $user = User::create([
            'name' => 'ahmed hammad',
            'email' => 'admin@gamil.com',
            'password' => bcrypt('123456'),
            'roles_name' =>['owner'],
            'Status' =>'مفعل'
            ]);
            $role = Role::create(['name' => 'owner']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
    }
}
