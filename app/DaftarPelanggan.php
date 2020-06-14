<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarPelanggan extends Model
{

    protected $table = 'daftarPelanggan' ;  

    protected $fillable = [
        'nama', 'alamat',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function golongan(){
        return $this->belongsToMany('App\Golongan');
    }

    public function status(){
        return $this->belongsToMany('App\Status');
    }
}
