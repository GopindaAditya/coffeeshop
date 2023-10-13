<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    function index(){        
        return view('customer.dataUser.dashborad');
    }

    function read(){
        $user = Auth::user();
        $data = User::find($user->id);
        return view('customer.dataUser.read', compact('data'));
    }

    function edit(){
        $user = Auth::user();
        $data = User::find($user->id);
        return view('customer.dataUser.edit', compact('data'));
    }

    function update(Request $request) {
        $cradential = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required|numeric',                       
        ]);
        $user = Auth::user();
        $data = User::find($user->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->save();
        return response()->json($data, 200);
    }


}
