<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class DaftarPembacaan extends Model
{
    protected $table = 'data_pembacaan' ;

    protected $fillable = [
        'nama', 'alamat',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function pelanggan(){
        return $this->belongsToMany('App\DaftarPelanggan');
    }

    public function getCreatedAtAttribute($date)
{
    return Carbon::parse($date)->format('d-M-Y H:i:s');
}
}
