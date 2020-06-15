<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DaftarPembacaan;
use App\DaftarPelanggan;

class DaftarPembacaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $pembacaan = DaftarPelanggan::orderBy('created_at', 'asc')->with(['pelanggan'])->paginate(5);
        return $pembacaan;
    }
}
