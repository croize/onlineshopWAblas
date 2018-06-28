<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Keuangan;

class ResellermanageController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('level:0');
  }

    public function index()
    {
      $data = User::where('status_reseller',2)->get();
      return view('resellermanage.index',compact('data'));
    }
    public function accept($id)
    {
      $as = User::find($id);
      $as->status_reseller = 1;
      $as->save();
      $linkfrom = "accountmanage";
      $isisms = 'Terima kasih Anda telah bergabung dengan Agen MOBSTER.Wujudkan mimpi Anda untuk mewujudkan penghasilan tak terbatas melalui handphone Anda.CODE MOBSTER Anda adalah '.$as->mobsterid.' . Kesuksesanmu ada di depan mata.';
      return redirect('sms/'.$linkfrom.'/62'.$as->no_hp.'/'.$isisms);
    }

    public function pendatapan()
    {
      $data = Keuangan::all();
      return view('resellermanage.pendapatan',compact('data'));
    }

    public function acceptpengambilan(Request $request, $id)
    {
      $cekuser = User::find($request->userid);
      $as = Keuangan::find($id);
      $as->status_pengajuan = 1;
      $as->deposit = 0;
      $as->save();
      $linkfrom = "keuangan";
      $isisms = 'Terima kasih Anda telah menjadi bagian dari agen MOBSTER. PENGHASILAN ANDA BERHASIL KAMI MASUKAN KE REKENING YANG ANDA DAFTARKAN. Silahkan cek rekening Anda.';
      return redirect('sms/'.$linkfrom.'/62'.$cekuser->no_hp.'/'.$isisms);
    }

}
