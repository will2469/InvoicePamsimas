<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name'=> 'admin',
            'email' => 'admin@me.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
