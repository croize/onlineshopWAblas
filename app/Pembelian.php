<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
  protected $table = 'pembelian';
  public $timestamps = false;
  protected $primaryKey = 'invoice_code';
  public $incrementing = false;
  public function barang()
  {
    return $this->belongsTo('App\Barang','barang_id','id');
  }
}
