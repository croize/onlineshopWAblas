<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Broadcast;

class BroadcastController extends Controller
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
        $data = Broadcast::all();
        return view('broadcast.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('broadcast.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'nama' => 'required',
          'tanggal' => 'required',
          'waktu' => 'required',
          'jumlah' => 'required',
          'target' => 'required',
          'operator' => 'required',
          'prefix' => 'required',
          'jenis_kartu' => 'required',
        ]);

        $as = new Broadcast();
        $as->nama = $request->nama;
        $as->tanggal = $request->tanggal;
        $as->waktu = $request->waktu;
        $as->jumlah = $request->jumlah;
        $as->target = $request->target;
        $as->operator = $request->operator;
        $as->prefix = $request->prefix;
        $as->jenis_kartu = $request->jenis_kartu;
        $as->save();

        return redirect('admin/broadcast');

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
        $as = Broadcast::find($id);
        return view('broadcast.edit',compact('as'));
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
      $this->validate($request,[
        'nama' => 'required',
        'tanggal' => 'required',
        'waktu' => 'required',
        'jumlah' => 'required',
        'target' => 'required',
        'operator' => 'required',
        'prefix' => 'required',
        'jenis_kartu' => 'required',
      ]);

      $as = Broadcast::find($id);
      $as->nama = $request->nama;
      $as->tanggal = $request->tanggal;
      $as->waktu = $request->waktu;
      $as->jumlah = $request->jumlah;
      $as->target = $request->target;
      $as->operator = $request->operator;
      $as->prefix = $request->prefix;
      $as->jenis_kartu = $request->jenis_kartu;
      $as->save();
      return redirect('admin/broadcast');
    }
    public function finish(Request $request)
    {
      // $ca = count($request->status);
      // for ($i=1; $i <= $ca ; $i++) {
      //     $as = Broadcast::find($i);
      //     $as->status = $request->status.$i;
      // }
      $as = Broadcast::updateOrCreate('id',$request->id)->update(['status' => 1,]);
      return redirect('admin/broadcast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $as = Broadcast::find($id);
        $as->delete();
        return redirect('admin/broadcast');
    }
}
