<?php

use Illuminate\Database\Seeder;
use App\DaftarPelanggan;
use App\DaftarPembacaan;
use \Carbon\Carbon;

class PembacaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DaftarPembacaan::truncate();

        DB::table('daftar_pelanggan_daftar_pembacaan')->truncate();

        $pelanggan1 = DaftarPelanggan::where('id', 1)->first();
        $pelanggan2 = DaftarPelanggan::where('id', 2)->first();

        $contoh = DaftarPembacaan::create([
            'pembacaan'=> '50',
            'created_at' => Carbon::now()->format('d M Y H:i'),
        ]);

        $contoh2 = DaftarPembacaan::create([
            'pembacaan'=> '65',
            'created_at' => Carbon::now()->format('d M Y H:i'),
        ]);

        $contoh->pelanggan()->attach($pelanggan1);
        $contoh2->pelanggan()->attach($pelanggan2);
    }
}
