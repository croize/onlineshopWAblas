<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'keuangan';
    public $timestamps = false;
    public function user()
    {
      return $this->belongsTo('App\User','userid','id');
    }
}
