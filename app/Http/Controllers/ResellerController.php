<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Broadcast;
use App\Pembelian;
use App\Keuangan;
use App\Barang;
use App\User;
use DB;
use Auth;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('level:3');
     }

    public function index()
    {
      $listlink = User::where('level','=',3)->get();
      $data = Broadcast::where('status',1)->get();
      $deposit = Keuangan::where('user_id',Auth::user()->id)->value('deposit');
      $order = Pembelian::where('mobsterid',Auth::user()->mobsterid)->count();
      $transaksi = DB::table('pembelian')
                ->where('mobsterid','=',Auth::user()->mobsterid)->where('status','=','1')->count();
      $barang = Barang::all()->count();
      return view('reseller.index',compact('data','deposit','order','transaksi','barang','listlink'));
    }

    public function active($id)
    {
      $as = User::find($id);
      $as->status_reseller = 2; //Pengajuan ke admin;
      $as->save();

      return redirect('reseller')->with('message','Proses Pembayaran Anda akan dicek oleh Admin kami.');
    }

    public function accountprofile($id)
    {
      $acc = User::find($id);
      $acc->name = $request->name;
      $acc->email = $request->email;
      $acc->no_rekening = $request->no_rekening;
      $acc->bank = $request->bank;
      $acc->save();
      return redirect('reseller')->with('message','Profile Berhasil diedit');
    }

    public function salary($id)
    {
      $cek = Keuangan::where('user_id',$id)->value('id');
      $edit = Keuangan::find($cek);
      $edit->status_pengajuan = 2;
      $edit->save();
      return redirect('reseller')->with('message','Pengambilan penghasilan Anda sedang diproses, total penghasilan Anda akan menjadi Rp. 0 ,- jika penghasilan Anda sudah ditransfer oleh pihak kami.');
    }

    public function order()
    {
      $order = Pembelian::where('mobsterid',Auth::user()->mobsterid)->get();
      return view('reseller.dataorder',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
