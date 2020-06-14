<?php

use Illuminate\Database\Seeder;
use App\Golongan;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Golongan::truncate();

        Golongan::create(['golongan' => 'Rumah Tangga']);
        Golongan::create(['golongan' => 'Sosial']);
    }
}
