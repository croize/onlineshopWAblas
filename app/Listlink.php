<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listlink extends Model
{
    protected $table = 'listlink';
    public $timestamps = false;
    public function mitra()
    {
      return $this->belongsTo('App\User','user_id','id');
    }
}
