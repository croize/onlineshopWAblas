<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class HeadadminController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('level:0');
  }

    public function index()
    {
      $reseller = DB::table('users')->where('level','=','3')->count();
      $mitra = DB::table('users')->where('level','=','2')->count();
      $operator = DB::table('users')->where('level','=','1')->count();
      return view('headadmin.index',compact('reseller','mitra','operator'));
    }
}
