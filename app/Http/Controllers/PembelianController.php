<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Barang;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendorderMailable;
use DB;
use App\Keuangan;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('level:1');
     }

    public function index()
    {
        $data = Pembelian::all();
         return view('pembelian.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Barang::all();
        return view('pembelian.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $var = new Pembelian();
        $ic = Str::random_int(9);
        $var->invoice_code = $ic;
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
        return redirect('admin/pembelian')->with('message', 'Data telah di Tambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $var = Pembelian::find($id);
        if(!$var){
            abort(404);
        }

        return view('pembelian.detail')->with('var', $var);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pembelian::find($id);
        $br = Barang::all();
        if(!$data){
            abort(404);
        }

        return view('pembelian.edit',compact('data','br'));
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
        $var = Pembelian::find($id);
        $harga = DB::table('barang')->where('id','=',$request->barang_id)->value('totalharga');
        $hargatotals = $harga * $request->jumlah_barang + $id + $request->ongkir;
        $var->hargatotal = $hargatotals;
        $var->nama = $request->nama;
        $var->barang_id = $request->barang_id;
        $var->jumlah_barang = $request->jumlah_barang;
        $var->alamat = $request->alamat;
        $var->provinsi = $request->provinsi;
        $var->kode_pos = $request->kode_pos;
        $var->kecamatan = $request->kecamatan;
        $var->kabupaten = $request->kabupaten;
        $var->no_hp = $request->no_hp;
        $var->ongkir = $request->ongkir;
        $var->status = $request->status;
        $var->pembayaran = $request->pembayaran;
        $var ->save();

        $invoice_code = $id;
        $name = $request->nama;
        $ceknamabarang = DB::table('barang')->where('id','=',$request->barang_id)->value('nama_barang');
        $nama_barang = $ceknamabarang;
        $kecamatan = $request->kecamatan;
        $kabupaten = $request->kabupaten;
        $hargatotal = $hargatotals;
        $jumlah = $request->jumlah_barang;
        $kode_pos = $request->kode_pos;
        $alamat = $request->alamat;
        $no_hp = $request->no_hp;
        $provinsi = $request->provinsi;
        return redirect('admin/pembelian')->with('message', 'Data telah di Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function bayar(Request $request,$bayar)
     {
       $as = Pembelian::find($bayar);
       $as->status = "1";
       $as->save();

       $cekmobsterid = DB::table('users')->where('mobsterid','=',$request->mobsterid)->value('id');
       $cekdeposituser = DB::table('keuangan')->where('user_id','=',$cekmobsterid)->value('id');
       $cekhargabarang = DB::table('barang')->where('id','=',$request->barang_id)->value('totalharga');

       //Update deposit
       $dp = Keuangan::find($cekdeposituser);
       $tdeposit = ($cekhargabarang * 30 / 100) + $dp->deposit;
       $dp->deposit = $tdeposit;
       $dp->save();
       
       $cekemail = DB::table('barang')->where('id','=',$request->barang_id)->value('user_id');
       $emailfix = DB::table('users')->where('id','=',$cekemail)->value('email');
       Mail::to($emailfix)->send(new SendorderMailable($invoice_code,$name,$nama_barang,$kecamatan,$kabupaten,$hargatotal,$jumlah,$kode_pos,$alamat,$no_hp,$provinsi));
       return redirect('admin/pembelian');
     }

    public function destroy($id)
    {

        $var = Pembelian::find($id);
        $var ->delete();
        return redirect('admin/pembelian')->with('message', 'Data telah di Hapus.');
    }
}
