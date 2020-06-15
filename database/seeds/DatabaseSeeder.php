<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        UserSeeder::class,
        GolonganSeeder::class,
        StatusSeeder::class,
        PelangganSeeder::class,
        PembacaanSeeder::class,
    ]);
    }
}
