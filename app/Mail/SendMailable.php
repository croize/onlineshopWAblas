<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
  use Queueable, SerializesModels;
  public $name;
  public $nama_barang;
  public $resi;
  public $kecamatan;
  public $kabupaten;
  public $hargatotal;
  public $jumlah;
  public $kode_pos;
  public $alamat;
  public $no_hp;
  public $invoice_code;
  public $harga;
  public $provinsi;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($provinsi,$harga,$invoice_code,$name,$nama_barang,$resi,$kecamatan,$kabupaten,$hargatotal,$jumlah,$kode_pos,$alamat,$no_hp)
    {
        $this->invoice_code = $invoice_code;
        $this->name = $name;
        $this->nama_barang = $nama_barang;
        $this->resi = $resi;
        $this->kecamatan = $kecamatan;
        $this->kabupaten = $kabupaten;
        $this->hargatotal = $hargatotal;
        $this->jumlah = $jumlah;
        $this->kode_pos = $kode_pos;
        $this->alamat = $alamat;
        $this->no_hp = $no_hp;
        $this->harga = $harga;
        $this->provinsi = $provinsi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Laporan pengiriman Invoice Code - '.$this->invoice_code.' Nama - '.$this->name)->view('emails.name');
    }
}
