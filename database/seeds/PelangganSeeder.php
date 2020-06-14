<?php

use Illuminate\Database\Seeder;
use App\DaftarPelanggan;
use App\Golongan;
use App\Status;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DaftarPelanggan::truncate();

        DB::table('daftar_pelanggan_golongan')->truncate();
        DB::table('daftar_pelanggan_status')->truncate();

        $rutaGolongan = Golongan::where('golongan', 'Rumah Tangga')->first();
        $sosialGolongan = Golongan::where('golongan', 'Sosial')->first();

        $aktifStatus = Status::where('status', 'Aktif')->first();
        $nonAktifStatus = Status::where('status', 'Non Aktif')->first();

        $contoh = DaftarPelanggan::create([
            'nama'=> 'contoh',
            'id_pel' => mt_rand(11111111111111,99999999999999),
            'alamat' => 'alamat',
        ]);

        $contoh2 = DaftarPelanggan::create([
            'nama'=> 'contoh 2',
            'id_pel' => mt_rand(11111111111111,99999999999999),
            'alamat' => 'alamat',
        ]);

        $contoh->golongan()->attach($rutaGolongan);
        $contoh2->golongan()->attach($sosialGolongan);

        
        $contoh->status()->attach($aktifStatus);
        $contoh2->status()->attach($nonAktifStatus);
    }
}
