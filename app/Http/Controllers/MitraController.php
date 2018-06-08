<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('level:0');
     }

    public function index()
    {
        $data = DB::table('users')->where('level','=','1')->orWhere('level','=','2')->get();
        return view('mitra.indexuser',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mitra.create');
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
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6',
        ]);

        $d = new User();
        $d->name = $request->name;
        $d->email = $request->email;
        $d->password = bcrypt($request->password);
        $d->level = $request->level;
        $d->save();
        return redirect('headadmin/users');
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
        $data = User::find($id);
        return view('mitra.edit',compact('data'));
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

      if ($request->name != NULL) {
        $this->validate($request,[
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
        ]);
        $d = User::find($id);
        $d->name = $request->name;
        $d->email = $request->email;
        $d->level = $request->level;
        $d->save();
        return redirect('headadmin/users');
      }elseif ($request->password != NULL) {
        $this->validate($request,[
          'password' => 'required|string|min:6',
        ]);
        $d = User::find($id);
        $d->password = bcrypt($request->password);
        $d->save();
        return redirect('headadmin/users');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = User::find($id);
        $d->delete();
        return redirect('headadmin/users');
    }
}
