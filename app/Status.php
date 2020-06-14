<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status' ;

    protected $fillable = [
        'id', 'status',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function status(){
        return $this->belongsToMany('App\DaftarPelanggan');
    }
}
