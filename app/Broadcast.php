<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
  protected $table = 'databroadcast';
  public $timestamps = false;
  // protected $guarded = array();
  // protected $fillable = ['id','nama','tanggal','waktu','jumlah','target','operator','prefix','jenis_kartu','status'];
  public function content()
  {
    return $this->hasMany('App\Content');
  }
}
