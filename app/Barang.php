<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public $timestamps = false;
    public function pembelian()
    {
      return $this->hasMany('App\Pembelian');
    }

    public function user()
    {
      return $this->belongsTo('App\User','user_id','id');
    }

}
