<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();

        Status::create(['status' => 'Aktif']);
        Status::create(['status' => 'Non Aktif']);
    }
}
