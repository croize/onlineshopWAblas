<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Listlink;
use DB;

class ListlinkController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('level:0');
  }

  public function index()
  {
    $data = User::where('level','=',3)->get();
    return view('linkmitra.index',compact('data'));
  }

  public function create()
  {
    $datamitra = DB::table('users')->where('level','=','2')->get();
    return view('linkmitra.create',compact('datamitra'));
  }

  public function store(Request $request)
  {
    $as = new Listlink();
    $as->user_id = $request->user_id;
    $as->link = $request->link;
    $as->save();
    return redirect('headadmin/listlink');
  }

  public function edit($id)
  {
    $findid = Listlink::find($id);
    $datamitra = DB::table('users')->where('level','=','2')->get();
    return view('linkmitra.edit',compact('findid','datamitra'));
  }

  public function update(Request $request, $id)
  {
    $findid = Listlink::find($id);
    $findid->user_id = $request->user_id;
    $findid->link = $request->link;
    $findid->save();
    return redirect('headadmin/listlink');
  }

  public function destroy($id)
  {
    $de = Listlink::find($id);
    $de->delete();
    return redirect('headadmin/listlink');
  }

}
