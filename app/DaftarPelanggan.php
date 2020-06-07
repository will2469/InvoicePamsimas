<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarPelanggan extends Model
{

    protected $table = 'daftarPelanggan' ;  

    protected $fillable = [
       'nama', 'alamat', 'golongan'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
