<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'golongan' ;

    protected $fillable = [
        'id', 'golongan',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function golongan(){
        return $this->belongsToMany('App\DaftarPelanggan');
    }

}
