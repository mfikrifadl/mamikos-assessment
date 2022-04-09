<?php

namespace Database\Seeders;

use App\Models\RoleUser;
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
        ]);

        RoleUser::create([
            'name' => 'owner',
        ]);

        RoleUser::create([
            'name' => 'premium',
        ]);

        RoleUser::create([
            'name' => 'regular',
        ]);
    }
}
