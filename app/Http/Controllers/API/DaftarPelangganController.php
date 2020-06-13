<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DaftarPelanggan;

class DaftarPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DaftarPelanggan::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'golongan' => 'required'
        ]);

        return DaftarPelanggan::create([
            'nama' => $request['nama'],
            'alamat' => $request['alamat'],
            'golongan' => $request['golongan'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = DaftarPelanggan::findOrFail($id);

        // Menghapus data pelanggan
        $pelanggan->delete();

        //Mengalihkan halaman setelah hapus
        return['message', 'Pelanggan Telah terhapus bosku!'];
    }
}
