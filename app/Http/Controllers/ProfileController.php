<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::find(Auth::user()->id);
        return view('backend.profile.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    public function updatePassword(Request $request)
    {
        $request->validate([
            'old' => 'required|min:8',
            'new' => 'required|min:8',
            'confirm' => 'required|min:8|same:new',
        ]);
        
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->old, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new),
            ]);
    
            return redirect()->back()->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Password lama yang dimasukkan salah.');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $user->update($request->all());
        if($user) {
            return redirect()->back()->with('success', 'Data berhasil diubah!');
        }else{
            return redirect()->back()->with('error', 'Data gagal diubah!');
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
        //
    }
}
