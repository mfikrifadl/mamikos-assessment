<?php

namespace Database\Seeders;

use App\Models\RoleUser\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::create([
            'id' => -1,
            'name' => 'superadmin',
            'type' => 'admin',
        ]);

        RoleUser::create([
            'name' => 'owner',
            'type' => 'owner',
        ]);

        RoleUser::create([
            'name' => 'premium',
            'type' => 'user',
        ]);

        RoleUser::create([
            'name' => 'regular',
            'type' => 'user',
        ]);
    }
}
