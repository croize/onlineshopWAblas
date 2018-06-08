<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMailable extends Mailable
{
  use Queueable, SerializesModels;
  public $name;
  public $nama_barang;
  public $kecamatan;
  public $kabupaten;
  public $hargatotal;
  public $jumlah;
  public $kode_pos;
  public $alamat;
  public $no_hp;
  public $invoice_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($invoice_code,$name,$nama_barang,$kecamatan,$kabupaten,$hargatotal,$jumlah,$kode_pos,$alamat,$no_hp)
     {
         $this->invoice_code = $invoice_code;
         $this->name = $name;
         $this->nama_barang = $nama_barang;
         $this->kecamatan = $kecamatan;
         $this->kabupaten = $kabupaten;
         $this->hargatotal = $hargatotal;
         $this->jumlah = $jumlah;
         $this->kode_pos = $kode_pos;
         $this->alamat = $alamat;
         $this->no_hp = $no_hp;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order - '.$this->name)->view('emails.order');
    }
}
