<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Broadcast;
use App\Content;

class ContentController extends Controller
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
        $data = Content::all();
        return view('content.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Broadcast::all();
        return view('content.create',compact('data'));
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
          'asset' => 'required',
          'content' => 'required',
          'broadcastid' => 'required',
        ]);

        $as = new Content();
        $as->asset = $request->asset;
        $as->content = $request->content;
        $as->broadcast_id = $request->broadcastid;
        $as->save();
        return redirect('admin/content');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Content::find($id);
        return view('content.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Content::find($id);
      $br = Broadcast::all();
      return view('content.edit',compact('data','br'));
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
        'asset' => 'required',
        'content' => 'required',
        'broadcastid' => 'required',
      ]);

      $as = Content::find($id);
      $as->content = $request->content;
      $as->broadcast_id = $request->broadcastid;
      $as->asset = $request->asset;
      $as->save();
      return redirect('admin/content');
    }
    public function download(Request $request,$id)
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
        $as = Content::find($id);
        $as->delete();
        return redirect('admin/content');
    }
}
