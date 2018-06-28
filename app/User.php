<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','no_rekening','no_hp','alamat','mobsterid','bank','invoice_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level($level){
      if ($this->level == $level) {
        return true;
      }else{
        return false;
      }
    }

    public function barang()
    {
      return $this->hasMany('App\Barang');
    }
    public function booking()
    {
      return $this->hasMany('App\Databooking');
    }
    public function keuangan()
    {
      return $this->hasMany('App\Keuangan');
    }
    public function linkmitra()
    {
      return $this->hasMany('App\Listlink');
    }

}
