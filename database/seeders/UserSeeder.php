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
        User::create([
            'role_id' => -1,
            'name' => 'Super Admin',
            'email' => 'super@super.com',
            'password' => 'supersuper',
        ]);
    }
}
