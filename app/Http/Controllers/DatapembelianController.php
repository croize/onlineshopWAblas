<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pembelian;
use App\Barang;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Auth;
use Excel;

class DatapembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('level:2');
     }

    public function index()
    {
        $data = Barang::where('user_id',Auth::user()->id)->get();
        return view('mitra.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('mitra/datapembelian');
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
        $data = Pembelian::find($id);
        return view('mitra.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return redirect('mitra/datapembelian');
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
        $as = Pembelian::find($request->invoice_code);
        $as->status_pengiriman = $request->status_pengiriman;
        $as->save();
          $invoice_code = $request->invoice_code;
          $name = $request->nama;
          $nama_barang = $request->nama_barang;
          $resi = $request->resipengiriman;
          $kecamatan = $request->kecamatan;
          $kabupaten = $request->kabupaten;
          $hargatotal = $request->hargatotal;
          $jumlah = $request->jumlah;
          $kode_pos = $request->kode_pos;
          $alamat = $request->alamat;
          $no_hp = $request->no_hp;
          $harga = $request->harga;
          $provinsi = $request->provinsi;
          Mail::to('mobster@smsinstan.net')->send(new SendMailable($provinsi,$harga,$invoice_code,$name,$nama_barang,$resi,$kecamatan,$kabupaten,$hargatotal,$jumlah,$kode_pos,$alamat,$no_hp));

          return redirect('mitra/datapembelian')->with('message','Data pengiriman berhasil dikirim');

    }

    public function updateresi(Request $request,$id)
    {
      $as = Pembelian::find($id);
      $as->resi = $request->resi;
      $as->save();
      return redirect('mitra/datapembelian');
    }

    public function print(Request $request,$id)
    {
      $data = Pembelian::find($id);
      return view('mitra.print',compact('data'));
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
