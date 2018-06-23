<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Barang;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMailable;
use Illuminate\Support\Str;

class KonsumenbeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexreseller($mobsterid)
    {
        $data = Barang::all();
        $mob = $mobsterid;
         return view('beli.index',compact('data','mob'));
    }
    public function index()
    {
        $data = Barang::all();
         return view('beli.indexnon',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('pembelian');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $mobsterid)
    {
        $var = new Pembelian();
        for ($i=1; $i <= 99999 ; $i++) {
            $cekinvoice = DB::table('pembelian')->where('invoice_code','=',$i)->value('invoice_code');
            if ($cekinvoice == NULL) {
              if ($i < 9) {
                $ic = Str::random_int(6);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 99) {
                $ic = Str::random_int(5);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 999) {
                $ic = Str::random_int(4);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 9999) {
                $ic = Str::random_int(3);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 9999) {
                $ic = Str::random_int(2);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 99999) {
                $ic = Str::random_int(1);
                $var->invoice_code = $ic.$i;
              }
              break;
            }
        }
        $harga = DB::table('barang')->where('id','=',$request->barang_id)->value('totalharga');
        $hargatotal = $harga * $request->jumlah_barang + $request->ongkir;
        $var->hargatotal = $hargatotal;
        $var->nama = $request->nama;
        $var->barang_id = $request->barang_id;
        $var->jumlah_barang = $request->jumlah_barang;
        $var->alamat = $request->alamat;
        $var->pembayaran = $request->pembayaran;
        $var->provinsi = $request->provinsi;
        $var->kode_pos = $request->kode_pos;
        $var->kecamatan = $request->kecamatan;
        $var->kabupaten = $request->kabupaten;
        $var->no_hp = '62'.$request->no_hp;
        $var->ongkir = $request->ongkir;
        $var->mobsterid = $mobsterid;
        $var->save();

        //Email Code
        $invoice_code = $i;
        $name = $request->nama;
        $nbarang = DB::table('barang')->where('id','=',$request->barang_id)->value('nama_barang');
        $nama_barang = $nbarang;
        $kecamatan = $request->kecamatan;
        $kabupaten = $request->kabupaten;
        $hargatotal = $hargatotal;
        $jumlah = $request->jumlah_barang;
        $kode_pos = $request->kode_pos;
        $alamat = $request->alamat;
        $no_hp = '62'.$request->no_hp;
        Mail::to('mobster@smsinstan.net')->send(new OrderMailable($invoice_code,$name,$nama_barang,$kecamatan,$kabupaten,$hargatotal,$jumlah,$kode_pos,$alamat,$no_hp));
        //End email code

        return redirect('pembelian/'.$mobsterid);
    }

    public function storenon(Request $request)
    {
        $var = new Pembelian();
        for ($i=1; $i <= 99999 ; $i++) {
            $cekinvoice = DB::table('pembelian')->where('invoice_code','=',$i)->value('invoice_code');
            if ($cekinvoice == NULL) {
              if ($i < 9) {
                $ic = Str::random_int(6);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 99) {
                $ic = Str::random_int(5);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 999) {
                $ic = Str::random_int(4);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 9999) {
                $ic = Str::random_int(3);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 9999) {
                $ic = Str::random_int(2);
                $var->invoice_code = $ic.$i;
              }elseif ($i <= 99999) {
                $ic = Str::random_int(1);
                $var->invoice_code = $ic.$i;
              }
              break;
            }
        }
        $harga = DB::table('barang')->where('id','=',$request->barang_id)->value('totalharga');
        $hargatotal = $harga * $request->jumlah_barang + $request->ongkir;
        $var->hargatotal = $hargatotal;
        $var->nama = $request->nama;
        $var->barang_id = $request->barang_id;
        $var->jumlah_barang = $request->jumlah_barang;
        $var->alamat = $request->alamat;
        $var->pembayaran = $request->pembayaran;
        $var->provinsi = $request->provinsi;
        $var->kode_pos = $request->kode_pos;
        $var->kecamatan = $request->kecamatan;
        $var->kabupaten = $request->kabupaten;
        $var->no_hp = '62'.$request->no_hp;
        $var->ongkir = $request->ongkir;
        $var->save();

        //Email Code
        $invoice_code = $i;
        $name = $request->nama;
        $nbarang = DB::table('barang')->where('id','=',$request->barang_id)->value('nama_barang');
        $nama_barang = $nbarang;
        $kecamatan = $request->kecamatan;
        $kabupaten = $request->kabupaten;
        $hargatotal = $hargatotal;
        $jumlah = $request->jumlah_barang;
        $kode_pos = $request->kode_pos;
        $alamat = $request->alamat;
        $no_hp = '62'.$request->no_hp;
        Mail::to('mobster@smsinstan.net')->send(new OrderMailable($invoice_code,$name,$nama_barang,$kecamatan,$kabupaten,$hargatotal,$jumlah,$kode_pos,$alamat,$no_hp));
        //End email code

        return redirect('pembelian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return redirect('pembelian');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('pembelian');
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
