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
        $pelanggan = DaftarPelanggan::orderBy('created_at', 'asc')->with(['golongan','status'])->paginate(5);
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
            'alamat' => 'required|string|max:255',
            'golonganId' => 'required',
            'statusId' => 'required'
        ]);

        $golongan = Golongan::where('id', $request['golonganId'])->first();
        $status = Status::where('id', $request['statusId'])->first();

        $n_pelanggan = DaftarPelanggan::max('id');
        $id_pel_ = $n_pelanggan+1;

        if ($id_pel_ < 10){
            $id_pel ="3310192010".''. "0".''.$request['golonganId'].''.date('Y').'' ."000". $id_pel_; 
        }
        elseif ($id_pel_ >= 10 && $id_pel_ <= 99){
            $id_pel = "3310192010".''. "0".''.$request['golonganId'].''.date('Y').'' ."00". $id_pel_; 
        }
        elseif ($id_pel_ >= 100 && $id_pel_ <= 999){
            $id_pel = "3310192010".''. "0".''.$request['golonganId'].''.date('Y').'' ."0". $id_pel_; 
        }
        elseif ($id_pel_ > 999){
            $id_pel = "3310192010".''. "0".''.$request['golonganId'].''.date('Y').''. $id_pel_; 
        }
        
        $pelanggan = new DaftarPelanggan;
        $pelanggan->nama = $request->nama;
        $pelanggan->id_pel = $id_pel;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save() ;
        
        $pelanggan->golongan()->attach($golongan);
        $pelanggan->status()->attach($status);

        return ['message', $id_pel];

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

        $id_pel_ = $pelanggan->id_pel;
        $num_pel = substr($id_pel_,-4);
        $id_pel_new ="3310192010".''. "0".''.$request['golonganId'].''.date('Y').''.$num_pel;


        // update pelanggan
        $pelanggan->nama = $request->nama;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->id_pel = $id_pel_new;
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
