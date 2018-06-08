<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Auth;

class MitrabarangController extends Controller
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
        return view('mitrabarang.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mitrabarang.create');
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
          'nama_barang' => 'required',
          'harga' => 'required',
        ]);

        $as = new Barang();
        $as->nama_barang = $request->nama_barang;
        if ($request->diskon != NULL) {
          if ($request->diskon >= 100) {
            $totalharga = 0;
          }elseif ($request->diskon < 100) {
          $totalharga = $request->harga * ($request->diskon / 100);
          }
        }elseif ($request->diskon == NULL) {
          $totalharga = $request->harga;
        }
        $as->harga = $request->harga;
        $as->totalharga = $totalharga;
        $as->diskon = $request->diskon;
        $as->user_id = Auth::user()->id;
        $as->save();

        return redirect('mitra/barang');

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
      $data = Barang::find($id);
      return view('mitrabarang.edit',compact('data'));
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
        'nama_barang' => 'required',
        'harga' => 'required',
      ]);

      $as = Barang::find($id);
      $as->nama_barang = $request->nama_barang;
      if ($request->diskon != NULL) {
        if ($request->diskon >= 100) {
          $totalharga = 0;
        }elseif ($request->diskon < 100) {
        $totalharga = $request->harga * ($request->diskon / 100);
        }
      }elseif ($request->diskon == NULL) {
        $totalharga = $request->harga;
      }
      $as->harga = $request->harga;
      $as->totalharga = $totalharga;
      $as->diskon = $request->diskon;
      $as->save();

      return redirect('mitra/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $as = Barang::find($id);
        $as->delete();
        return redirect('mitra/barang');
    }
}
