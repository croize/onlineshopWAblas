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

//       Terima kasih telah bergabung menjadi Agen MOBSTER.CODE Agen Anda adalah dsadsa
// Wujudkan mimpi untuk mendapatkan penghasilan tak terbatas melalui HP Anda.

      $isisms = 'Terima kasih telah bergabung menjadi Agen MOBSTER.CODE Agen Anda adalah '.$as->mobsterid.'.Wujudkan mimpi untuk mendapatkan penghasilan tak terbatas melalui HP Anda.';
      return redirect('sms/'.$linkfrom.'/62'.$as->no_hp.'/'.$isisms.'/'.$id);
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
      $isisms = 'Minggu ini penghasilan Anda telah kami transfer sebesar Rp. .... . Silahkan cek rekening dan lanjutkan meraih mimpimu.';
      return redirect('sms/'.$linkfrom.'/62'.$cekuser->no_hp.'/'.$isisms.'/'.$request->userid);
    }

}
