<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Databooking;
use App\Activity;
use Auth;
use DB;

class BookingController extends Controller
{
    public function create(Request $request)
    {
      $as = Activity::all();
      return view('booking.create',compact('as'));
    }
}
