<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  protected $table = 'activities';
  public $tiemstamps = false;
  public function booking()
  {
    return $this->hasMany('App\Databooking');
  }
}
