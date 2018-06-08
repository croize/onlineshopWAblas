<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Barang;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMailable;

class KonsumenbeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Barang::all();
         return view('beli.index',['data' => $data]);
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
    public function store(Request $request)
    {
        $var = new Pembelian();
        for ($i=1; $i <= 999 ; $i++) {
          if ($i <= 9) {
            $vco = "00".$i;
            $cekinvoice = DB::table('pembelian')->where('invoice_code','=',$vco)->orWhere('pembayaran','=','BCA')->orWhere('pembayaran','=','BNI')->orWhere('pembayaran','=','MS')->value('invoice_code');
            if ($cekinvoice == NULL) {
              $var->invoice_code = $vco;
              $harga = DB::table('barang')->where('id','=',$request->barang_id)->value('totalharga');
              $hargatotal = $harga * $request->jumlah_barang + $vco + $request->ongkir;
              $var->hargatotal = $hargatotal;
              $var->nama = $request->nama;
              $var->barang_id = $request->barang_id;
              $var->jumlah_barang = $request->jumlah_barang;
              $var->alamat = $request->alamat;
              $var->provinsi = $request->provinsi;
              $var->kode_pos = $request->kode_pos;
              $var->kecamatan = $request->kecamatan;
              $var->kabupaten = $request->kabupaten;
              $var->no_hp = '62'.$request->no_hp;
              $var->ongkir = $request->ongkir;
              break;
            }
          }elseif ($i <= 99) {
            $vco = "0".$i;
            $cekinvoice = DB::table('pembelian')->where('invoice_code','=',$vco)->orWhere('pembayaran','=','BCA')->orWhere('pembayaran','=','BNI')->orWhere('pembayaran','=','MS')->value('invoice_code');
            if ($cekinvoice == NULL) {

              $var->invoice_code = $vco;
              $harga = DB::table('barang')->where('id','=',$request->barang_id)->value('totalharga');
              $hargatotal = $harga * $request->jumlah_barang + $vco + $request->ongkir;
              $var->hargatotal = $hargatotal;
              $var->nama = $request->nama;
              $var->barang_id = $request->barang_id;
              $var->jumlah_barang = $request->jumlah_barang;
              $var->alamat = $request->alamat;
              $var->provinsi = $request->provinsi;
              $var->kode_pos = $request->kode_pos;
              $var->kecamatan = $request->kecamatan;
              $var->kabupaten = $request->kabupaten;
              $var->no_hp = '62'.$request->no_hp;
              $var->ongkir = $request->ongkir;
              break;
            }
          }elseif ($i <= 999) {
            $vco = $i;
            $cekinvoice = DB::table('pembelian')->where('invoice_code','=',$vco)->orWhere('pembayaran','=','BCA')->orWhere('pembayaran','=','BNI')->orWhere('pembayaran','=','MS')->value('invoice_code');
            if ($cekinvoice == NULL) {
              $var->invoice_code = $vco;
              $harga = DB::table('barang')->where('id','=',$request->barang_id)->value('totalharga');
              $hargatotal = $harga * $request->jumlah_barang + $vco + $request->ongkir;
              $var->hargatotal = $hargatotal;
              $var->nama = $request->nama;
              $var->barang_id = $request->barang_id;
              $var->jumlah_barang = $request->jumlah_barang;
              $var->alamat = $request->alamat;
              $var->provinsi = $request->provinsi;
              $var->kode_pos = $request->kode_pos;
              $var->kecamatan = $request->kecamatan;
              $var->kabupaten = $request->kabupaten;
              $var->no_hp = '62'.$request->no_hp;
              $var->ongkir = $request->ongkir;
              break;
            }
          }
        }
        $var->save();
        $invoice_code = $vco;
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

        return redirect('https://api.whatsapp.com/send?phone=6287878788088&text=Detail pembayaran anda :%0D%0A%0D%0AInvoice code : '.$invoice_code.'%0D%0ANama: '.$name.'%0D%0ABarang : '.$nama_barang.'%0D%0AJumlah barang : '.$jumlah.'%0D%0AJumlah yang harus dibayar : Rp'.$hargatotal.'%0D%0A%0D%0AHarap segera bayar sesuai dengan jumlah yang harus dibayar.%0D%0A%0D%0ABCA 4383140377%0D%0ABMS 7140319777%0D%0ABNI 1403197707%0D%0AA.N Mohamad Ali Guntur%0D%0A%0D%0ASilahkan balas pesan ini untuk melakukan konfirmasi pembayaran dengan cara ketik konfirmasi#order dan sertakan bukti transfer.%0D%0A%0D%0ANote : *gambar bukti transfer jangan diberi caption.*');
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
