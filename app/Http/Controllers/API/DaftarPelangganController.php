<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DaftarPelanggan;
use App\Golongan;
use App\Status;

class DaftarPelangganController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = DaftarPelanggan::orderBy('created_at', 'desc')->with(['golongan','status'])->paginate(5);
        return $pelanggan;
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
            //'id_pel' => 'required|string|size:12|unique:daftarPelanggan',
            'alamat' => 'required|string|max:255',
            'golonganId' => 'required',
            'statusId' => 'required'
        ]);

        $golongan = Golongan::where('id', $request['golonganId'])->first();
        $status = Status::where('id', $request['statusId'])->first();
        
        $pelanggan = DaftarPelanggan::create([
            'nama' => $request['nama'],
            //'id_pel' => $id_pel,
            'alamat' => $request['alamat'],
        ]);

        $pelanggan->golongan()->attach($golongan);
        $pelanggan->status()->attach($status);

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
        $pelanggan = DaftarPelanggan::findOrFail($id);
        $pelanggan->golongan()->sync($request->golonganId);
        $pelanggan->status()->sync($request->statusId);

        $this->validate($request,[
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'golonganId' => 'sometimes',
            'statusId' => 'sometimes'
        ]);

        // update pelanggan
        $pelanggan->nama = $request->nama;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save($request->all());

        return ['message', "User Updated"];
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
        $pelanggan->golongan()->sync([]);
        $pelanggan->status()->sync([]);

        // Menghapus data pelanggan
        $pelanggan->delete();

        //Mengalihkan halaman setelah hapus
        return['message', 'Pelanggan Telah terhapus bosku!'];
    }
}
