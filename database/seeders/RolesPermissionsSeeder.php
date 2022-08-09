<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::create(['name' => 'super_admin','description'=>'Can manage full Application']);
        $admin = Role::create(['name' => 'admin','description'=>'Can manage full/partial Application']);
        $post = Role::create(['name' => 'post_section','description'=>'Can manage full post section']);
        $digilearn = Role::create(['name' => 'digilearn','description'=>'Can manage DigiLearn module']);
    }
}
