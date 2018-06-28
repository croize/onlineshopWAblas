<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportmessage extends Model
{
    protected $table = 'reportmessage';
    public function user()
    {
      return $this->belongsTo('App\User','user_id','id');
    }
}
