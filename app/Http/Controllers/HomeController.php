<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Keuangan;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->level == 1) {
          return redirect('admin/broadcast');
        }elseif (Auth::user()->level == 0) {
          return redirect('headadmin/broadcast');
        }elseif (Auth::user()->level == 2) {
          return redirect('mitra/datapembelian');
        }elseif (Auth::user()->level == 3) {
          $as = DB::table('keuangan')->where('user_id','=',Auth::user()->id)->value('id');
          if ($as == NULL) {
            $dt = new Keuangan();
            $dt->user_id = Auth::user()->id;
            $dt->save();
            return redirect('reseller');
          }elseif($as != NULL) {
            return redirect('reseller');
          }
        }
    }

    public function mail()
    {
       $name = 'rifqi';
       Mail::to('rifqisubagjaa@gmail.com')->send(new SendMailable($name));

       return 'Email was sent';
    }

}
