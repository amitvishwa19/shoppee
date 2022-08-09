<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create(
            [
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'username' => 'superadmin',
                'email' => 'admin@admin.com',
                'type' => 'user',
                'password' => bcrypt('password'),
                'status' => true,
            ]
        );

        $superAdmin->assignRole('super_admin');
        $superAdmin->assignRole('post_section');
        $superAdmin->assignRole('digilearn');


        User::factory(7)->create();

    }
}
