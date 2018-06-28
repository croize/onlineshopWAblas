<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Databooking extends Model
{
    protected $table = 'data_booking';
    public $timestamps = false;
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function activity()
    {
      return $this->belongsTo('App\Activity');
    }
}
